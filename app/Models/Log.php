<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $guarded = false;
    public $timestamps = false;



    public function getDateAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)
            ->timezone('Europe/Moscow')->format('d.m.Y в H:i:s');
    }

}
