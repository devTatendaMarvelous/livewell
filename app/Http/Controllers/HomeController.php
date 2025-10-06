<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

            $totalLivestock = DB::table('livestocks')->count();
            $totalVets = DB::table('users')->where('role', 'vet')->count();
            $totalFarmers = DB::table('users')->where('role', 'farmer')->count();

            return view('home', [
                'totalLivestock' => $totalLivestock,
                'totalVets' => $totalVets,
                'totalFarmers' => $totalFarmers,
            ]);

    }


}
