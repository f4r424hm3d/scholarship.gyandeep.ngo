<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadType extends Model
{
    use HasFactory;
    protected $table = 'lead_types';
    protected $primaryKey = 'id';
    public function getLeadCount()
    {
    return $this->hasMany(Student::class, 'lead_type', 'slug');
    }
    public function getAsignLead()
    {
    return $this->hasMany(AsignLeads::class, 'lead_type', 'slug');
    }
}
