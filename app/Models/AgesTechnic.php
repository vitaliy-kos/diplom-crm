<?php
namespace App\Models;

class AgesTechnic
{
    protected static array $ages = [
        '500' => [
            'name' => 'менее 5 лет',
            'value' => '500',
        ],
        '1000' => [
            'name' => 'менее 10 лет',
            'value' => '1000',
        ],
        '1001' => [
            'name' => 'более 10 лет',
            'value' => '1001',
        ],
        '2001' => [
            'name' => 'более 20 лет',
            'value' => '2001',
        ],
    ];

    public static function getAll() {
        $ages = [];
        foreach (static::$ages as $age) {
            $ages[] = (object) $age;
        }
        return $ages;
    }

    public static function id($id) {
        foreach (static::$ages as $slug => $status) {
            if ($status['id'] == $id) return (object) static::$ages[$slug];
        }
    }

    public static function name($name) {
        return (object) static::$ages[$name] ?? null;
    }
}
