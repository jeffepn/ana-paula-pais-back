<?php

namespace App\Utility;

class SiteUtility
{
    /**
     * Put session in sytem for search
     *
     * @return void
     */
    public static function initializeSessionSearch()
    {
        session()->put(
            'search_property',
            [
                'bussiness' => '',
                'neighborhood' => '',
                'type' => '',
                'garage' => '',
                'dormitory' => '',
                'price_min' => '',
                'price_max' => '',
                'area_min' => '',
                'area_max' => '',
            ]
        );
    }
}
