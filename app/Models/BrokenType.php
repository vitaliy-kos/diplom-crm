<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrokenType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'broken_types';
    protected $guarded = false;
    public $timestamps = false;

    public function technics_type()
    {
        return $this->belongsTo(TechnicsType::class, 'technic_type_id', 'id');
    }
}
