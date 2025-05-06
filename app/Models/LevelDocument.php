<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelDocument extends Model
{
    use HasFactory;
    protected $table = 'level_documents';
    protected $primaryKey = 'id';
    public function getLevel()
    {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }
}
