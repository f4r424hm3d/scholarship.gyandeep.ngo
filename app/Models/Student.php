<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $table = 'students';
  protected $primaryKey = 'id';

  public function getLevel()
  {
    return $this->hasOne(Level::class, 'id', 'current_qualification_level');
  }
  public function getCourse()
  {
    return $this->hasOne(CourseCategory::class, 'id', 'intrested_course_category');
  }
  public function getLastFup()
  {
    return $this->hasOne(StudentFollowUp::class, 'student_id', 'id')->orderBy('id', 'desc')->with('getUser', 'getLS', 'getLSS');
  }
  public function getAllFup()
  {
    return $this->hasMany(StudentFollowUp::class, 'student_id', 'id')->orderBy('id', 'desc')->with('getUser', 'getLS', 'getLSS');
  }
  public function getAC()
  {
    return $this->hasMany(AsignLeads::class, 'student_id', 'id')->with('getUser');
  }
  public function getLastExam()
  {
    return $this->hasMany(AsignExam::class, 'student_id', 'id')->orderBy('id', 'desc');
  }
  public function lastAttendedExam()
  {
    return $this->hasOne(AsignExam::class, 'student_id', 'id')->where('attended', 1)->latest();
  }
}
