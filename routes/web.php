<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelFileController;
use App\Http\Controllers\QuarterController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\CitizenProfileController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/settings', function(){
    return view('setting.main');
});
Route::get('/citizen', [CitizenController::class,'index'])->name('add-citizen');
Route::get('/region', [QuarterController::class,'index'])->name('add-quarter');
//Route::get('/', [\App\Http\Controllers\indexController::class,'index'])->name('region-data');
Route::post('/city', [QuarterController::class,'cityData'])->name('city-data');
Route::post('/quarter', [QuarterController::class,'quarterData'])->name('quarter-data');
Route::post('/street', [QuarterController::class,'streetData'])->name('street-data');
Route::post('/settings', [QuarterController::class,'create'])->name('add-quarter-info');
Route::post('/citizen',[CitizenController::class,'store'])->name('create-citizen');

Route::post('/citizen-login',[LoginController::class,'citizensLogin'])->name('citizens-check');
Route::get('/citizen-profile',[LoginController::class,'showCitizensLoginForm'])->name('citizen-profile');
Route::group(['middleware'=>'auth:citizens'],function (){
    Route::get('/citizen-profile-info',[CitizenProfileController::class,'index'])->name('citizen-profile-logged')->middleware('auth:citizens');
    Route::post('/update-citizen',[CitizenProfileController::class,'update'])->name('update-citizen');
});

Route::get('/',[indexController::class,'index']);
Route::post('/index-city', [indexController::class,'cityData'])->name('index-city-data');
Route::post('/index-quarter', [indexController::class,'quarterData'])->name('index-quarter-data');
Route::post('/index-street', [indexController::class,'streetData'])->name('index-street-data');
Route::post('/index-house', [indexController::class,'houseData'])->name('index-house-data');
Route::post('/index-house-location', [indexController::class,'locationData'])->name('index-house-location');

Auth::routes([
    'register' => true
]);
//Auth::routes();
Route::group(['middleware'=>'auth'],function (){
    Route::get('/qaurter-profile-info',[\App\Http\Controllers\QuarterProfileController::class,'index'])->name('quarter-profile-info');
    Route::get('/qaurter-citizens-info/{street_id}', [\App\Http\Controllers\QuarterProfileController::class,'citizenInfo'])->name('quarter-citizens-info');
});



// Route::post('/file',[ExcelFileController::class,'import'])->name('file-get');



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


