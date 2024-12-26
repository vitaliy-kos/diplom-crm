<?php

namespace App\Http\Controllers\Crm\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\City;
use App\Models\Order;

class ShowController extends Controller
{
    public function __invoke(Order $order)
    {
        return app()->call(
            EditController::class, 
            [
                'order' => $order, 
                'edit' => false
            ]
        );
    }
}
