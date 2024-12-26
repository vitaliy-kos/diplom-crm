<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'clients';
    protected $guarded = false;
    public $timestamps = false;

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(ClientAddress::class, 'client_id', 'id');
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)
            ->timezone('Europe/Moscow')->format('d.m.Y в H:i:s');
    }

    public function toggleSpam () {
        $this->spam = $this->spam ? 0 : 1;
        $this->save();
        return true;
    }

    protected function casts(): array
    {
        return [
            'city_id' => 'integer',
            'spam' => 'boolean',
        ];
    }
}
