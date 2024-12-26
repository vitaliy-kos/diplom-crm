<?php
namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Crm\Log\CreateLog;
use App\Http\Controllers\ExternalApi\Telegram;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\ClientRequest;
use App\Models\Order;
use App\Models\OrderMeta;
use App\Models\Phone;
use App\Models\Site;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class Core extends Controller
{
    public function registerNewClientRequest($type, $name, $phone, $message, $link, $city, $service, $site_url, $utm, $uid, $ip, $timeStart, $uniqueKey, $toNumber) {

        $phone = preg_replace( '/[^0-9]/', '', $phone);
        
        $dateStart = match ($type) {
            'phone' => date("Y-m-d H:i:s", $timeStart + 3*60*60),
            default => date("Y-m-d H:i:s", time()),
        };

        $client = Client::where('phone', '=', $phone)
                        ->where('additional_phone', '=', $phone, 'OR')
                        ->first();

        if (!$client) {
            $type_call = '*НОВЫЙ*';

            // Детектируем город по строке и получаем id если обнаружен
            $city = City::where('name_en', '=', $city)->first();
            $city_id = $city?->id;
            
            // Создаем нового клиента
            $client = Client::create([
                'first_name' => $name,
                'phone' => $phone,
                'city_id' => $city_id,
                'spam' => 0,
                'created_at' => $dateStart
            ]);
            ClientAddress::firstOrCreate(['client_id' => $client->id]);
            CreateLog::add($client, Route::currentRouteAction(), '');
        } else {
            $type_call = 'ПОВТОРНЫЙ';
        }

        $order = Order::where('client_id', '=', $client->id)
                      ->where('status_id', '<>', 4)
                      ->where('status_id', '<>', 5)
                      ->first();

        if (!$order) {

            // Детектируем сайт
            switch ($type) {
                case 'call':
                    $phone_detected = Phone::where('number', '=', $toNumber)->first();
                    $site_id = $phone_detected?->site_id;
                    break;
                default:
                    $site = Site::where('url', 'LIKE', "%$site_url%")->first();
                    $site_id = $site?->id;
                    break;
            }

            $order = Order::create([
                'client_id' => $client->id,
                'status_id' => 1,
                'date_creation' => $dateStart,
                'site_id' => $site_id
            ]);

            if (!empty($utm)) OrderMeta::create([
                'order_id' => $order->id, 
                'key' => 'utm',
                'value' => $utm
            ]);
            if (!empty($uid)) OrderMeta::create([
                'order_id' => $order->id, 
                'key' => 'uid',
                'value' => $uid
            ]);
            if (!empty($ip)) OrderMeta::create([
                'order_id' => $order->id, 
                'key' => 'ip',
                'value' => $ip
            ]);
            
            CreateLog::add($order, Route::currentRouteAction(), '');
        }

        $site = Site::where('id', '=', $order->site_id)->first();
        $site_url = substr($site->url, 0, -3);

        ClientRequest::create([
            'client_id' => $client->id,
            'order_id' => $order->id,
            'type' => $type,
            'date_start' => $dateStart,
            'unique_key' => $uniqueKey,
            'site_page' => $link,
            'message' => $message,
            'from_number' => $phone,
            'to_number' => $toNumber,
        ]);

        $tg = new Telegram();

        switch ($type) {
            case 'call':
                $tg->send_message("Посутпил $type_call входящий вызов по сайту *$site_url* от клиента: " . convertPhoneToFormated($phone));
                break;

            default:
                $tg->send_message($message);
                break;
        }
    }

    public function finishCallRequest($entry_id, $end_time, $phone, $isMissedCall, $create_time, $talk_time) {

        $request = ClientRequest::where('unique_key', '=', $entry_id)->first();

        $request->update([
            'duration_call' => $isMissedCall ? 0 : $end_time - $talk_time,
            'date_finish' => $isMissedCall ? null : date("Y-m-d H:i:s", $end_time + 3*60*60)
        ]);

        $order = Order::where('id', '=', $request->order_id)->first();
        $site = Site::where('id', '=', $order->site_id)->first();
        $site_url = substr($site->url, 0, -3);

        $tg = new Telegram();
        if ($isMissedCall) {

			$tg->send_message("*ПРОПУЩЕННЫЙ* по сайту *$site_url* от клиента: " . convertPhoneToFormated($phone));

        } else {

            $tg->send_message("Завершился разговор по сайту *$site_url* с клиентом: " . convertPhoneToFormated($phone));
        }
    }

    public function writeLog($log_channel, $content) {
        Log::channel($log_channel)->info('Время запроса: ' . date( 'd.m.Y H:i:s', time()) . ' - ' . $content .  "\n\n");

        return true;
    }

    public function saveRecordingIdToRequest($recording, $unique) {

        $request = ClientRequest::where('unique_key', '=', $unique)->first();

        $request->update([
            'record_link' => $recording
        ]);

    }
}