<?php
namespace App\Http\Controllers\Api\V1\Mango\Events;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Core;
use App\Http\Controllers\ExternalApi\Mango;

class SummaryController extends Controller {

    function __invoke() {

        $Core = new Core;
        $mango = new Mango;

        if ( $mango->checkApiKey($_POST['vpbx_api_key']) ) {

            $data = json_decode(stripslashes($_POST['json']), true);

            $isMissedCall = $data['talk_time'] == 0 ? true : false;

            $Core->finishCallRequest(
                $data['entry_id'], 
                $data['end_time'], 
                $data['from']['number'], 
                $isMissedCall,
                $data['create_time'],
                $data['talk_time'],
            );

            $Core->writeLog('phone-calls', ' - api/events/summary - ' . print_r($data, true));

        }
        
        http_response_code(200);
        echo json_encode(['status' => 'ok', 'message' => 'Request success.']);
    }
}