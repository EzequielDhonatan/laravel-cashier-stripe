<?php

use Illuminate\Support\Facades\Route;

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

    /* Cashier [Stripe]
    ================================================== */
    Route::resource( 'cashier/stripe/subscription', SubscriptionController::class ); ## Subscrition
    Route::get( 'cashier/stripe/subscription/premium', [ SubscriptionController::class, 'premium' ] )->name( 'subscription.premium' ); ## Subscrition [Premium]

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
