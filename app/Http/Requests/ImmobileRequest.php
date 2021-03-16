<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImmobileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == "POST")
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
        if ($this->method() == "PUT" || $this->method() == "PATCH")
            return [
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
            ];
        return [];
    }
    public function  messages()
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
}
