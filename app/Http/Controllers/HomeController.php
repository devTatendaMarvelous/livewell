<?php

namespace App\Http\Controllers;


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

}
