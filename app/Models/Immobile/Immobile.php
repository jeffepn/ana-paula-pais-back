<?php

namespace App\Models\Immobile;

use Illuminate\Database\Eloquent\Model;
//Models
use App\Models\Immobile\ImageImmobile;
use App\Models\Address\Neighborhood;
//Utility
use App\Utility\SiteUtility;

class Immobile extends Model
{
    public $table = "immobiles";
    public $timestamps = true;
    protected $fillable = [
        'slug', 'type', 'neighborhood_id', 'rent', 'sale', 'value_rent', 'value_sale', 'dormitory', 'suite', 'bathroom', 'garage', 'value_condominium', 'value_iptu', 'area_total', 'area_building', 'min_description', 'description', 'visits'
    ];
    /**
     * Get all ImageImmobile of Immobile
     *
     * @return ImageImmobile[]
     */
    public function images()
    {
        return $this->hasMany('App\Models\Immobile\ImageImmobile', 'immobile_id');
    }
    /**
     * Return Neighborhood of Immobile
     *
     * @return Neighborhood
     */
    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Address\Neighborhood', 'neighborhood_id');
    }
    /**
     * Get text of type of Immobile
     *
     * @return string
     */
    public function textType()
    {
        return SiteUtility::gettypesImmobile()[$this->type];
    }
}
