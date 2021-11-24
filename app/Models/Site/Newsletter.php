<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletters';
    public $timestamps = true;
    protected $fillable = ['name', 'email'];
}