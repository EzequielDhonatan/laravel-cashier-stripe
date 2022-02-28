<?php

namespace App\Http\Controllers\Api\V1\Site\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Api\V1\Site\Contact\StoreUpdateFormRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Site\Contact;

class ContactController extends Controller
{
    public function sendContact( StoreUpdateFormRequest $request )
    {
        Mail::send( new Contact( $request->all() ) );

        return response()->json( [ 'message' => 'success' ] );
    }

} // ContactController
