<?php
namespace App\Http\Controllers\ExternalApi;

use App\Models\Setting;

class Mango extends ExternalApi {

    /**
     * @var string
     */
    protected $mango_base_url = 'https://app.mango-office.ru/vpbx/';
    /**
     * @var null|string
     */
    protected $vpbx_api_key;
    /**
     * @var null|string
     */
    protected $vpbx_api_salt;

    public function __construct() {
        
        $this->vpbx_api_key = Setting::where('key', '=', 'mango_vpbx_api_key')->first()?->value;
		$this->vpbx_api_salt = Setting::where('key', '=', 'mango_vpbx_api_salt')->first()?->value;

    }

    public function check() {
        return $this->getBalans() !== false;
    }

    public function checkApiKey($key) {
        return $this->vpbx_api_key = $key;
    }

    public function getBalans() {

        $method = 'account/balance';
        $data = [];

        $response = $this->sendMangoRequest($method, $data);

        return isset(explode('balance":', $response )[1]) ? explode( ',', explode('balance":', $response )[1])[0] : false;

    }

    public function getCallRecord($recording_id) {

        $method = 'queries/recording/post/';
        $data = [
            "recording_id" => $recording_id,
            "action" => "play"
        ];

        $response = $this->sendMangoRequest($method, $data);

        return substr( explode('X-Request-Id', substr($response, strripos($response,'location') + 10))[0], 0, -2 );

    }


    public function getPhoneNumbers() {

        $method = 'incominglines';
        $data = [];

        $response = $this->sendMangoRequest($method, $data);
        
        return json_decode(substr($response, strpos($response, '{')), true);

    }


    // Метод переадресации звонка

    public function redirectToNumber($call_id, $target_number) {

        $method = 'commands/route';
        $data = [
            "command_id" => "{$call_id}_to_$target_number",
            "call_id" => $call_id,
            "to_number" => $target_number
        ];

        $response = $this->sendMangoRequest($method, $data);

        return $response;

    }

    // Private methods

    public function sendMangoRequest($method, $data) {

        $postdata = $this->getPostData($data);

        $post = http_build_query($postdata);

        $ch = curl_init("{$this->mango_base_url}$method");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HEADER,1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        $response = curl_exec($ch);
        curl_close($ch);

        // $this->logResponse($response, $method);

        return $response;

    }

    protected function getPostData($data) {

        $json = json_encode($data);

        $sign = $this->getSign($json);

        $postdata = [
            'vpbx_api_key' => $this->vpbx_api_key,
            'sign' => $sign,
            'json' => $json
        ];

        return $postdata;
    }

    protected function getSign($json) {

        return hash('sha256', $this->vpbx_api_key . $json . $this->vpbx_api_salt);

    }

    protected function logResponse($response, $method = '') {

        $log_file = __DIR__ . '../../../Logs/log.txt';
        $date = 'Время запроса: ' . date('d.m.Y H:i:s');

        $content  = $date . ' - ' . $method . ' - ' . $response . "\n" . file_get_contents($log_file);

        file_put_contents($log_file, $content);

    }




}