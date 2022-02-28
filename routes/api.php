<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\{

    /* SITE
    ================================================== */
    Site\Contact\ContactController, ## CONTACT

};

Route::group(
    [
        'prefix'        => 'v1',
    ],

    function () {

    /* SITE
    ================================================== */
    Route::post( 'contact', [ ContactController::class, 'sendContact' ] ); ## CONTACT

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
