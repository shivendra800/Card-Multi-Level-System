<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;
    protected $table = 'create_doctors';
    
    public function images()
    {
        return $this->hasMany('App\Models\AddMultiImages' , 'doctor_id');
    }

    public function hospitalMoreDetails()
    {
        return $this->belongsTo('App\Models\AddMoreDetails', 'doctor_id');
    }

    public function specializationHospitalList()
    {
        return $this->hasMany('App\Models\SpecializationWiseHospitalDetails' , 'doctor_id');
    }
}
