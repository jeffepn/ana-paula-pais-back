<?php

namespace App\Models\Immobile;

use Illuminate\Database\Eloquent\Model;

class VisitImmobile extends Model
{
    protected $table = 'visit_immobiles';
    public $timestamps = true;
    protected $fillable = ['immobile_id', 'ip'];
}