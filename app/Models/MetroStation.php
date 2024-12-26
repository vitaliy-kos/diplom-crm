<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetroStation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'metro_stations';
    protected $guarded = false;
    public $timestamps = false;
}
