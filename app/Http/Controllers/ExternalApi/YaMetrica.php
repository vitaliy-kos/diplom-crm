<?php
namespace App\Http\Controllers\ExternalApi;

use App\Models\OfflineConversion;
use App\Models\Setting;
use CURLFile;
use Exception;

class YaMetrica extends ExternalApi {
	protected $clientLogin;
	protected $token;
	protected $url_stat = "https://api-metrika.yandex.net/stat/v1/data/bytime?";
	protected $url_management = "https://api-metrika.yandex.net/management/v1/counter";
	protected $today;

	protected $one_call_filename = "logs/data_one_call.csv";
	protected $success_order_filename = "logs/data_one_success_order.csv";
	
	public function __construct() {

		$this->clientLogin = Setting::value('yametrica_login');
		$this->token = Setting::value('yametrica_token');
		$this->today = date('Y-m-d', strtotime('3 hours'));
	}

	public function check() {
		return $this->getStats('today', 'today') != null;
	}

	public function getTodayStats() {

		return $this->getStats('today', 'today')['totals'];

	}

	public function getStats($start, $finish, $metrics = '', $group = '') {

		if ($start == 'today' && $finish == 'today') {
			$start = $this->today;
			$finish = $this->today;
		} else {
			$start = date('Y-m-d', strtotime($start));
			$finish = date('Y-m-d', strtotime($finish));
		}

		if (empty($metrics)) {
			$metrics = 'ym:s:visits,ym:s:pageviews,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDurationSeconds';
		}

		if (empty($group)) {
			$group = 'day';
		}

		$params = [
			'ids' => $this->clientLogin,
			'metrics' => $metrics,
			'date1' => $start,
			'date2' => $finish,
			'group' => $group,
		];

		$response = $this->sendGetRequest($params, $this->url_stat);

		return empty($response["errors"]) ? $response : null;
	}

	public function getStatusOfflineConversion($id, $type) {

		if ($type == 'call') {
			$url = "{$this->url_management}/{$this->clientLogin}/offline_conversions/calls_uploading/$id";
		} else {
			$url = "{$this->url_management}/{$this->clientLogin}/offline_conversions/uploading/$id";
		}

		return $this->sendGetRequest([], $url);
	}


	public function sendCallOfflineConversion($clientId, $timestamp, $price, $phone_clear, $duration, $firstTime, $url, $isMissedCall) {

		$this->createOneCallCsvFileToUpload($clientId, $timestamp, $price, $phone_clear, $duration, $firstTime, $url, $isMissedCall);

		return $this->sendFile($this->one_call_filename, "offline_conversions/upload_calls");

	}

	public function sendOrderOfflineConversion($clientId, $timestamp, $price) {

		$this->createOneOrderCsvFileToUpload($clientId, 'order_success', $timestamp, $price);

		return $this->sendFile($this->success_order_filename, "offline_conversions/upload");

	}

	public function sendGetRequest($params, $url) {

		if (empty($this->clientLogin) || empty($this->token)) throw new Exception("Не заполнены данные для подключения!");

		ob_implicit_flush();

		$body = urldecode(http_build_query($params));

		$ch = curl_init("$url$body");
		curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: OAuth {$this->token}"]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$res = curl_exec($ch);
		curl_close($ch);
			
		$res = json_decode($res, true);

		return $res;

	}

	public function sendFile($filePath, $url) {

		if (empty($this->clientLogin) || empty($this->token)) throw new Exception("Не заполнены данные для подключения!");

		$curl = curl_init("{$this->url_management}/{$this->clientLogin}/$url");

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, [
            'file' => new CURLFile($filePath, 'text/csv')
        ]);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type: multipart/form-data", "Authorization: OAuth {$this->token}"
        ]);

        $result = curl_exec($curl);
		curl_close($curl);

        $result = json_decode($result, true);

		return $result;
	}

	protected function createOneOrderCsvFileToUpload($clientId, $target, $timestamp, $price) {

		$headers = [
            "ClientId",
            "Target",
            "DateTime",
			"Price",
            "Currency",
        ];

		$lines = [
            $headers,
            [
				$clientId,
				$target,
				$timestamp,
				$price,
				"RUB",
			],
        ];

		$f = fopen($this->success_order_filename, "w");
        foreach ($lines as $line) {
            fputcsv($f, $line);
        }
        fclose($f);

	}

	protected function createOneCallCsvFileToUpload($clientId, $timestamp, $price, $phone, $duration, $firstTime, $url, $isMissedCall) {

		$headers = [
            "StaticCall",
            "ClientId",
            "DateTime",
            "Price",
            "Currency",
            "PhoneNumber",
            "TalkDuration",
            "CallMissed",
            "Tag",
            "FirstTimeCaller",
            "URL",
        ];

		$lines = [
            $headers,
            [
				"0",
				$clientId,
				$timestamp,
				$price,
				"RUB",
				"+$phone",
				$duration,
				$isMissedCall,
				"success_call",
				$firstTime,
				$url,
			],
        ];

		$f = fopen($this->one_call_filename, "w");
        foreach ($lines as $line) {
            fputcsv($f, $line);
        }
        fclose($f);

	}

}