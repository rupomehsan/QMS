<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'question',
        'options',
        'answer',
        'status'
    ];

    protected $casts = [
        "options" => "array",
        "answer" => "array",
    ];


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
