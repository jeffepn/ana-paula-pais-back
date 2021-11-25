<?php

namespace App\Models\Immobile;

use Illuminate\Database\Eloquent\Model;

class ImageImmobile extends Model
{

    protected $table = "image_properties";
    public $timestamps = false;
    protected $fillable = [
        'immobile_id', 'way', 'alt'
    ];

    /**
     * Return Immobile of ImageImmobile
     *
     * @return void
     */
    public function immobile()
    {
        return $this->belongsTo('App\Immobile\Immobile', 'immobile_id');
    }
}
