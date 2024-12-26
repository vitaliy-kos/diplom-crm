<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderMeta extends Model
{
    use HasFactory;

    protected $table = 'orders_metas';
    protected $guarded = false;
    public $timestamps = false;

    
}
