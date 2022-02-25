<?php

namespace App\Http\Controllers\Panel\Stripe\Subscription;

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
        return view( 'panel.stripe.subscription.checkout' );
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
        return view( 'panel.stripe.subscription.premium' );
    }

} // SubscriptionController
