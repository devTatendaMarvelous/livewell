<?php

namespace App\Http\Controllers;

use App\Models\ExportLog;
use App\Models\HealthRecord;
use App\Models\Livestock;
use App\Services\ReportExporter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function healthSummary(Request $request)
    {
        $start = $request->query('start_date') ? Carbon::parse($request->query('start_date'))->startOfDay() : null;
        $end = $request->query('end_date') ? Carbon::parse($request->query('end_date'))->endOfDay() : null;

        $dateFilter = function ($q) use ($start, $end) {
            if ($start && $end) {
                $q->whereBetween(\DB::raw('COALESCE(recorded_at, created_at)'), [$start, $end]);
            } elseif ($start) {
                $q->where(\DB::raw('COALESCE(recorded_at, created_at)'), '>=', $start);
            } elseif ($end) {
                $q->where(\DB::raw('COALESCE(recorded_at, created_at)'), '<=', $end);
            }
        };

        // Base aggregates
        $totalLivestock = Livestock::count();

        // Active/current cases: records not completed/closed
        $currentCases = HealthRecord::whereIn('status', ['PENDING', 'DIAGONISED'])
            ->where($dateFilter)->count();

        // Recovered cases: status COMPLETED if such data exists
        $recoveredCases = HealthRecord::where('status', 'COMPLETED')
            ->where($dateFilter)->count();

        // Symptoms aggregation (symptoms stored as pipe-delimited per HealthRecordController@store)
        $symptomCounts = [];
        HealthRecord::select('symptoms')
            ->whereNotNull('symptoms')
            ->where($dateFilter)
            ->chunk(500, function ($rows) use (&$symptomCounts) {
                foreach ($rows as $row) {
                    $parts = is_string($row->symptoms) ? preg_split('/[|,]/', $row->symptoms) : [];
                    foreach ($parts as $p) {
                        $sym = trim(mb_strtolower($p));
                        if ($sym === '') continue;
                        $symptomCounts[$sym] = ($symptomCounts[$sym] ?? 0) + 1;
                    }
                }
            });
        arsort($symptomCounts);
        $topSymptoms = array_slice($symptomCounts, 0, 5, true);

        // Time windows for trends (respect custom filter when present)
        $now = Carbon::now();
        $startCurrent = $now->copy()->subDays(30);
        $startPrevious = $now->copy()->subDays(60);

        if ($start || $end) {
            // Use provided window for cases
            $casesCurrentWindow = HealthRecord::where($dateFilter)->count();
            $casesPreviousWindow = 0;
            $trendIncreasePct = null;
        } else {
            $casesCurrentWindow = HealthRecord::where('created_at', '>=', $startCurrent)->count();
            $casesPreviousWindow = HealthRecord::whereBetween('created_at', [$startPrevious, $startCurrent])->count();
            $trendIncreasePct = $casesPreviousWindow > 0
                ? round((($casesCurrentWindow - $casesPreviousWindow) / $casesPreviousWindow) * 100, 1)
                : null;
        }

        // Weekly distribution last 8 weeks
        $weekly = [];
        for ($i = 7; $i >= 0; $i--) {
            $weekStart = $now->copy()->startOfWeek()->subWeeks($i);
            $weekEnd = $weekStart->copy()->endOfWeek();
            $count = HealthRecord::whereBetween('created_at', [$weekStart, $weekEnd])->count();
            $weekly[] = [
                'label' => $weekStart->format('M d') . ' - ' . $weekEnd->format('M d'),
                'count' => $count,
            ];
        }

        // Recovery and mortality rates
        $totalCaseRecords = HealthRecord::where($dateFilter)->count();
        $recoveryRate = $totalCaseRecords > 0 ? round(($recoveredCases / $totalCaseRecords) * 100, 1) : 0.0;

        // Attempt to infer mortalities from diagnosis keywords (best effort)
        $deathKeywords = ['death', 'deceased', 'dead', 'mortality'];
        $mortalityCases = HealthRecord::where($dateFilter)->where(function ($q) use ($deathKeywords) {
            foreach ($deathKeywords as $kw) {
                $q->orWhereRaw('LOWER(diagnosis) LIKE ?', ['%' . strtolower($kw) . '%']);
            }
        })->count();
        $mortalityRate = $totalCaseRecords > 0 ? round(($mortalityCases / $totalCaseRecords) * 100, 1) : 0.0;

        // Insights and recommendations
        $insights = [];
        if (isset($trendIncreasePct) && $trendIncreasePct !== null && $trendIncreasePct > 30) {
            $insights[] = 'Significant increase in reported cases in the last 30 days (' . $trendIncreasePct . '%). Intensify surveillance and outreach.';
        } elseif (isset($trendIncreasePct) && $trendIncreasePct !== null && $trendIncreasePct < -20) {
            $insights[] = 'Reported cases have decreased over the last month (' . abs($trendIncreasePct) . '%). Maintain current preventive measures.';
        }
        if (!empty($topSymptoms)) {
            $firstSymptom = array_key_first($topSymptoms);
            $insights[] = 'Most common symptom: ' . ucfirst($firstSymptom) . '. Ensure rapid assessment protocols for animals presenting with this sign.';
        }
        if ($mortalityRate >= 5) {
            $insights[] = 'Elevated mortality rate observed (' . $mortalityRate . '%). Review treatment efficacy and biosecurity measures.';
        }
        if ($recoveryRate < 40 && $currentCases > 10) {
            $insights[] = 'Low recovery rate with many active cases. Consider targeted vaccination or treatment campaigns.';
        }
        if (empty($insights)) {
            $insights[] = 'No significant anomalies detected. Continue routine monitoring, vaccination schedules, and farmer education.';
        }

        // Recommendations for veterinary officers (concise)
        $recommendations = [
            'Prioritize follow-up on active cases and ensure timely updates to record statuses.',
            'Standardize symptom reporting to improve early-warning analytics.',
            'Engage farmers on hygiene, isolation of sick animals, and prompt vet visits.',
            'Verify vaccine coverage for prevalent diseases in the region.',
        ];

        // Handle export
        $format = $request->query('format');
        if (in_array($format, ['csv', 'pdf'])) {
            // Log export
            ExportLog::create([
                'user_id' => auth()->id(),
                'report' => 'health_summary',
                'format' => $format,
                'purpose' => $request->query('purpose'),
                'filters' => [
                    'start_date' => $request->query('start_date'),
                    'end_date' => $request->query('end_date'),
                ],
                'exported_at' => now(),
                'ip_address' => $request->ip(),
            ]);

            if ($format === 'csv') {
                $headers = ['Metric', 'Value'];
                $rows = [
                    ['Total Livestock', $totalLivestock],
                    ['Current Cases', $currentCases],
                    ['Recovered Cases', $recoveredCases],
                    ['Recovery Rate (%)', $recoveryRate],
                    ['Mortality Rate (%)', $mortalityRate],
                    ['Cases (Current Window)', $casesCurrentWindow],
                    ['Cases (Previous Window)', $casesPreviousWindow],
                ];
                foreach ($topSymptoms as $symptom => $count) {
                    $rows[] = ['Symptom: ' . str_replace('_', ' ', $symptom), $count];
                }
                return ReportExporter::csv('health_summary_' . now()->format('Ymd_His') . '.csv', $headers, $rows);
            } else {
                $lines = [
                    'Livestock Health Summary Report',
                    'Period: ' . ($request->query('start_date') ?: '—') . ' to ' . ($request->query('end_date') ?: '—'),
                    'Generated: ' . now()->toDateTimeString(),
                    '----------------------------------------',
                    'Total Livestock: ' . $totalLivestock,
                    'Current Cases: ' . $currentCases,
                    'Recovered Cases: ' . $recoveredCases,
                    'Recovery Rate: ' . $recoveryRate . '%',
                    'Mortality Rate: ' . $mortalityRate . '%',
                    'Cases (Current Window): ' . $casesCurrentWindow,
                    'Cases (Previous Window): ' . $casesPreviousWindow,
                    'Top Symptoms:'
                ];
                foreach ($topSymptoms as $symptom => $count) {
                    $lines[] = ' - ' . ucwords(str_replace('_', ' ', $symptom)) . ': ' . $count;
                }
                $lines[] = 'Insights:';
                foreach ($insights as $i) { $lines[] = ' * ' . $i; }
                $lines[] = 'Recommendations:';
                foreach ($recommendations as $r) { $lines[] = ' * ' . $r; }

                return ReportExporter::simplePdf('health_summary_' . now()->format('Ymd_His') . '.pdf', $lines);
            }
        }

        return view('reports.health_summary', compact(
            'totalLivestock',
            'currentCases',
            'recoveredCases',
            'topSymptoms',
            'recoveryRate',
            'mortalityRate',
            'casesCurrentWindow',
            'casesPreviousWindow',
            'trendIncreasePct',
            'weekly',
            'insights',
            'recommendations'
        ));
    }
}
