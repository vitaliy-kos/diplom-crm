<?php

namespace App\Http\Controllers\Crm\ClientRequest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\City;
use App\Models\ClientRequest;

class ShowController extends Controller
{
    public function __invoke(ClientRequest $clientRequest)
    {

        return view('crm.clientRequest.show', compact(
            'clientRequest'
        ));
    }
}
