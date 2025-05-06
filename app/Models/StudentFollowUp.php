<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFollowUp extends Model
{
    use HasFactory;
    protected $table = 'student_follow_ups';
    protected $primaryKey = 'id';

    public function getStudent()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }
    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function getLS()
    {
        return $this->hasOne(LeadStatus::class, 'id', 'lead_status');
    }
    public function getLSS()
    {
        return $this->hasOne(LeadSubStatus::class, 'id', 'lead_sub_status');
    }
}
