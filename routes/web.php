<?php

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
Route::get('/complete-registration', [App\Http\Controllers\Auth\RegisterController::class, 'completeRegistration'])->name('complete-registration');

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

