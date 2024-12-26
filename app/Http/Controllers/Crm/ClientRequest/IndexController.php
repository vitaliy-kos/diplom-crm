<?php

namespace App\Http\Controllers\Crm\ClientRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\Client\IndexRequest;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientRequest;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request, $filter = '')
    {
        $per_page = 10;

        $query = ClientRequest::orderBy('id', 'desc');
        
        $query = match ($filter) {
            'call' => $query->where('type', '=', 'call'),
            'text' => $query->where('type', '=', 'text'),
            default => $query,
        };
        
        if ($request->filled('que')) {
            $query = $this->addFilter($query, $request);
        }
        
        $clientsRequests = $query->paginate($per_page);

        return view('crm.clientRequest.index', compact(
            'request',
            'clientsRequests'
        ));
    }

    // private function addFilter($query, $request)
    // {
    //     return $query->where('phone', 'LIKE', "%{$request->get('que')}%")
    //           ->orWhere('additional_phone', 'LIKE', "%{$request->get('que')}%")
    //           ->orWhere('first_name', 'LIKE', "%{$request->get('que')}%")
    //           ->orWhere('last_name', 'LIKE', "%{$request->get('que')}%")
    //           ->orWhere('middle_name', 'LIKE', "%{$request->get('que')}%")
    //           ->orWhere('address', 'LIKE', "%{$request->get('que')}%");
    // }


}
