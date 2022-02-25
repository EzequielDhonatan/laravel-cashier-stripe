<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Panel\{

    /* PANEL
    ================================================== */
    Stripe\Subscription\SubscriptionController,

};

Route::group(
    [
        'prefix'        => 'panel',
        'middleware'    => 'auth'
    ],

    function () {

    /* SUBSCRIPTION
    ================================================== */
    Route::get( 'stripe/subscription/checkout', [ SubscriptionController::class, 'checkout' ] )->name( 'subscription.checkout' );
    Route::get( 'stripe/subscription/premium', [ SubscriptionController::class, 'premium' ] )->name( 'subscription.premium' );

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
