<?php

use App\Models\Fee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

function parseDate($date, $type = null)
{

    $date = Carbon::parse($date);
    if ($type) {
        return $date->format($type);
    } else {
        return $date->format('d M Y');
    }
}


function respondWithToken($token)
{
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('api')->factory()->getTTL() * 60,
        'fees' => Fee::all()
    ]);
}
function getMember() {
//    dd( Cache::get('member'));
    return  Session::get('member');
}

function getCurrencies(){
    return getRequest('/packages/currencies')->currrencies??[];
}

function getRelationships(){
   return  [
        "Son", "Daughter", "Husband", "Wife", "Father", "Sister", "Brother",
        "Mother", "Uncle", "Aunt", "Mother-In-Law", "Father-In-Law",
        "Grand-Father", "Grand-Mother", "Grand-Child", "Step-Child",
        "Niece", "Nephew", "Other"
    ];

}




function  formatMobileNumber($mobile)
{
    $mobile = trim($mobile);

// If the number already starts with '263', leave it as is
    if (!preg_match('/^263\d+$/', $mobile)) {
        // If the number starts with '0', replace the leading '0' with '263'
        if (preg_match('/^0(\d{2,})$/', $mobile, $matches)) {
            $mobile = '263' . $matches[1];
        }
        // If the number is in '77...' format (missing country code), prepend '263'
        elseif (preg_match('/^\d{2,}$/', $mobile)) {
            $mobile = '263' . $mobile;
        }
    }
    return $mobile;
}


function isVet()
{
    return strtolower(auth()->user()->role)==='vet';

}
