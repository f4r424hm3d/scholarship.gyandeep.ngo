<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignLeads extends Model
{
  use HasFactory;
  protected $table = 'asign_leads';
  protected $primaryKey = 'id';
  public function getStudent()
  {
    return $this->hasOne(Student::class, 'id', 'student_id')->with('getLevel', 'getCourse', 'getLastFup');
  }
  public function getUser()
  {
    return $this->hasOne(User::class, 'id', 'user_id');
  }
}
