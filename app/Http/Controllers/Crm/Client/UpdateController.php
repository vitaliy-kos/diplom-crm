<?php

namespace App\Http\Controllers\Crm\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Client\UpdateRequest;
use App\Models\Client;
use App\Models\ClientAddress;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Client $client)
    {
        $data = $request->validated();

        $client->update($data['client']);

        $client_address = ClientAddress::firstOrCreate(['client_id' => $client->id]);
        $client_address->update($data['address']);

        CreateLog::add($client, Route::currentRouteAction(), '');

        return redirect()->route('crm.client.show', $client);
    }
}
