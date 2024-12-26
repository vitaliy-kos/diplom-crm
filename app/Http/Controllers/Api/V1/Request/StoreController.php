<?php
namespace App\Http\Controllers\Api\V1\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Core;

class StoreController extends Controller {

    function __invoke() {
        
        $Core = new Core;

        $message = $_POST['text_short'] ?? 'Пустое сообщение';
        $name = $_POST['name'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $link = $_POST['link'] ?? '';

        $city = $_POST['city'] ?? '';
        $service = $_POST["service"] ?? '';
        $site = $_POST["site"] ?? '';
        $utm = $_POST["utm"] ?? '';
        $uid = $_POST["uid"] ?? '';
        $ip = $_POST["ip"] ?? '';

        $Core->registerNewClientRequest(
            'text', 
            $name, 
            $phone, 
            $message, 
            $link, 
            $city,
            $service,
            $site,
            $utm,
            $uid,
            $ip,
            strtotime('+3 hours'),
            null,
            null
        );

        $Core->writeLog('sites-requests', "Отправлено с сайта ($site) - create/request - " . print_r($_POST, true));

        http_response_code(200);
        // echo json_encode(['status' => 'ok', 'message' => 'Request created.']);
    }
}