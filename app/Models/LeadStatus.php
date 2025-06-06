<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;
    protected $table = 'lead_statuses';
    protected $primaryKey = 'id';
    public function getLeadType()
    {
        return $this->hasOne(LeadType::class, 'id', 'move_to');
    }
}
