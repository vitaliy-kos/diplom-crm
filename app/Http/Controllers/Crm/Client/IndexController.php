<?php

namespace App\Http\Controllers\Crm\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\Client\IndexRequest;
use App\Models\City;
use App\Models\Client;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request, $filter = '')
    {
        $per_page = 10;

        $query = Client::orderBy('id', 'desc');
        
        $query = match ($filter) {
            'spam' => $query->where('spam', '=', true),
            default => $query->where('spam', '=', false),
        };
        
        if ($request->filled('que')) {
            $query = $this->addFilter($query, $request);
        }
        
        $clients = $query->paginate($per_page);

        return view('crm.client.index', compact(
            'request', 
            'clients',
        ));
    }

    private function addFilter($query, $request)
    {
        return $query->where('phone', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('additional_phone', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('first_name', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('last_name', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('middle_name', 'LIKE', "%{$request->get('que')}%")
              ->orWhere('address', 'LIKE', "%{$request->get('que')}%");
    }


}
