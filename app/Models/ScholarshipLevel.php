<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipLevel extends Model
{
    use HasFactory;
    protected $table = 'scholarship_levels';
    protected $primaryKey = 'id';
    public function getLevel()
    {
        return $this->hasOne('App\Models\Level', 'id', 'level_id');
    }
}
