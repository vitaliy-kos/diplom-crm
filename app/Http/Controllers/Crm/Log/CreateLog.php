<?php

namespace App\Http\Controllers\Crm\Log;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CreateLog extends Controller
{
    public static function add(Object $object, string $action, string $action_value)
    {
        $log = new Log();

        $action_array = explode('\\', $action);
        $controller = end( $action_array);
        $action = str_replace("Controller", "", $controller);


        $log->date = Carbon::now()->toDateTimeString();
        $log->object = class_basename($object);
        $log->id_object = $object->id;
        $log->action = $action;
        $log->action_value = $action_value;
        $log->user_id = Auth::user()->id ?? null;

        $log->save();
    }
}
