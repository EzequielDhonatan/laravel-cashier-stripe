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

    public function index()
    {
        $plans = $this->repository->with( 'features' )->get();

        return view( 'site.home.index', compact( 'plans' ) );
    }

} // SiteController
