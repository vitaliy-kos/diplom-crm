<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'phones';
    protected $guarded = false;
    public $timestamps = false;

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id', 'id');
    }

    protected function casts(): array
    {
        return [
            'site_id' => 'integer',
        ];
    }
}
