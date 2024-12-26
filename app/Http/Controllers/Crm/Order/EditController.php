<?php

namespace App\Http\Controllers\Crm\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\GetLog;
use App\Models\AgesTechnic;
use App\Models\Brand;
use App\Models\BrokenType;
use App\Models\City;
use App\Models\MetroStation;
use App\Models\Order;
use App\Models\Service;
use App\Models\TechnicsType;

class EditController extends Controller
{
    public function __invoke(Order $order, $edit = true)
    {
        $cities = City::all();
        $technicsTypes = TechnicsType::all();
        $brokenTypes = BrokenType::all();
        $brands = Brand::all();
        $agesTechnic = AgesTechnic::getAll();
        $services = Service::all();
        $metroStations = MetroStation::all();

        $logs = GetLog::getAll($order);
        $sparePartSended = $order->metaByName('spare_parts_sended') == true;
        
        return view('crm.order.edit', compact(
            'order',
            'cities',
            'technicsTypes',
            'brokenTypes',
            'metroStations',
            'services',
            'brands',
            'agesTechnic',
            'sparePartSended',
            'edit',
            'logs'));
    }
}
