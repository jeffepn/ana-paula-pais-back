<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertySearchRequest extends FormRequest
{

    public function rules()
    {
        return [
            'search' => 'nullable|string',
            'business' => 'nullable|string|uuid',
            'neighborhood' => 'nullable|string|uuid',
            'type' => 'nullable|string|uuid',
            'min_garage' => 'nullable|integer',
            'max_garage' => 'nullable|integer',
            'min_dormitory' => 'nullable|integer',
            'max_dormitory' => 'nullable|integer',
            'min_bathroom' => 'nullable|integer',
            'max_bathroom' => 'nullable|integer',
            'min_suite' => 'nullable|integer',
            'max_suite' => 'nullable|integer',
            'price_min' => 'nullable|numeric',
            'price_max' => 'nullable|numeric',
            'area_min' => 'nullable|numeric',
            'area_max' => 'nullable|numeric',
            'page' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1|max:100',
        ];
    }
}
