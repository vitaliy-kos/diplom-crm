<?php
namespace App\Http\Controllers\Api\V1\Mango\Events;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Core;
use App\Http\Controllers\ExternalApi\Mango;

class CallController extends Controller {

    function __invoke() {

        $Core = new Core;
        $mango = new Mango;

        if ( $mango->checkApiKey($_POST['vpbx_api_key']) ){

            $data = json_decode(stripslashes($_POST['json']), true);
        
            if ($data['call_state'] == 'Appeared' && $data['location'] == 'ivr') {

                // Регистрация обращения
                $Core->registerNewClientRequest(
                    'call', 
                    null, 
                    $data['from']['number'], 
                    null, 
                    null, 
                    null,
                    null, 
                    null, 
                    null,
                    null,
                    null,
                    $data['timestamp'],
                    $data['entry_id'],
                    $data['to']['number']
                );

            }
        }

        $Core->writeLog('phone-calls', ' - api/events/call - ' . print_r($data, true));
        
        http_response_code(200);
        echo json_encode(['status' => 'ok', 'message' => 'Request success.']);
    }
}