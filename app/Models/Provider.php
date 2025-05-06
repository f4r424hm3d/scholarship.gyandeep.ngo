<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $table = 'providers';
    protected $primaryKey = 'id';
    public function getProviderType()
    {
        return $this->hasOne('App\Models\ProviderType', 'id', 'provider_type_id');
    }
    public function getCountry()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country');
    }
}
