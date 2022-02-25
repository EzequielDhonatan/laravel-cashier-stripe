<?php

namespace App\Http\Controllers\Panel\Cashier\Stripe\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        return view( 'panel.cashier.stripe.subscription.checkout', [
            'intent' => auth()->user()->createSetupIntent()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $request->user()
                    ->newSubscription( 'default', 'price_1KXA2gK91f8nJsGoW36X8djf' )
                    ->create( $request->token );

        return redirect()->route( 'subscription.premium' );
    }

    public function premium()
    {
        return view( 'panel.cashier.stripe.subscription.premium' );
    }

} // SubscriptionController
