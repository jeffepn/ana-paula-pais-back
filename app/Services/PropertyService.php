<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Jeffpereira\RealEstate\Models\Property\Property;
use Illuminate\Support\Str;

class PropertyService
{
    public function getWithSlug(string $slug): ?Property
    {
        return Property::where('slug', Str::upper($slug))->first();
    }

    public function getAllPerSearch(array $search): LengthAwarePaginator
    {
        $verifyBusiness = !empty($search['business']);
        $verifyNeighborhood = !empty($search['neighborhood']);
        $verifyType = !empty($search['type']);
        $verifyGarage = !empty($search['garage']);
        $verifyDormitory = !empty($search['dormitory']);
        $verifyPriceMax = !empty($search['price_max']);
        $verifyAreaMax = !empty($search['area_max']);
        $properties = Property::join('addresses', 'properties.address_id', 'addresses.id')
            ->join('neighborhoods', 'addresses.neighborhood_id', 'neighborhoods.id')
            ->join('business_properties', 'properties.id', 'business_properties.property_id')
            ->join('businesses', 'business_properties.business_id', 'businesses.id')
            ->select('properties.*')
            ->distinct('properties.id')
            ->when($verifyNeighborhood, function ($query) use ($search) {
                return $query->where('neighborhoods.id', $search['neighborhood']);
            })->when($verifyType, function ($query) use ($search) {
                return $query->where('properties.sub_type_id', $search['type']);
            })->when($verifyBusiness, function ($query) use ($search) {
                return $query->where('businesses.id', $search['business']);
            })->when($verifyDormitory, function ($query) use ($search) {
                return $query->where('properties.min_dormitory', '>=', $search['dormitory'])
                    ->orWhere('properties.max_dormitory', '<=', $search['dormitory']);
            })->when($verifyGarage, function ($query) use ($search) {
                return $query->where(function ($subQuery)  use ($search) {
                    $subQuery->where('properties.min_garage', $search['garage'])
                        ->orWhere('properties.max_garage', $search['garage']);
                });
            })->when($verifyPriceMax, function ($query) use ($search) {
                return $query->where('business_properties.value', $search['price_max']);
            })->when($verifyAreaMax, function ($query) use ($search) {
                return $query->where('properties.building_area', '=', $search['area_max'])
                    ->orWhere('properties.total_area', '=', $search['area_max']);
            });

        return $properties->paginate(12);
    }

    public function getSimilarProperties(Property $property, int $amount): Collection
    {
        return Property::select('properties.*')
            ->join('sub_types', 'properties.sub_type_id', 'sub_types.id')
            ->join('types', 'sub_types.type_id', 'types.id')
            ->join('addresses', 'properties.address_id', 'addresses.id')
            ->join('neighborhoods', 'addresses.neighborhood_id', 'neighborhoods.id')
            ->where('properties.id', '!=', $property->id)
            ->where('addresses.neighborhood_id', $property->neighborhood_id)
            ->where('sub_types.id', $property->sub_type_id)
            ->take($amount)->get();
    }
}
