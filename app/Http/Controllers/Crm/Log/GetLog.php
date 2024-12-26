<?php

namespace App\Http\Controllers\Crm\Log;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;


class GetLog extends Controller
{
    public static function getAll(Object $object)
    {
        $logs = Log::where('object', 'like', class_basename($object))
                    ->where('id_object', '=', $object->id)
                    ->orderByDesc('date')
                    ->get();

        foreach ($logs as $log) {

            $log['title'] = self::getAction($log->action) . self::getName($log->user_id);
            $log['act'] = self::getAct($log->action_value);

        }

        return $logs;
    }

    public static function getName($user_id) {

        if ( $user_id > 0 ) {
            $name = ' пользователем ' . User::findOrFail($user_id)->name;
        } else {
            $name = ' автоматически системой';
        }

        return $name;

    }

    public static function getAction($a) {

        if ( $a == 'Create' || $a == 'Store' || $a == 'Call') $action_str = 'Создан';
        else if ($a == 'Edit' || $a == 'Update') $action_str = 'Изменен';
        else if ($a == 'Status') $action_str = 'Изменен';
        else if ($a == 'Spam') $action_str = 'Статус "СПАМ" изменен';
        else if ($a == 'Delete') $action_str = 'Удален';

        return $action_str;

    }

    public static function getAct($act_val) {

        if ( !empty($act_val) ) {
            $d = 'Действие: ';
            if ( $act_val == 'cancel' ) $act = $d . 'Заказ отменен';
            else if ($act_val == 'away') $act = $d . 'Статус заказа изменен на "Выезд"';
            else if ($act_val == 'gospit') $act = $d . 'Статус заказа изменен на "Госпитализирован(а)"';
            else if ($act_val == 'good') $act = $d . 'Статус заказа изменен на "Завершен успешно"';
            else if ($act_val == 'paid') $act = $d . 'Статус заказа изменен на "Оплачено партнером"';
            else if ($act_val == 'feedback') $act = $d . 'Запрошена обратная связь';
            else if ($act_val == 'work') $act = $d . 'Заявка возвращена в статус "В работе"';
            else if ($act_val == 'relate') $act = $d . 'Заказ объединен с другим';
            else if ($act_val == 'added') $act = $d . 'Клиент добавлен в СПАМ список';
            else if ($act_val == 'deleted') $act = $d . 'Клиент удален из СПАМ списка';
        }

        return !empty($act) ? $act : '';

    }


}
