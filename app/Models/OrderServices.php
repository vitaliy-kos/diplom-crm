<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderServices extends Model
{
    use HasFactory;

    protected $table = 'order_services';

    public $timestamps = false;
    protected $guarded = false;
}
