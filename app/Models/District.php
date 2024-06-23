<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'district_name', 'state_id'
    ];

    public function state()
    {
        return $this->belongsTo('App\Models\State','state_id');
    }

}
