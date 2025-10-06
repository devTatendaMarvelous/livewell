<?php


use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\App as FacadesApp;

use Illuminate\Support\Facades\URL;
use App\Http\Controllers\{
    LivestockController,
    HealthRecordController,
    VaccinationController,
    ReminderController,
    DiseaseRiskController
};

/*
|--------------------------------------------------------------------------
| Web Routes
| Web Routes
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
if (FacadesApp::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return redirect()->route('home');
});

Route::resource('livestock', LivestockController::class);
Route::resource('health-records', HealthRecordController::class);
Route::resource('vaccinations', VaccinationController::class);
Route::resource('reminders', ReminderController::class);
Route::resource('disease-risks', DiseaseRiskController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

