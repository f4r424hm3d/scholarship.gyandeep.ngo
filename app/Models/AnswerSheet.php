<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerSheet extends Model
{
    use HasFactory;
    //protected $fillable = ['student_id'];
    protected $guarded = [];

    public function getSection()
    {
        return $this->hasOne(Subjects::class, 'id', 'subject_id');
    }
    public function getAnswer()
    {
        return $this->hasOne(ExamQuestions::class, 'id', 'question_id');
    }
}
