<?php

namespace App\Services;

//Services
use Illuminate\Support\Facades\DB;
//Models
use App\Models\Immobile\Immobile;
use App\Models\Immobile\ImageImmobile;
use App\Models\Address\Neighborhood;
use App\Models\Immobile\VisitImmobile;
//Utilities
use JpUtilities\Utilities\ArrayUtility;
use JpUtilities\Utilities\StringUtility;
use JpUtilities\Utilities\Upload;
use App\Utility\SiteUtility;
use Illuminate\Support\Arr;
use Jeffpereira\RealEstate\Models\Property\Property;
use Illuminate\Support\Str;

class PropertyService
{
    public function create($data)
    {
        $data['slug'] = 'AN-' . StringUtility::generateSlugOfTextWithComplement($data['neighborhood_id'] . $data['type'] . rand(1, 999));
        while (validator()->make($data, ['slug' => 'unique:properties'])->fails()) {
            $data['slug'] = StringUtility::generateSlugOfTextWithComplement('AN-' . $data['neighborhood_id'] . $data['type'] . rand(1, 999));
        }
        return Immobile::create($data);
    }

    public function edit($data)
    {
    }

    public function getWithId($id)
    {
    }

    public function getWithSlug($slug)
    {
        return Property::where('slug', Str::upper($slug))->first();
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
     * Get all properties rent
     *
     * @return Immobile[]
     */
    public function getAllRent()
    {

        return Immobile::where('rent', true)->paginate(12);
    }
    /**
     * Get all properties sale
     *
     * @return Immobile[]
     */
    public function getAllSale()
    {
        return Immobile::where('sale', true)->paginate(12);
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
        } elseif ($search['bussiness'] == 2) {
            $slugBussiness = "sale";
        } else {
            $slugBussiness = null;
        }
        // return Property::all();

        return Property:: //where($slugBussiness, true)
            when($verifyBussiness, function ($query, $verifyBussiness) use ($slugBussiness) {
                if ($slugBussiness) {
                    return $query->where($slugBussiness, true);
                }
            })->when($verifyNeighborhood, function ($query, $verifyNeighborhood) use ($search) {
                return $query->where('neighborhood_id', $search['neighborhood']);
            })->when($verifyType, function ($query, $verifyType) use ($search) {
                return $query->where('type', $search['type']);
            })->when($verifyGarage, function ($query, $verifyGarage) use ($search) {
                return $query->where('garage', $search['garage']);
            })->when($verifyDormitory, function ($query, $verifyDormitory) use ($search) {
                return $query->where('dormitory', $search['dormitory']);
            })/*->when($verifyPriceMin, function ($query, $verifyPriceMin) use ($search) {
                if ($search['bussiness'] == 1) {
                    return $query->where('value_rent', '>=', $search['price_min']);
                } else {
                    return $query->where('value_sale', '>=', $search['price_min']);
                }
            })*/->when($verifyPriceMax, function ($query, $verifyPriceMax) use ($search) {
                if ($search['bussiness'] == 1) {
                    //return $query->where('value_rent', '<=', $search['price_max']);
                    return $query->where('value_rent', '=', $search['price_max']);
                } else {
                    //return $query->where('value_sale', '<=', $search['price_max']);
                    return $query->where('value_sale', '=', $search['price_max']);
                }
            })/*->when($verifyAreaMin, function ($query, $verifyAreaMin) use ($search) {
                return $query->where('area_building', '>=', $search['area_min'])
                    ->where('area_total', '>=', $search['area_min']);
            })*/->when($verifyAreaMax, function ($query, $verifyAreaMax) use ($search) {
                //return $query->where('area_building', '<=', $search['area_max'])
                //  ->where('area_total', '<=', $search['area_max']);
                return $query->where('area_building', '=', $search['area_max'])
                    ->orWhere('area_total', '=', $search['area_max']);
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
        return  Property::take($amount)->get();
    }
    /**
     * Get Immobiles similiar Immobile with amount defined
     *
     * @param Immobile $property
     * @param int $amount Amount properties search
     * @return Immobile[]
     */
    public function getSimilarImmobiles($property, $amount)
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

    public function getAllForSelect()
    {
    }

    public function deleteWithId($id)
    {
    }

    public function deleteWithSlug($slug)
    {
    }

    public function getRules($type, $parameters)
    {
        switch ($type) {
            case 'create':
                return [
                    'neighborhood_id' => 'required',
                    'value_rent' => 'numeric|between:0,99999999.99',
                    'value_sale' => 'numeric|between:0,99999999.99',
                    'type' => 'required',
                    'dormitory' => 'integer',
                    'suite' => 'integer',
                    'bathroom' => 'integer',
                    'garage' => 'integer',
                    'value_condominium' => 'numeric|between:0,99999999.99',
                    'value_iptu' => 'numeric|between:0,99999999.99',
                    'area_total' => 'numeric|between:0,99999999.99',
                    'area_building' => 'numeric|between:0,99999999.99',
                    'min_description' => 'required|max:150',
                    'description' => 'required|max:65300',
                    'image' => 'required',
                    'image.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
                ];
            case 'edit':
                return [
                    'image' => 'required',
                    'image.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
                ];
            default:
                return [];
        }
    }

    public function getMessages()
    {
        return [
            'max' => 'Limite o campo a :max caracteres.',
            'integer' => 'O campo precisa ser um número inteiro.',
            'required' => 'Campo obrigatório',
            'neighborhood_id.required' => 'Escolha um Bairro',
            'numeric' => 'Número inválido',
            'between' => 'Formato válido 99.99',
            'type.required' => 'Escolha um Tipo de Imóvel',
            'image.required' => 'Escolha pelo menos uma imagem.',
            'image' => 'Imagem inválida',
            'mimes' => 'Formato de arquivos aceitos (peg,png,jpg,svg|).'
        ];
    }
    /**
     * Create ImageImmobile in system
     *
     * @param string $way Way for image
     * @param Immobile $property
     * @return ImageImmobile
     */
    public function createImage($way, $property)
    {
        return ImageImmobile::create(['immobile_id' => $property->id, 'way' => $way, 'alt' => SiteUtility::getTypesImmobile()[$property->type] . ' ' . $property->neighborhood->name . ' , ' . $property->neighborhood->city->name . ' - Imóveis Ana Paula Pais']);
    }

    /**
     * Return all Neighborhoods for select with city
     *
     * @return array
     */
    public function getAllNeighborhoodsSelectWithCity()
    {
        return Neighborhood::join('cities', 'neighborhoods.city_id', '=', 'cities.id')
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->select('neighborhoods.id', 'neighborhoods.name', DB::raw('CONCAT(neighborhoods.name ," - ",cities.name," ",states.initials) AS result'))
            ->orderBy("neighborhoods.name", "asc")->get()
            ->map(function ($neighborhood) {
                return [
                    'id' => $neighborhood->id,
                    'result' => $neighborhood->result,
                ];
            });
    }
    /**
     * Return all Neighborhoods for select
     *
     * @return void
     */
    public function getAllNeighborhoodsSelect()
    {
        return App\Services\ArrayUtility::convertArrayForInputSelect('id', 'name', Neighborhood::all());
    }
    /**
     * Register visit if ip not visited immobile
     *
     * @param int $property_id Id of Immobile
     * @param string $ip Ip of visitant
     * @return VisitImmobile
     */
    public function registerVisit($property_id, $ip)
    {
        return VisitImmobile::firstOrCreate(['immobile_id' => $property_id, 'ip' => $ip]);
    }
}
