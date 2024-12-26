<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskFeedback extends Model
{
    use HasFactory;

    protected $table = 'ask_feedback';
    protected $guarded = false;
    public $timestamps = false;
}
