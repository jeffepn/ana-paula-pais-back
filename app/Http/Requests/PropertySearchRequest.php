<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertySearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data.attributes.business' => 'nullable|string',
            'data.attributes.neighborhood' => 'nullable|string',
            'data.attributes.type' => 'nullable|string',
            'data.attributes.garage' => 'nullable|integer',
            'data.attributes.dormitory' => 'nullable|integer',
            'data.attributes.price_min' => 'nullable|numeric',
            'data.attributes.price_max' => 'nullable|numeric',
            'data.attributes.area_min' => 'nullable|numeric',
            'data.attributes.area_max' => 'nullable|numeric',
            'page.number' => 'nullable|integer|min:1',
            'page.size' => 'nullable|integer|min:1|max:100',
        ];
    }
}
