<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignExam extends Model
{
  use HasFactory;
  public function getExamDet()
  {
    return $this->hasOne(CreateExams::class, 'id', 'exam_id');
  }
  public function getApplication()
  {
    return $this->hasOne(AppliedScholarship::class, 'id', 'application_id');
  }
}
