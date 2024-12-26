<?php

namespace App\Http\Controllers\Crm\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Models\Client;
use Illuminate\Support\Facades\Route;

class SpamController extends Controller
{
    public function __invoke(Client $client, $return = 'client', $id_return = false)
    {
        $client->toggleSpam();

        CreateLog::add($client, Route::currentRouteAction(), '');

        return redirect()->route("crm.$return.edit", $id_return ? $id_return : $client);
    }
}
