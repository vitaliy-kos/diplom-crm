<?php
namespace App\Http\Controllers\Api\V1\App\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class UpdateController extends Controller
{

    public function __invoke(Request $request)
    {
        $setting = Setting::firstOrCreate([
            'key' => $request->key
        ], 
        [
            'value' => ''
        ]);

        $setting->update([
            'value' => $request->value
        ]);

        return response()->json(['status' => 200, 'data' => $setting]);
    }


}
