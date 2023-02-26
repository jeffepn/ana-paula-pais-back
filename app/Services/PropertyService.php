<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Jeffpereira\RealEstate\Models\Property\Property;
use Illuminate\Support\Str;

class PropertyService
{
    public const DEFAULT_PAGINATE = 12;

    public function getWithSlug(string $slug): ?Property
    {
        return Property::where('slug', Str::upper($slug))->first();
    }

    public function getAllPerSearch(array $search): LengthAwarePaginator
    {
        $properties = Property::join('addresses', 'properties.address_id', 'addresses.id')
            ->join('neighborhoods', 'addresses.neighborhood_id', 'neighborhoods.id')
            ->join('business_properties', 'properties.id', 'business_properties.property_id')
            ->join('businesses', 'business_properties.business_id', 'businesses.id')
            ->select('properties.*')
            ->distinct('properties.id')
            ->whereActive(true)
            ->when(!empty($search['neighborhood']), function ($query) use ($search) {
                $query->where('neighborhoods.id', $search['neighborhood']);
            })->when(!empty($search['type']), function ($query) use ($search) {
                $query->where('properties.sub_type_id', $search['type']);
            })->when(!empty($search['business']), function ($query) use ($search) {
                $query->where('businesses.id', $search['business']);
            })->when(!empty($search['dormitory']), function ($query) use ($search) {
                $query->where('properties.min_dormitory', '>=', $search['dormitory'])
                    ->orWhere('properties.max_dormitory', '<=', $search['dormitory']);
            })->when(!empty($search['garage']), function ($query) use ($search) {
                $query->where(function ($subQuery)  use ($search) {
                    $subQuery->where('properties.min_garage', $search['garage'])
                        ->orWhere('properties.max_garage', $search['garage']);
                });
            })->when(!empty($search['price_max']), function ($query) use ($search) {
                $query->where('business_properties.value', $search['price_max']);
            })->when(!empty($search['area_max']), function ($query) use ($search) {
                $query->where('properties.building_area', '=', $search['area_max'])
                    ->orWhere('properties.total_area', '=', $search['area_max']);
            });

        return $properties->orderBy('created_at')
            ->paginate(self::DEFAULT_PAGINATE);
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
            ->take($amount)
            ->orderBy('created_at')
            ->get();
    }
}
