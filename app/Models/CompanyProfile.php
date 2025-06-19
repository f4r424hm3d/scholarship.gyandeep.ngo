<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
  public function letters()
  {
    return $this->hasMany(StudentScholarshipLetter::class, 'company_id', 'id');
  }
}
