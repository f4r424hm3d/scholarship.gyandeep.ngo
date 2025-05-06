<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipEligibility extends Model
{
    use HasFactory;
    protected $table = 'scholarship_eligibilities';
    protected $primaryKey = 'id';
    public function getCountry()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country');
    }
}
