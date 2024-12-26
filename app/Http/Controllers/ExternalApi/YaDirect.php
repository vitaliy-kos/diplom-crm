<?php
namespace App\Http\Controllers\ExternalApi;

use App\Models\Setting;
use Exception;

class YaDirect extends ExternalApi {
	protected $clientLogin;
	protected $token;
	protected $url_v5 = "https://api.direct.yandex.ru/json/v5/";
	protected $url_v4 = "https://api.direct.yandex.ru/live/v4/json/";
	protected $today;

	// protected $url = "https://api-sandbox.direct.yandex.com/json/v5/reports";
	// $date = date("Y-m-d-H-i-s")
	// protected $report_name = $date;

	public function __construct() {

		$this->clientLogin = Setting::value('yadirect_login');
		$this->token = Setting::value('yadirect_token');
		$this->today = date('Y-m-d', strtotime('3 hours'));

	}

	public function check() {
		return $this->getTodayExpenses() != null;
	}

	public function getTodayExpenses() {

		$params = [
			"params" => [
				"SelectionCriteria" => [
					"DateFrom" => $this->today,
					"DateTo" => $this->today
				],
				"FieldNames" => ["Cost"],
				"ReportName" => "report_today_expenses" . date('H:i:s', strtotime('3 hours')),
				"ReportType" => "CUSTOM_REPORT",
				"DateRangeType" => "CUSTOM_DATE",
				"Format" => "TSV",
				"IncludeVAT" => "YES",
				"IncludeDiscount" => "NO"
			]
		];

		$response = $this->sendRequest($params, 'reports', 5);
		$response = explode("\n", $response);

		$error = !empty(json_decode($response[0])?->error?->error_code);

		return !$error ? $response[1] : null;
	}

	public function getDirectExpensesByDays($start, $finish) {

		$start = date('Y-m-d', strtotime($start));
		$finish = date('Y-m-d', strtotime($finish));

		$params = [
			"params" => [
				"SelectionCriteria" => [
					"DateFrom" => $start,
					"DateTo" => $finish
				],
				"FieldNames" => ["Cost", "Date"],
				"ReportName" => "report_expenses_by_days_" . date('H:i:s', strtotime('3 hours')),
				"ReportType" => "CUSTOM_REPORT",
				"DateRangeType" => "CUSTOM_DATE",
				"Format" => "TSV",
				"IncludeVAT" => "YES",
				"IncludeDiscount" => "NO"
			]
		];

		$expenses = $this->sendRequest($params, 'reports', 5);
		$expenses = array_slice(explode("\n", $expenses), 1, -1);
		$result = [];

		foreach ($expenses as $value) {
			$exp = explode("	", $value);
			$result[$exp[1]] = [$exp[1], $exp[0]];
		}

		return $result;
	}

	public function getDirectExpensesByMonth($start, $finish) {

		$start = date('Y-m-d', strtotime($start));
		$finish = date('Y-m-d', strtotime($finish));

		$params = [
			"params" => [
				"SelectionCriteria" => [
					"DateFrom" => $start,
					"DateTo" => $finish
				],
				"FieldNames" => ["Cost", "Month"],
				"ReportName" => "report_expenses_by_month_" . date('H:i:s', strtotime('3 hours')),
				"ReportType" => "CUSTOM_REPORT",
				"DateRangeType" => "CUSTOM_DATE",
				"Format" => "TSV",
				"IncludeVAT" => "YES",
				"IncludeDiscount" => "NO"
			]
		];

		$expenses = $this->sendRequest($params, 'reports', 5);
		$expenses = array_slice(explode("\n", $expenses), 1, -1);
		$result = [];

		foreach ($expenses as $value) {
			$exp = explode("	", $value);
			$result[$exp[1]] = [$exp[1], $exp[0]];
		}

		return $result;
	}

	public function getSummaryExpense($start, $finish) {

		$start = date('Y-m-d', strtotime($start));
		$finish = date('Y-m-d', strtotime($finish));

		$params = [
			"params" => [
				"SelectionCriteria" => [
					"DateFrom" => $start,
					"DateTo" => $finish
				],
				"FieldNames" => ["Cost"],
				"ReportName" => "report_all_expenses" . date('H:i:s', strtotime('3 hours')),
				"ReportType" => "CUSTOM_REPORT",
				"DateRangeType" => "CUSTOM_DATE",
				"Format" => "TSV",
				"IncludeVAT" => "YES",
				"IncludeDiscount" => "NO"
			]
		];

		$expenses = $this->sendRequest($params, 'reports', 5);
		$expenses = explode("\n", $expenses);
		
		return $expenses[1];
	}
	
	public function getBalance() {

		$params = [
			"method" => "AccountManagement",
			"param" => [
				"Action" => "Get"
			],
			"token" => $this->token,
			"locale" => "ru",
		];

		$response = $this->sendRequest($params, '', 4);
		$response = json_decode($response);

		return empty($response->error_code) ? $response->data->Accounts[0]->Amount : null;

	}

	public function getAllCompaigns() {

		$params = [
			"method" => "get",
			"params" => [
				"SelectionCriteria" => [
					"Types" => ["TEXT_CAMPAIGN"],
					"States" => ["ON"],
				],
				"FieldNames" => [
					"Id",
					"Name",
					"Status",
					"State",
					"BlockedIps",
				],
			],
		];

		$response = $this->sendRequest($params, 'campaigns', 5);
		$response = json_decode($response);

		return empty($response->error_code) ? $response : null;

	}

	public function updateCompaigns(array $compaignsIds, ) {

		// $params = [
		// 	"method" => "update",
		// 	"params" => [
		// 		"Campaigns" => [
		// 			"Id" => "",
		// 			"BlockedIps" => [
		// 				"Items" => [

		// 				]
		// 			],
		// 		],
		// 	],
		// 	"token" => $this->token,
		// 	"locale" => "ru",
		// ];

		// $response = $this->sendRequest($params, 'campaigns', 5);
		// $response = json_decode($response);

		// return empty($response->error_code) ? $response : null;

	}

	public function sendRequest($params, $url, $version = 5) {

		if (empty($this->clientLogin) || empty($this->token)) throw new Exception("Не заполнены данные для подключения!");

		ob_implicit_flush();

		$body = json_encode($params);

		$url = match ($version) {
			4 => $this->url_v4,
			5 => "{$this->url_v5}$url",
		};

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url );
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeaders());

		while (true) {

			$result = curl_exec($curl);

			if (!$result) {

				break;

			} 
			else {

				$responseHeadersSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
				$responseHeaders = substr($result, 0, $responseHeadersSize);
				$responseBody = substr($result, $responseHeadersSize);


				$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

				$requestId = preg_match("/RequestId: (\d+)/", $responseHeaders, $arr) ? $arr[1] : false;
				$retryIn = preg_match("/retryIn: (\d+)/", $responseHeaders, $arr) ? $arr[1] : 60;

				if ( $httpCode == 201 || $httpCode == 202 ) {

					sleep($retryIn);

				} else {

					break;

				}
			}

		}

		curl_close($curl);

		return $responseBody;

	}


	public function getHeaders() {

		$headers = [
			"Authorization: Bearer $this->token",
			"Client-Login: $this->clientLogin",
			"Accept-Language: ru",
			"processingMode: auto",
			"returnMoneyInMicros: false",
			"skipReportHeader: true",
			"skipReportSummary: true"
		];

		return $headers;
	}

}