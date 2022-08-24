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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('/profil', [App\Http\Controllers\Auth\ProfilViewController::class, 'index'])->name('profilIndex');
Route::get('/billing', [App\Http\Controllers\Auth\ProfilViewController::class, 'billing'])->name('profilBilling');
Route::get('/security', [App\Http\Controllers\Auth\ProfilViewController::class, 'security'])->name('profilSecurity');
Route::get('/notifications', [App\Http\Controllers\Auth\ProfilViewController::class, 'notifications'])->name('profilNotifications');

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
