<?php

namespace App\Http\Controllers\Crm\Order;

use App\Http\Controllers\Controller;
use App\Models\Client;

class CreateController extends Controller
{
    public function __invoke()
    {
        $clients = Client::all();

        return view('crm.order.create', compact('clients'));
    }
}
