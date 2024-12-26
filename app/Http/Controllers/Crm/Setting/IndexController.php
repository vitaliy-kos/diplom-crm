<?php

namespace App\Http\Controllers\Crm\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class IndexController extends Controller
{
    public function __invoke()
    {
        $settings = Setting::all()->keyBy('key');

        return view('crm.setting.index', compact(
            'settings',
        ));
    }
}
