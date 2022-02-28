<?php

namespace App\Http\Controllers\Panel\Cashier\Stripe\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function checkout()
    {
        if ( auth()->user()->subscribed( 'default' ) )
            redirect()->route( 'subscription.premium' );

        return view( 'panel.cashier.stripe.subscription.checkout', [
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

    public function premium()
    {
        return view( 'panel.cashier.stripe.subscription.premium' );
    }

    public function invoices()
    {
        $user = auth()->user();

        $invoices = $user->invoices();

        $subscription = $user->subscription( 'default' );

        return view( 'panel.cashier.stripe.subscription.invoice', compact(
            'user', 'invoices', 'subscription'
        ));
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

        return redirect()->route( 'subscription.invoice' );
    }

    public function resume()
    {
        auth()->user()->subscription( 'default' )->resume();

        return redirect()->route( 'subscription.invoice' );
    }

} // SubscriptionController
