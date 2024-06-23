<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateHeadHCMS extends Model
{
    use HasFactory;
    protected $table = 'stateheadhcmss';

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin','id');
    }
}
