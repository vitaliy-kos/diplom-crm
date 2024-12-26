<?php

namespace App\Http\Controllers\Crm\Status;

use App\Http\Controllers\Controller;
use App\Models\Status;

class IndexController extends Controller
{
    public function __invoke()
    {
        $statuses = Status::all();
        return view('crm.status.index', compact('statuses'));
    }
}
