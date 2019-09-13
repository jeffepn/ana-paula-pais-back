<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;
//Models
use App\Models\Address\City;

class Neighborhood extends Model
{
    protected $table = "neighborhoods";
    public $timestamps = false;
    protected $fillable = [
        'city_id', 'name'
    ];
    /**
     * Return the City of Neighborhood
     *
     * @return City
     */
    public function city()
    {
        return $this->belongsTo('App\Models\Address\City', 'city_id');
    }
}