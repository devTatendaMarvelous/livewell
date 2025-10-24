<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Models\Livestock;
use App\Models\User;
use App\Traits\Core;
use App\Traits\LivestockModel;
use Illuminate\Http\Request;

class HealthRecordController extends Controller
{
    use LivestockModel,Core;
    public function index()
    {
        $records = HealthRecord::with(['livestock', 'vet']) -> when(!isVet(), function ($query) {
            return $query->whereHas('livestock', function ($query) {
                return $query->where('user_id', auth()->user()->id);
            });
        })->latest()->paginate(10);
        return view('health_records.index', compact('records'));
    }

    public function create()
    {
        $livestock = Livestock::all();
        $vets = User::where('role', 'vet')->get();
        $signs = $this->getSigns();
        $symptoms = $this->getSymptoms();
        return view('health_records.create', compact('livestock', 'vets', 'signs', 'symptoms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'livestock_id' => 'required|exists:livestocks,id',
            'symptoms' => 'required|',
            'signs' => 'required|',
            'vet_id' => 'nullable|exists:users,id',
            'recorded_at' => 'nullable|date',
        ]);
        $validated['symptoms'] = implode('|',$validated['symptoms']);
        $validated['signs'] = implode(';',$validated['signs']);


        HealthRecord::create($validated);
        toast('Health record created successfully.','success');
        return redirect()->route('health-records.index')->with('success', 'Health record created.');
    }

    public function show($id)
    {
        $healthRecord = HealthRecord::with(['livestock', 'vet'])->findOrFail($id);
        return view('health_records.show', compact('healthRecord'));
    }

// app/Http/Controllers/HealthRecordController.php

public function diagonise(Request $request, $id)
{
    $healthRecord = HealthRecord::with('livestock')->findOrFail($id);

    $data = [
        'species' => $healthRecord->livestock->species ?? null,
        'breed' => $healthRecord->livestock->breed ?? null,
        'age_group' => $healthRecord->livestock->age ?? null,
        'symptoms_list' => $healthRecord->symptoms,
        'key_signs' => $healthRecord->signs ?? null,
    ];

    $response = $this->diagoniseLivestock($data);

    if (isset($response['disease'])) {

        $healthRecord->update([
            'diagnosis' => $response['disease'],
            'treatment' => $response['treatment'] ?? null,
            'prevention' => $response['prevention'] ?? null,
            'status' => 'DIAGONISED',
        ]);

        return view('health_records.show', compact('healthRecord'));
    }

    return response()->json($response);
}
    public function edit(HealthRecord $healthRecord)
    {
        $livestock = Livestock::all();
        $vets = User::where('role', 'vet')->get();
        return view('health_records.edit', compact('healthRecord', 'livestock', 'vets'));
    }

    public function update(Request $request, HealthRecord $healthRecord)
    {
        $validated = $request->validate([
            'symptoms' => 'required|string',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'vet_id' => 'nullable|exists:users,id',
            'recorded_at' => 'nullable|date',
        ]);

        $healthRecord->update($validated);
        toast('Health record updated successfully.','success');
        return redirect()->route('health-records.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(HealthRecord $healthRecord)
    {
        $healthRecord->delete();
        toast('Health record deleted successfully.','success');
        return redirect()->route('health-records.index')->with('success', 'Record deleted.');
    }
}
