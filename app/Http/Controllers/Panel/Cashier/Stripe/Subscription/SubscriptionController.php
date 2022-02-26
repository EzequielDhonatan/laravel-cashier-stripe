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
    public function index()
    {
        if ( auth()->user()->subscribed( 'default' ) )
            redirect()->route( 'subscription.premium' );

        return view( 'panel.cashier.stripe.subscription.index', [
            'intent'    => auth()->user()->createSetupIntent(),
            'plan'      => session( 'plan' )
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
        $plan = session( 'plan' );

        $request->user()
                    ->newSubscription( 'default', $plan->stripe_id )
                    ->create( $request->token );

        return redirect()->route( 'subscription.premium' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        //
    }

    public function premium()
    {
        return view( 'panel.cashier.stripe.subscription.premium' );
    }

    public function account()
    {
        $invoices = auth()->user()->invoices();

        return view( 'panel.cashier.stripe.subscription.account', compact( 'invoices' ) );
    }

    public function invoiceDownload( $invoiceId )
    {
        return auth()->user()
                            ->downloadInvoice( $invoiceId, [
                                'vendor'    => 'Laravel Cashier - Stripe',
                                'product'   => 'Assinatura VIP'
                            ]);
    }

    public function cancel()
    {
        auth()->user()->subscription( 'default' )->cancel();

        return redirect()->route( 'subscription.account' );
    }

    public function resume()
    {
        auth()->user()->subscription( 'default' )->resume();

        return redirect()->route( 'subscription.account' );
    }

} // SubscriptionController
