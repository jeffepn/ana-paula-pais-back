<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    public $timestamps = true;
    protected $table = 'newsletters';
    protected $fillable = ['name', 'email'];
}
