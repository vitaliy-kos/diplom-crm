<?php
namespace App\Http\Controllers\Api\V1\App\CallRecording;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExternalApi\Mango;
use App\Models\ClientRequest;

class IndexController extends Controller {

    function __invoke() {
        $mango = new Mango;
        
        $unique = $_POST['unique'];

        if (!empty($unique) ){

            $request = ClientRequest::where('unique_key', '=', $unique)->first();

            $data = [
                'link' => $mango->getCallRecord($request->record_link)
            ];
            
            return response()->json(['status' => 200, 'data' => $data]);
        
        } else {
            return response()->json(['status' => 401, 'data' => 'No unique key.']);
        }
        
    }
}