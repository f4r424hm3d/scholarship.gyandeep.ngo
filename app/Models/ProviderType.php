<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderType extends Model
{
    use HasFactory;
    protected $table = 'provider_types';
    protected $primaryKey = 'id';
    public function getProvider()
    {
        return $this->hasOne('App\Models\Provider', 'provider_type_id', 'id');
    }
}
