<?php

use App\Models\ClientAddress;

function convertAddressToString(ClientAddress|null $address) {
    return $address && $address->street && $address->home && $address->flat ? "ул. {$address->street}, д. {$address->home},  кв. {$address->flat}" : "";
}

function convertPhoneToFormated($phone){
    return sprintf("+%s (%s) %s-%s-%s",
    substr($phone, 0, 1),
            substr($phone, 1, 3),
            substr($phone, 4, 3),
            substr($phone, 7, 2),
            substr($phone, 9)
    );
}

function getOnlyNumbers($phone)
{
    return intval(preg_replace( '/[^0-9]/', '', $phone));
}

function dateFormatted($value) {
return \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $value)
    ->timezone('Europe/Moscow')->format('d.m.Y в H:i:s');
}

function requstType($value) {
    return $value == 'call' ? 'Звонок' : 'Заявка на перезвон';
}

function convertSecondsToMinutes($seconds) {
    $s = $seconds % 60;
    $seconds = floor($seconds/60);

    $m = $seconds % 60;
    $seconds = floor($seconds/60);

    $h = floor($seconds);

    $str = "$s сек.";

    if ($m > 0)
        $str = "$m мин. $str";
    if ($h > 0)
        $str = "$h час. $str";

    return $str;
}

function convertToMoney($sum, $symbol = true) {
            
    if ($sum == '') $sum = 0;

    if ($symbol) {
        return number_format($sum, 0, ',', ' ') . '  ₽';
    } else {
        return number_format($sum, 0, ',', ' ');
    }
    
}

function countSumOfServices($services) {
    return array_reduce($services->toArray(), function ($sum, $item) {
        return $sum += $item['sum_pay'];
    }, 0);
}

function parseDate($datetime) {
    return $datetime ? date('d.m.Y', strtotime($datetime)) : "";
}

function parseTime($datetime) {
    return $datetime ? date('H:i', strtotime($datetime)) : "";
}