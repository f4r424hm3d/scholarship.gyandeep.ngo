<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;
    protected $table = 'scholarships';
    protected $primaryKey = 'id';
    public function getSchLevel()
    {
        return $this->hasMany(ScholarshipLevel::class, 'scholarship_id', 'id')->with('getLevel');
    }
    public function getSchSubject()
    {
        return $this->hasMany('App\Models\ScholarshipSubject', 'scholarship_id', 'id')->with('getSubject');
    }
    public function getSchCountry()
    {
        return $this->hasMany('App\Models\ScholarshipEligibility', 'scholarship_id', 'id')->with('getCountry');
    }
    public function getProvider()
    {
        return $this->hasOne(Provider::class, 'id', 'provider_id');
    }
}
