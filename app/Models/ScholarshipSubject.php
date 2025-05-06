<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipSubject extends Model
{
  use HasFactory;
  protected $table = 'scholarship_subjects';
  protected $primaryKey = 'id';
  public function getSubject()
  {
    return $this->hasOne('App\Models\Specialization', 'id', 'spc_id');
  }
  public function getCourse()
  {
    return $this->hasOne('App\Models\CourseCategory', 'id', 'course_id');
  }
}
