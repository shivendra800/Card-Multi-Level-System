<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueHealthCard extends Model
{
    use HasFactory;
    protected $table = 'create_health_card';

    public function healthcardtype()
    {
        return $this->belongsTo('App\Models\HealthCard', 'id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'id');
    }
}
