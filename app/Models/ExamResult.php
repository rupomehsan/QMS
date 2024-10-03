<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'user_id',
        'yes_ans',
        'no_ans',
        'result',
        'answers',
    ];

    protected $casts = [
        "result" => "array",
        "answers" => "array",
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
