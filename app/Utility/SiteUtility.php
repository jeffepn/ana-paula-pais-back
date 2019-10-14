<?php

namespace App\Utility;

class SiteUtility
{
    /**
     * Return array with all types of Immobile
     *
     * @return string[]
     */
    public static function getTypesImmobile()
    {
        return [
            1 => "Casa",
            2 => "Apartamento",
            3 => "Sala Comercial",
            4 => "Flat",
            5 => "Ponto Comercial",
            6 => "Terreno",
            7 => "Studio",
        ];
    }
    /**
     * Return array with all types of bussiness
     *
     * @return string[]
     */
    public static function getBussiness()
    {
        return [
            1 => 'Alugar',
            2 => 'Comprar'
        ];
    }

    /**
     * Put session in sytem for search
     *
     * @return void
     */
    public static function initializeSessionSearch()
    {
        session()->put('search_immobile', [
            'bussiness' => '',
            'neighborhood' => '',
            'type' => '',
            'garage' => '',
            'dormitory' => '',
            'price_min' => '',
            'price_max' => '',
            'area_min' => '',
            'area_max' => '',
        ]);
    }
}