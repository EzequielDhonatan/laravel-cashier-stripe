<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Plan\Plan;

class SiteController extends Controller
{
    protected $repository;

    public function __construct( Plan $model )
    {
        $this->repository = $model;
    }

    public function home()
    {
        $plans = $this->repository->with( 'features' )->get();

        return view( 'site.home', compact( 'plans' ) );
    }

    public function createSessionPlan( $urlPlan )
    {
        if( !$plan = $this->repository->where( 'url', $urlPlan )->first() ) {
            return redirect()->route( 'site.home' );
        };

        session()->put( 'plan', $plan );

        return redirect()->route( 'subscription.checkout' );
    }

} // SiteController
