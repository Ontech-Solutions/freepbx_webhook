<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ivr extends Model
{
    use HasFactory;

    protected $fillable = [
        "session_id", "phone_number", "question_id", "answer"
    ];
}
