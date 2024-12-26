<?php

namespace App\Http\Controllers\Crm\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\Client;
use Illuminate\Support\Facades\Route;

class DeleteController extends Controller
{
    public function __invoke(Client $client)
    {
        $client->delete();

        CreateLog::add($client, Route::currentRouteAction(), '');

        return redirect()->route('crm.client.index');
    }
}
