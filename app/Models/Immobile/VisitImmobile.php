<?php

namespace App\Models\Immobile;

use Illuminate\Database\Eloquent\Model;

class VisitImmobile extends Model
{
    protected $table = 'visit_properties';
    public $timestamps = true;
    protected $fillable = ['immobile_id', 'ip'];
}
