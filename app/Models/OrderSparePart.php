<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSparePart extends Model
{
    use HasFactory;

    protected $table = 'order_spare_parts';

    public $timestamps = false;
    protected $guarded = false;
}
