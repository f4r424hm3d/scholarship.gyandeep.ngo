<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamInstruction extends Model
{
    use HasFactory;
    protected $table = 'exam_instructions';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function getSubject()
    {
        return $this->hasOne(Subjects::class, 'id', 'subject_id');
    }
    public function getExam()
    {
        return $this->hasOne(CreateExams::class, 'id', 'exam_id')->with('getScholarship', 'getCourseCategory');
    }
}
