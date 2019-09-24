<?php

namespace App\Services;

//Services
use JpUtilities\Services\ServiceDefault;
//Models
use App\Models\Immobile\Immobile;
use App\Models\Immobile\ImageImmobile;
use App\Models\Address\Neighborhood;
//Utilities
use JpUtilities\Utilities\ArrayUtility;

class ImmobileService implements ServiceDefault
{
    public function create($data)
    { }

    public function edit($data)
    { }

    public function getWithId($id)
    { }

    public function getWithSlug($slug)
    {
        return Immobile::where('slug', $slug)->first();
    }

    /**
     * Return all Immobile, with sale or rent (true)
     *
     * @return Immobile[]
     */
    public function getAll()
    {
        return Immobile::where('sale', true)->orWhere('rent', true)->paginate(12);
    }
    /**
     * Return Immobiles per search
     *
     * @param array $search
     * @return Immobile[]
     */
    public function getAllPerSearch($search)
    {
        $verifyBussiness = !empty($search['bussiness']);
        $verifyNeighborhood = !empty($search['neighborhood']);
        $verifyType = !empty($search['type']);
        $verifyGarage = !empty($search['garage']);
        $verifyDormitory = !empty($search['dormitory']);
        $verifyPriceMin = !empty($search['price_min']);
        $verifyPriceMax = !empty($search['price_max']);
        $verifyAreaMin = !empty($search['area_min']);
        $verifyAreaMax = !empty($search['area_max']);
        if ($search['bussiness'] == 1) {
            $slugBussiness = "rent";
        } else {
            $slugBussiness = "sale";
        }
        return Immobile::where($slugBussiness, true)
            ->when($verifyNeighborhood, function ($query, $verifyNeighborhood) use ($search) {
                return $query->where('neighborhood_id', $search['neighborhood']);
            })->when($verifyType, function ($query, $verifyType) use ($search) {
                return $query->where('type', $search['type']);
            })->when($verifyGarage, function ($query, $verifyGarage) use ($search) {
                return $query->where('garage', $search['garage']);
            })->when($verifyDormitory, function ($query, $verifyDormitory) use ($search) {
                return $query->where('dormitory', $search['dormitory']);
            })->when($verifyPriceMin, function ($query, $verifyPriceMin) use ($search) {
                if ($search['bussiness'] == 1) {
                    return $query->where('value_rent', '>=', $search['price_min']);
                } else {
                    return $query->where('value_sale', '>=', $search['price_min']);
                }
            })->when($verifyPriceMax, function ($query, $verifyPriceMax) use ($search) {
                if ($search['bussiness'] == 1) {
                    return $query->where('value_rent', '<=', $search['price_max']);
                } else {
                    return $query->where('value_sale', '<=', $search['price_max']);
                }
            })->when($verifyAreaMin, function ($query, $verifyAreaMin) use ($search) {
                return $query->where('area_building', '>=', $search['area_min'])
                    ->where('area_total', '>=', $search['area_min']);
            })->when($verifyAreaMax, function ($query, $verifyAreaMax) use ($search) {
                return $query->where('area_building', '<=', $search['area_max'])
                    ->where('area_total', '<=', $search['area_max']);
            }) //->toSql();
            ->paginate(12);
    }

    /**
     * Get Immobiles order by visits with amount defined
     *
     * @param int $amount Amount of Immobiles
     * @return Immobile[]
     */
    public function getOrderByVisits($amount)
    {
        return Immobile::where('rent', true)->orWhere('sale', true)->orderBy('visits', 'desc')->take($amount)->get();
    }

    public function getAllForSelect()
    { }

    public function deleteWithId($id)
    { }

    public function deleteWithSlug($slug)
    { }

    public function getRules($type, $parameters)
    { }

    public function getMessages()
    { }
    /**
     * Return all Neighborhoods for select
     *
     * @return array
     */
    public function getAllNeighborhoodsSelect()
    {
        return ArrayUtility::convertArrayForInputSelect('id', 'name', Neighborhood::all());
    }
}