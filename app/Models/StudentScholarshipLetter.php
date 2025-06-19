<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentScholarshipLetter extends Model
{
  public function student()
  {
    return $this->belongsTo(Student::class, 'student_id', 'id');
  }
  public function company()
  {
    return $this->belongsTo(CompanyProfile::class, 'company_id', 'id');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'created_by', 'id');
  }
}
