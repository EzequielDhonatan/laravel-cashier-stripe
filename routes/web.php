<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\{

    /* SITE
    ================================================== */
    SiteController,

};

use App\Http\Controllers\Panel\{

    /* PANEL
    ================================================== */
    Cashier\Stripe\Subscription\SubscriptionController,

};

Route::group(
    [
        'prefix'        => 'panel',
        'middleware'    => 'auth'
    ],

    function () {

    /* Cashier | Stripe
    ================================================== */
    Route::get( 'panel/cashier/stripe/subscription/checkout', [ SubscriptionController::class, 'checkout' ] )->name( 'subscription.checkout' )->middleware( [ 'check.choice.plan' ] ); ## Subscrition - checkout
    Route::post( 'panel/cashier/stripe/subscription/store', [ SubscriptionController::class, 'store' ] )->name( 'subscription.store' )->middleware( [ 'check.choice.plan' ] ); ## Subscrition - store

    Route::get( 'cashier/stripe/subscription/premium', [ SubscriptionController::class, 'premium' ] )->name( 'subscription.premium' )->middleware( ['subscribed' ] ); ## Subscrition - Premium

    Route::get( 'cashier/stripe/subscription/invoices', [ SubscriptionController::class, 'invoices' ] )->name( 'subscription.invoice' ); ## Subscrition - Invoice
    Route::get( 'cashier/stripe/subscription/invoice/{invoice}', [ SubscriptionController::class, 'invoiceDownload' ] )->name( 'subscription.invoice.download' ); ## Subscrition - Invoice Download

    Route::get( 'cashier/stripe/subscription/cancel', [ SubscriptionController::class, 'cancel' ] )->name( 'subscription.cancel' ); ## Subscrition - Cancel
    Route::get( 'cashier/stripe/subscription/resume', [ SubscriptionController::class, 'resume' ] )->name( 'subscription.resume' ); ## Subscrition - Resume

});

Route::get( '/', [ SiteController::class, 'home' ] )->name( 'site.home' ); ## Site - Home
Route::get( '/assinar/{url}', [ SiteController::class, 'createSessionPlan' ] )->name( 'choice.plan' ); ## Choice - Plan

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
