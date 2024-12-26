<?php
namespace App\Http\Controllers\ExternalApi;

use App\Models\Setting;

class Whatsapp extends ExternalApi {
	protected string $base_url = 'https://wappi.pro/api/';
	protected string $profile_id;
	protected string $token;
	protected string $promed_id = '120363294022025214@g.us';

	public function __construct() {
		
		$this->profile_id = Setting::value('whatsapp_profile_id');
		$this->token = Setting::value('whatsapp_token');
		
	}

	public function send_message($message, $recipient = '') {

		$method = 'sync/message/send';

		$message = [
			"recipient" => empty($recipient) ? $this->promed_id : $recipient,
			"body" => $message
		];

		$response = $this->sendPostRequest($method, $message);

		return;
	}

	public function getMessageById($id) {

		$method = 'sync/messages/id/get';

		$data = [
			"message_id" => $id
		];

		$response = $this->sendGetRequest($method, $data);
		$message = json_decode($response, true)['message'];

		return $message;
	}

	public function getChatByDate($date = '', $chat = '') {

		$method = 'sync/messages/get';

		$data = [
			"chat_id" => empty($chat) ? $this->promed_id : $chat,
			"date" => $date,
			"limit" => 2000,
			"order" => "asc",
		];

		$response = $this->sendGetRequest($method, $data);
		$messages = json_decode($response, true);
		if ($messages) {
			$messages = $messages['messages'];
		}

		return $messages;
	}

	public function getAllChats() {

		$method = 'sync/chats/get';

		$data = [
			"profile_id" => $this->profile_id,
		];

		$response = $this->sendGetRequest($method, $data);
		$chats = json_decode($response, true);

		return $chats;
	}

	public function check() {
		$result = $this->getAllChats();
		return $result['status'] !== 'error';
	}

	public function sendPostRequest($method, $data) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->base_url . $method . '?profile_id=' . $this->profile_id );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data) );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			$error = ' - error - ' . curl_error($ch);
		}
		curl_close($ch);

		return $response;
	}

	public function sendGetRequest($method, $data) {
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->base_url . $method . '?profile_id=' . $this->profile_id . '&' . http_build_query($data) );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders() );
		
		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			$error = ' - error - ' . curl_error($ch);
		}
		curl_close($ch);

		return $response;
	}

	public function getHeaders() {
		return [
			"Accept: application/json",
			"Authorization: {$this->token}",
			"Content-Type: text/plain"
		];
	} 
}