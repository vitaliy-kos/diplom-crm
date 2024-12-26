<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ClientAddress extends Model
{
    use HasFactory;

    protected $table = 'clients_addresses';
    protected $guarded = false;
    public $timestamps = false;

    public function metro_station(): BelongsTo
    {
        return $this->belongsTo(MetroStation::class, 'metro_station_id', 'id');
    }
}
