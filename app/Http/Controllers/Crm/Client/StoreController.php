<?php

namespace App\Http\Controllers\Crm\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Client\StoreRequest;
use App\Models\Client;
use App\Models\ClientAddress;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['created_at'] = date('Y-m-d H:i:s', strtotime('+3 hours'));
        $data['spam'] = 0;

        $client = Client::firstOrCreate($data);
        ClientAddress::firstOrCreate(['client_id' => $client->id]);

        CreateLog::add($client, Route::currentRouteAction(), '');

        return redirect()->route('crm.client.index');
    }
}
