<?php
namespace App\Http\Controllers\Api\V1\Mango\Events;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Core;
use App\Http\Controllers\ExternalApi\Mango;

class RecordingController extends Controller {

    function __invoke() {

        $Core = new Core;
        $mango = new Mango;

        if ( $mango->checkApiKey($_POST['vpbx_api_key']) ){

            $data = json_decode(stripslashes($_POST['json']), true);
        
            if ( $data['recording_state'] == 'Completed' ){

                $Core->saveRecordingIdToRequest($data['recording_id'], $data['entry_id']);
        
            }
        }

        $Core->writeLog('phone-calls', ' - api/events/recording - ' . print_r($data, true));
        
        http_response_code(200);
        echo json_encode(['status' => 'ok', 'message' => 'Request success.']);
    }
}