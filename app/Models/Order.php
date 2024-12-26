<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = false;
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function status()
    {
        return (object) Status::id($this->status_id);
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id', 'id');
    }

    public function requests()
    {
        return $this->hasMany(ClientRequest::class, 'order_id', 'id')->orderBy('date_start', 'desc');
    }

    public function metas()
    {
        return $this->hasMany(OrderMeta::class, 'order_id', 'id');
    }

    public function metaByName($name)
    {
        $meta = OrderMeta::where('order_id', '=', $this->id)
                        ->where('key', '=', $name)
                        ->first();

        return $meta->value ?? null;
    }

    public function services()
    {
        return $this->hasMany(OrderServices::class, 'order_id', 'id');
    }

}
