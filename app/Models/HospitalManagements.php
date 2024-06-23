<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalManagements extends Model
{
    use HasFactory;
    protected $table = 'create_hospital';

    public function images()
    {
        return $this->hasMany('App\Models\AddMultiImages' , 'hospital_id');
    }

    public function hospitalMoreDetails()
    {
        return $this->belongsTo('App\Models\AddMoreDetails', 'hospital_id');
    }

    public function specializationHospitalList()
    {
        return $this->hasMany('App\Models\SpecializationWiseHospitalDetails' , 'hospital_id');
    }
}
