<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $guard = 'cities';
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id');
    }
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id');
    }
}
