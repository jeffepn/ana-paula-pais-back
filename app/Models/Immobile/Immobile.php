<?php

namespace App\Models\Immobile;

use Illuminate\Database\Eloquent\Model;
//Models
use App\Models\Immobile\ImageImmobile;
use App\Models\Address\Neighborhood;
use App\Models\Immobile\VisitImmobile;
//Utility
use App\Utility\SiteUtility;
use JpUtilities\Utilities\StringUtility;

class Immobile extends Model
{
    public $table = "immobiles";
    public $timestamps = true;
    protected $fillable = [
        'slug', 'type', 'neighborhood_id', 'rent', 'sale', 'value_rent', 'value_sale', 'dormitory', 'suite', 'bathroom', 'garage', 'value_condominium', 'value_iptu', 'area_total', 'area_building', 'min_description', 'description', 'visits'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($immobile) {
            $data = [];
            $data['slug'] = 'AN-' . StringUtility::generateSlugOfTextWithComplement($immobile->neighborhood_id . $immobile->type . rand(1, 999));
            while (validator()->make($data, ['slug' => 'unique:immobiles'])->fails()) {
                $data['slug'] = StringUtility::generateSlugOfTextWithComplement('AN-' . $immobile->neighborhood_id . $immobile->type . rand(1, 999));
            }
            $immobile->slug = $data["slug"];
        });
    }



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
     * Return all VisitImmobile of Immobile
     *
     * @return VisitImmobile[]
     */
    public function visits()
    {
        return $this->hasMany("App\Models\Immobile\VisitImmobile", "immobile_id");
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
