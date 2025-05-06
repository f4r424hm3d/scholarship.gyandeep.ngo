<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDateSchedule extends Model
{
    use HasFactory;
    protected $table = 'exam_date_schedules';
    protected $primaryKey = 'id';
    public function getScholarship()
    {
        return $this->hasOne(Scholarship::class, 'id', 'scholarship_id');
    }
    public function getCourseCategory()
    {
        return $this->hasOne(CourseCategory::class, 'id', 'course_category_id');
    }
}
