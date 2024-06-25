<?php

namespace App\Services;

use Jeffpereira\RealEstate\Models\Property\BusinessProperty;
use Jeffpereira\RealEstate\Models\Property\SubType;
use JPAddress\Models\Address\Neighborhood;

class SearchService
{

    public function getBusinesses()
    {
        return BusinessProperty::join('properties', 'business_properties.property_id', 'properties.id')
            ->join('businesses', 'business_properties.business_id', 'businesses.id')
            ->select('businesses.*')
            ->orderBy('businesses.name', 'asc')
            ->distinct()
            ->get();
    }

    public function getNeighborhoods()
    {
        return Neighborhood::join("addresses", "neighborhoods.id", "=", "addresses.neighborhood_id")
            ->join('properties', function ($q) {
                $q->on("properties.address_id", "addresses.id")
                    ->where("active", true);
            })
            ->with('city')
            ->select("neighborhoods.*")
            ->orderBy('name', 'asc')
            ->get()
            ->unique()
            ->groupBy(function ($item) {
                return $item->city->id;
            })
            ->sortBy(function ($item) {
                return $item->first()->city->name;
            });
    }

    public function getSubtypes()
    {
        return SubType::whereHas('properties')
            ->orderBy('name', 'asc')
            ->get();
    }
}
