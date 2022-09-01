<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\ProfilViewController;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

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

Route::redirect('/', '/home', 301);

Auth::routes();
Auth::routes(['verify' => true]);
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout')->withoutMiddleware('2fa');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware('auth');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::prefix('profil')->group(function () {
    Route::post('/change-password', 'App\Http\Controllers\Profil\ChangePasswordController@reset')->name('changePassword');
    Route::post('/remove/{id}', 'App\Http\Controllers\Profil\RemoveAccountController@remove')->name('removeUserAccount');
    Route::controller(ProfilViewController::class)->group(function () {
        Route::get('/index', 'index')->name('profilIndex');
        Route::get('/billing', 'billing')->name('profilBilling');
        Route::get('/security', 'security')->name('profilSecurity');
        Route::get('/notifications', 'notifications')->name('profilNotifications');
    });
});

Route::get('/test', [TestController::class, 'test'])->name('test');

Route::group(['prefix' => '2fa'], function () {
    Route::get('/', 'App\Http\Controllers\LoginSecurityController@show2faForm');
    Route::post('/generateSecret', 'App\Http\Controllers\LoginSecurityController@generate2faSecret')->name('generate2faSecret');
    Route::post('/enable2fa', 'App\Http\Controllers\LoginSecurityController@enable2fa')->name('enable2fa');
    Route::post('/disable2fa', 'App\Http\Controllers\LoginSecurityController@disable2fa')->name('disable2fa');

    // 2fa middleware
    Route::post('/2faVerify', function () {
        return redirect(URL()->previous());
    })->name('2faVerify')->middleware('2fa');
});

// test middleware
Route::get('/test_middleware', function () {
    return "2FA middleware work!";
})->middleware(['auth', '2fa']);

Route::get('/amount', 'App\Services\CalculAmountController@calculAmount')->name('calculAmount');

