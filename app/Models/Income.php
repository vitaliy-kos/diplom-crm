<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'incomes';
    protected $guarded = false;
    public $timestamps = false;



    public function incomeType(): BelongsTo
    {
        return $this->belongsTo(IncomeType::class, 'type_id', 'id');
    }

    public function getDateAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)
            ->timezone('Europe/Moscow')->format('d.m.Y');
    }

    protected function casts(): array
    {
        return [
            'type_id' => 'integer',
        ];
    }
}
