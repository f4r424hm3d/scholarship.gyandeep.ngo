<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    protected $table = 'specializations';
    protected $primaryKey = 'id';
    //protected $fillable = ['category_id', 'specialization', 'specialization_slug', 'status'];
    protected $guarded = [];
}
