<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IvrSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'phone_number',
        'case_no',
        'step_no',
        'session_id',
        'status',
    ];
}
