<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineSubCategory extends Model
{
    use HasFactory;
    protected $guard = 'medicine_sub_categories';


    public function category()
    {
        return $this->belongsTo('App\Models\MedicineCategory', 'medicine_category_id');
    }
}
