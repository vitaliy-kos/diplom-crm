<?php

namespace App\Http\Controllers\Crm\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Requests\Crm\Order\StoreRequest;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Support\Facades\Route;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['status_id'] = Status::name('not_processed')->id;
        $order = Order::firstOrCreate($data);

        CreateLog::add($order, Route::currentRouteAction(), '');

        return redirect()->route('crm.order.index');
    }
}
