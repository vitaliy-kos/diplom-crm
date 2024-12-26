<?php
namespace App\Http\Controllers\ExternalApi;

use App\Models\Setting;

class Telegram extends ExternalApi {
	protected string $base_url = 'https://api.telegram.org/bot';
	protected string $token;
	protected string $chat_id;

	public function __construct() {

		$this->token = Setting::where('key', '=', 'telegram_token')->first()?->value;
		$this->chat_id = Setting::where('key', '=', 'telegram_notify_chat_id')->first()?->value;

	}

	public function send_message($message, $recipient = null) {

		$method = 'sendMessage';

		$data = [
			'chat_id' => $recipient ?? $this->chat_id,
			'text' => $message,
			'parse_mode' => 'markdown',
		];

		$response = $this->sendGetRequest($method, $data);
		$response = json_decode($response, true);

		return;
	}

	public function getMe() {
		$method = 'getMe';

		$data = [];

		$response = $this->sendGetRequest($method, $data);
		$response = json_decode($response, true);

		return $response;
	}

	public function check() {
		$result = $this->getMe();
		return $result['ok'] === true;
	}

	public function sendPostRequest($method, $data) {
		var_dump("{$this->base_url}/{$this->token}/$method");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "{$this->base_url}/{$this->token}/$method");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data) );

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			$error = ' - error - ' . curl_error($ch);
		}
		curl_close($ch);

		return $response;
	}

	public function sendGetRequest($method, $data) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->base_url . $this->token . '/' . $method . '?' . http_build_query($data) );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			$error = ' - error - ' . curl_error($ch);
		}
		curl_close($ch);

		return $response;
	} 
}