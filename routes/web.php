<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Panel\{

    /* PANEL
    ================================================== */
    Cashier\Stripe\Subscription\SubscriptionController,

};

Route::group(
    [
        'prefix'        => 'panel'
    ],

    function () {

    /* Cashier [Stripe]
    ================================================== */
    Route::resource( 'panel/cashier/stripe/subscription', SubscriptionController::class )->middleware( 'auth' ); ## Subscrition

    /* Cashier [Stripe]
    ================================================== */
    Route::get( 'cashier/stripe/subscription/account', [ SubscriptionController::class, 'account' ] )->name( 'subscription.account' ); ## Account
    Route::get( 'cashier/stripe/subscription/invoice/{invoice}', [ SubscriptionController::class, 'invoiceDownload' ] )->name( 'subscription.invoice.download' ); ## Invoice
    Route::get( 'cashier/stripe/subscription/cancel', [ SubscriptionController::class, 'cancel' ] )->name( 'subscription.cancel' ); ## Cancel
    Route::get( 'cashier/stripe/subscription/resume', [ SubscriptionController::class, 'resume' ] )->name( 'subscription.resume' ); ## Resume
    Route::get( 'cashier/stripe/subscription/premium', [ SubscriptionController::class, 'premium' ] )->middleware( 'subscribed' )->name( 'subscription.premium' ); ## Subscrition [Premium]

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
