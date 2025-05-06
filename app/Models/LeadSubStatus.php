<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSubStatus extends Model
{
    use HasFactory;
    protected $table = 'lead_sub_statuses';
    protected $primaryKey = 'id';
    public function getStatus()
    {
        return $this->hasOne(LeadStatus::class, 'id', 'status_id');
    }
}
