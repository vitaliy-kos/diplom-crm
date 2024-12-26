<?php

namespace App\Http\Controllers\Crm\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Order\UpdateRequest;
use App\Models\ClientAddress;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Order $order)
    {
        $data = $request->validated();
        
        $order->update($data['order']);
        $order->client->update($data['client']);

        $client_address = ClientAddress::firstOrCreate(['client_id' => $order->client->id]);
        $client_address->update($data['address']);

        CreateLog::add($order, Route::currentRouteAction(), '');

        return redirect()->route('crm.order.edit', $order->id);
    }
}
