<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login', 301);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['2fa'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'],)->name('home');
    Route::post('/2fa', function () {
        return redirect(route('home'));
    })->name('2fa');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('/2fa/enable', 'Google2FAController@enableTwoFactor');
Route::get('/2fa/disable', 'Google2FAController@disableTwoFactor');
Route::get('/2fa/validate', 'AuthAuthController@getValidateToken');
Route::post('/2fa/validate', ['middleware' => 'throttle:5', 'uses' => 'AuthAuthController@postValidateToken']);

Route::get('/profil', [App\Http\Controllers\Auth\ProfilViewController::class, 'index'],)->name('profilView');
Route::get('/test', [TestController::class, 'test'])->name('test');

Route::group(['prefix'=>'2fa'], function(){
    Route::get('/','App\Http\Controllers\LoginSecurityController@show2faForm');
    Route::post('/generateSecret','App\Http\Controllers\LoginSecurityController@generate2faSecret')->name('generate2faSecret');
    Route::post('/enable2fa','App\Http\Controllers\LoginSecurityController@enable2fa')->name('enable2fa');
    Route::post('/disable2fa','App\Http\Controllers\LoginSecurityController@disable2fa')->name('disable2fa');

    // 2fa middleware
    Route::post('/2faVerify', function () {
        return redirect(URL()->previous());
    })->name('2faVerify')->middleware('2fa');
});

// test middleware
Route::get('/test_middleware', function () {
    return "2FA middleware work!";
})->middleware(['auth', '2fa']);
