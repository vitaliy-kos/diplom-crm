<?php

namespace App\Http\Controllers\Crm\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\Client\IndexRequest;
use App\Models\Order;
use App\Models\Site;
use App\Models\Status;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request, $filter = '')
    {
        $per_page = 10;

        $query = Order::orderBy('orders.id', 'desc');
        
        if ($request->filter) {
            $query = $query->where('orders.status_id', '=', $request->filter);
        }

        if ($request->filled('site')) {
            $query = $query->where('orders.site_id', '=', $request->get('site'));
        }
        if ($request->filled('que')) {
            $query = $this->addFilter($query, $request);
        }
        
        $orders = $query->paginate($per_page);

        $status = $request->filter ? Status::id($request->filter) : null;

        $sites = Site::all();

        return view('crm.order.index', compact(
            'orders',
            'request',
            'status',
            'sites'
        ));
    }

    private function addFilter($query, $request)
    {
        return $query->join('clients', 'orders.client_id', '=', 'clients.id')
              ->where('clients.phone', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('clients.additional_phone', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('clients.first_name', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('clients.last_name', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('clients.middle_name', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('clients.address', 'LIKE', "%{$request->get('que')}%");
    }


}
