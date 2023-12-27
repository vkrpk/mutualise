<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\ProfilViewController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\MemberAccess\MemberAccessController;
use App\Services\ComparePasswordAndChangeEmailController;
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
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::redirect('/', '/home', 301);

    Auth::routes(['verify' => true]);
    Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout')->withoutMiddleware('2fa');
    Route::post('inscription', 'App\Http\Controllers\Auth\RegisterController@register')->name('inscription');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware('auth');



    Route::prefix('profil')->middleware(['auth', 'verified'])->group(function () {
        Route::post('/change-password', 'App\Http\Controllers\Profil\ChangePasswordController@reset')->name('changePassword');
        Route::post('/remove-account', 'App\Http\Controllers\Profil\RemoveAccountController@remove')->name('removeUserAccount');
        Route::post('/index/store', 'App\Http\Controllers\Profil\StoreInfosController@store')->name('storeInfos');
        Route::post('/index/store-picture', 'App\Http\Controllers\Profil\StoreProfilPictureController@store')->name('profil.store-picture');
        Route::controller(ProfilViewController::class)->group(function () {
            Route::get('/index', 'index')->name('profilIndex');
            Route::get('/billing', 'billing')->name('profilBilling');
            Route::get('/security', 'security')->name('profilSecurity');
            Route::get('/notifications', 'notifications')->name('profilNotifications');
        });
    });

    Route::get('/offers/{id?}', [OfferController::class, 'offers'])->name('offers');

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

    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
        Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
        Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
        Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
    });
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');

    Route::post('order/create', 'App\Http\Controllers\OrderController@create')->name('order.create');
    Route::get('order/store', 'App\Http\Controllers\OrderController@store')->name('order.store');

    Route::post('stripe', "\App\Http\Controllers\StripeController@stripe")->name('stripe');

    Route::get('services', function () { return view('services.index'); })->name('services.index');
    Route::post('serviceUpdate', 'App\Http\Controllers\ServiceController@serviceUpdate')->name('serviceUpdate');

    Route::get('profil/security/email-change-verify', 'App\Http\Controllers\Profil\ChangeEmailController@verify')->name('user.email-change-verify');
    Route::post('profil/security/email-change', 'App\Http\Controllers\Profil\ChangeEmailController@change')->name('user.email-change');

    Route::get('/contact', [ContactFormController::class, 'createForm'])->name('contact.index');
    Route::post('/contact', [ContactFormController::class, 'contactForm'])->name('contact.send');

    Route::get('cguv', [FooterController::class, 'cguv'])->name('footer.cguv');
    Route::get('politique-confidentialite', [FooterController::class, 'politiqueConfidentialite'])->name('footer.politique-confidentialite');

    Route::group(['prefix' => 'member-access', 'middleware' => ['auth', 'verified']], function () {
        Route::get('/index', [MemberAccessController::class, 'index'])->name('access.index');
        Route::post('/create', 'App\Http\Controllers\CurlController@create')->name('member_access.create');
    });

    Route::group(['prefix' => 'orders', 'middleware' => ['auth', 'verified']], function () {
        Route::get('/index', [OrderController::class, 'index'])->name('order.index');
    });
    Route::post('orders/download-facture', 'App\Http\Controllers\OrderController@downloadPDF')->name('order.download-facture');
    Route::post('orders/path-facture', 'App\Http\Controllers\OrderController@getPathForPDF')->name('order.path-facture');

    Route::post('success', "App\Http\Controllers\StripeController@success")->name('stripe.success');

    Route::get('paypal/cancel-payment', 'App\Http\Controllers\PayPalPaymentController@paymentCancel')->name('cancel.payment');
    Route::get('paypal/payment-success', 'App\Http\Controllers\PayPalPaymentController@paymentSuccess')->name('success.payment');
    Route::get('paypal/create-order', 'App\Http\Controllers\PayPalPaymentController@createOrder')->name('success.create-order');

    Route::post('make-payment', 'App\Http\Controllers\PaymentController@handlePayment')->name('make.payment');

    Route::post('payment/free/success', "\App\Http\Controllers\FreePaymentController@success")->name('payment.free.success');
});
