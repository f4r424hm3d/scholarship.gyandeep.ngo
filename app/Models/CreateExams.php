<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateExams extends Model
{
    use HasFactory;
    protected $table = 'create_exams';
    protected $primaryKey = 'id';
    public function getScholarship()
    {
        return $this->hasOne(Scholarship::class, 'id', 'scholarship_id');
    }
    public function getCourseCategory()
    {
        return $this->hasOne(CourseCategory::class, 'id', 'course_category_id');
    }
    public function getQuestions()
    {
        return $this->hasMany(ExamQuestions::class, 'exam_id', 'id');
    }
}
