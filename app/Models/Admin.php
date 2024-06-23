<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';

    public function stateheadhcms()
    {
        return $this->belongsTo('App\Models\StateHeadHCMS','state_head_hcms_id');
    }
    public function childs() {
        return $this->hasMany('App\Models\Admin','parent_id','id') ;
    }

}
