<?php

namespace App\Http\Controllers;


use App\Models\Vaccination;
use App\Traits\Core;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Livestock;
use App\Models\User;
use App\Models\HealthRecord;
use App\Models\Reminder;
class HomeController extends Controller
{
    use Core;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {

        if (strtolower( auth()->user()->role )==='farmer'){

            return $this->dashboard();
        }


        // Most common diseases (assumes `diagnoses` table with `disease` column)
        $diseases = \DB::table('health_records')
            ->select('diagnosis', \DB::raw('count(*) as total'))
            ->groupBy('diagnosis')
            ->orderByDesc('total')
            ->limit(8)
            ->get();
        $diseasesData = $diseases->pluck('total', 'diagnosis')->toArray();

//        dd($diseasesData);
        // Livestock distribution by type (assumes `animals` table with `type` column)
        $distribution = Livestock::select('species', DB::raw('count(*) as total'))
            ->groupBy('species')
            ->orderByDesc('total')
            ->get();
        $livestockDistribution = $distribution->pluck('total', 'species')->toArray();

        // Registrations over time (monthly) from `animals.created_at`
       // Replace the existing registrations block in `app/Http/Controllers/HomeController.php`
       $monthExpr = "DATE_FORMAT(created_at, '%Y-%M')";
       $registrations = Livestock::select(DB::raw("$monthExpr as month"), DB::raw('count(*) as total'))
           ->groupBy(DB::raw($monthExpr))
           ->orderBy(DB::raw($monthExpr))
           ->get();

       $registrationsMonths = $registrations->pluck('month')->toArray();
       $registrationsCounts = $registrations->pluck('total')->toArray();


        // Users by role (assumes `users.role` column)
        $usersByRole = \DB::table('users')
            ->select('role', \DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role')
            ->toArray();

        // Active disease alerts and missed vaccinations (example tables/columns)
        $activeAlerts = Reminder::count();
        $missedVaccinations = \DB::table('vaccinations')->count();

        // Other counts used by the main cards (if not already computed)
        $totalLivestock =Livestock::count();
        $totalVets = \DB::table('users')->where('role', 'vet')->count();
        $totalFarmers = \DB::table('users')->where('role', 'farmer')->count();

        return view('home', compact(
            'diseasesData',
            'livestockDistribution',
            'registrationsMonths',
            'registrationsCounts',
            'usersByRole',
            'activeAlerts',
            'missedVaccinations',
            'totalLivestock',
            'totalVets',
            'totalFarmers'
        ));
    }

    public function welcome()
    {
        $ages = $this->getAges();
        $breeds = $this->getBreeds();
        $species = $this->getSpecies();
        $signs = $this->getSigns();
        $symptoms = $this->getSymptoms();
        return view('welcome', compact('ages', 'breeds', 'species', 'signs', 'symptoms'));

    }
    public function chat()
    {
        $ages = $this->getAges();
        $breeds = $this->getBreeds();
        $species = $this->getSpecies();
        $signs = $this->getSigns();
        $symptoms = $this->getSymptoms();
        return view('chat', compact('ages', 'breeds', 'species', 'signs', 'symptoms'));

    }



    public function dashboard()
    {
        $userId = auth()->user()->id;


        // My livestock count (farmer's own animals)
        $totalLivestock = Livestock::where('user_id', $userId)->count();

        // Pending vaccinations for my livestock
        $missedVaccinations = Vaccination::whereHas('livestock', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->count();

        // Active disease alerts for my livestock
        $activeAlerts = HealthRecord::whereHas('livestock', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->where('status', 'active')
//        ->where('severity', '>=', 'medium')
        ->count();

        // Common diseases affecting my livestock
        $diseasesData = HealthRecord::whereHas('livestock', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->selectRaw('diagnosis, COUNT(*) as count')
        ->groupBy('diagnosis')
        ->orderByDesc('count')
        ->limit(6)
        ->pluck('count', 'diagnosis')
        ->toArray();

        // My livestock distribution by species
        $livestockDistribution = Livestock::where('user_id', $userId)
            ->selectRaw('species, COUNT(*) as count')
            ->groupBy('species')
            ->pluck('count', 'species')
            ->toArray();

       // My livestock growth over time (last 12 months)
       // My livestock growth over time (last 12 months)
       $registrations = Livestock::where('user_id', $userId)
           ->where('created_at', '>=', now()->subMonths(12))
           ->selectRaw('DATE_FORMAT(created_at, "%b %Y") as month, COUNT(*) as count, MIN(created_at) as min_date')
           ->groupBy('month')
           ->orderBy('min_date')
           ->get();
        $registrationsMonths = $registrations->pluck('month')->toArray();
        $registrationsCounts = $registrations->pluck('count')->toArray();

        // Healthy animals count
        $healthyAnimals = Livestock::where('user_id', $userId)
            ->whereDoesntHave('healthRecords', function($query) {
                $query->where('status', 'active');
            })
            ->count();

        // Recent health checks (last 30 days)
        $recentHealthRecords = HealthRecord::whereHas('livestock', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->where('created_at', '>=', now()->subDays(30))
        ->count();

        return view('farmers', compact(
            'totalLivestock',
            'missedVaccinations',
            'activeAlerts',
            'diseasesData',
            'livestockDistribution',
            'registrationsMonths',
            'registrationsCounts',
            'healthyAnimals',
            'recentHealthRecords'
        ));
    }

}
