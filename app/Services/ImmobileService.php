<?php

namespace App\Services;

//Services
use JpUtilities\Services\ServiceDefault;
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

class ImmobileService implements ServiceDefault
{
    public function create($data)
    {
        $data['slug'] = 'AN-' . StringUtility::generateSlugOfTextWithComplement($data['neighborhood_id'] . $data['type'] . rand(1, 999));
        while (validator()->make($data, ['slug' => 'unique:immobiles'])->fails()) {
            $data['slug'] = StringUtility::generateSlugOfTextWithComplement('AN-' . $data['neighborhood_id'] . $data['type'] . rand(1, 999));
        }
        return Immobile::create($data);
    }

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
     * Get all immobiles rent
     *
     * @return Immobile[]
     */
    public function getAllRent()
    {

        return Immobile::where('rent', true)->paginate(12);
    }
    /**
     * Get all immobiles sale
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
        return Immobile:: //where($slugBussiness, true)
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
        return Immobile::where('rent', true)->orWhere('sale', true)->take($amount)->get();
    }
    /**
     * Get Immobiles similiar Immobile with amount defined
     *
     * @param Immobile $immobile
     * @param int $amount Amount immobiles search
     * @return Immobile[]
     */
    public function getSimilarImmobiles($immobile, $amount)
    {
        return Immobile::where('rent', $immobile->rent)
            ->where('sale', $immobile->sale)
            ->where('neighborhood_id', $immobile->neighborhood_id)
            ->where('type', $immobile->type)
            ->take($amount)->get();
    }

    public function getAllForSelect()
    { }

    public function deleteWithId($id)
    { }

    public function deleteWithSlug($slug)
    { }

    public function getRules($type, $parameters)
    {
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
     * @param Immobile $immobile
     * @return ImageImmobile
     */
    public function createImage($way, $immobile)
    {
        return ImageImmobile::create(['immobile_id' => $immobile->id, 'way' => $way, 'alt' => SiteUtility::getTypesImmobile()[$immobile->type] . ' ' . $immobile->neighborhood->name . ' , ' . $immobile->neighborhood->city->name . ' - Imóveis Ana Paula Pais']);
    }

    /**
     * Return all Neighborhoods for select with city
     *
     * @return array
     */
    public function getAllNeighborhoodsSelectWithCity()
    {
        return ArrayUtility::convertArrayForInputSelectWith2Value(
            'id',
            'name',
            'name_city',
            Neighborhood::join('cities', 'neighborhoods.city_id', '=', 'cities.id')
                ->select('neighborhoods.id', 'neighborhoods.name', 'cities.name AS name_city')->get()
        );
    }
    /**
     * Return all Neighborhoods for select
     *
     * @return void
     */
    public function getAllNeighborhoodsSelect()
    {
        return ArrayUtility::convertArrayForInputSelect('id', 'name', Neighborhood::all());
    }
    /**
     * Register visit if ip not visited immobile
     *
     * @param int $immobile_id Id of Immobile
     * @param string $ip Ip of visitant
     * @return VisitImmobile
     */
    public function registerVisit($immobile_id, $ip)
    {
        return VisitImmobile::firstOrCreate(['immobile_id' => $immobile_id, 'ip' => $ip]);
    }
}