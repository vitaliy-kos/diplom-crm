<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ClientRequest extends Model
{
    use HasFactory;

    protected $table = 'clients_requests';
    protected $guarded = false;
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
