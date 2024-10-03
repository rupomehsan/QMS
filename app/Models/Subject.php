<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];


    public function questions()
    {
        return $this->hasMany(Question::class);
    }


    public function exam_results()
    {
        // dd(auth()->id());
        return $this->hasMany(ExamResult::class);
    }
}
