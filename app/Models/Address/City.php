<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = "cities";
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    /**
     * Return all Neighborhoods of City  
     *
     * @return Neighborhood[]
     */
    public function neighborhoods()
    {
        return $this->hasMany('App\Models\Neighborhood', 'city_id');
    }
}