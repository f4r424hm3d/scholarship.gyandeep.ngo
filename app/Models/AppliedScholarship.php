<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedScholarship extends Model
{
  use HasFactory;
  public function getScholarship()
  {
    return $this->hasOne(Scholarship::class, 'id', 'scholarship_id');
  }
  public function getStudent()
  {
    return $this->hasOne(Student::class, 'id', 'std_id');
  }
  public function getExam()
  {
    return $this->hasOne(CreateExams::class, 'id', 'exam_id');
  }
  public function getLevel()
  {
    return $this->hasOne(Level::class, 'id', 'level');
  }
  public function getCat()
  {
    return $this->hasOne(CourseCategory::class, 'id', 'category');
  }
  public function getSubject()
  {
    return $this->hasOne(Specialization::class, 'id', 'subject');
  }
  public function getAsignExam()
  {
    return $this->hasOne(AsignExam::class, 'application_id', 'id')->with('getExamDet');
  }
}
