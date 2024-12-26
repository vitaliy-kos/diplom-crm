<?php
namespace App\Models;

class Status
{
    protected static array $statuses = [
        'not_processed' => [
            'id' => 1,
            'name' => 'Не обработан',
            'menu_name' => 'Не обработаны',
            'bt_type' => 'warning',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"></path></svg>'
        ],
        'not_assigned' => [
            'id' => 2,
            'name' => 'Не назначен',
            'menu_name' => 'Не назначены',
            'bt_type' => 'warning',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" /></svg>'
        ],
        'out' => [
            'id' => 3,
            'name' => 'На выезде',
            'menu_name' => 'На выезде',
            'bt_type' => 'primary',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>'
        ],
        'work' => [
            'id' => 4,
            'name' => 'В работе',
            'menu_name' => 'В работе',
            'bt_type' => 'secondary',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>'
        ],
        'successed' => [
            'id' => 5,
            'name' => 'Завершен успешно',
            'menu_name' => 'Успешные',
            'bt_type' => 'success',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>'
        ],
        'paid' => [
            'id' => 6,
            'name' => 'Оплачен',
            'menu_name' => 'Оплаченные',
            'bt_type' => 'success',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0" stroke="currentColor" class="w-6 h-6"><path d="M13.5 3H7V12H5V14H7V16H5V18H7V21H9V18H13V16H9V14H13.5C16.54 14 19 11.54 19 8.5C19 5.46 16.54 3 13.5 3ZM13.5 12H9V5H13.5C15.43 5 17 6.57 17 8.5C17 10.43 15.43 12 13.5 12Z" fill="currentColor"/></svg>'
        ],
        'canceled' => [
            'id' => 7,
            'name' => 'Отменен',
            'menu_name' => 'Отмененные',
            'bt_type' => 'danger',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>'
        ],
        'not_accepted' => [
            'id' => 8,
            'name' => 'Не принят',
            'menu_name' => 'Не принятые',
            'bt_type' => 'danger',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>'
        ],
    ];

    public static function getAll() {
        return static::$statuses;
    }

    public static function id($id) {
        foreach (static::$statuses as $slug => $status) {
            if ($status['id'] == $id) return (object) static::$statuses[$slug];
        }
    }

    public static function name($name) {
        return (object) static::$statuses[$name] ?? null;
    }
}
