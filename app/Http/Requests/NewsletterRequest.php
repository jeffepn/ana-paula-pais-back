<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => [
                'required',
                'string',
                'email',
                'max:300',
                'unique:newsletters,email'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Como podemos te chamar',
            'name.max' => 'Que nome grande hein... Limite ele a 50 caracteres.',
            'email.required' => 'Precisamos do seu e-mail para te manter informado',
            'email.email' => 'Formato de e-mail inválido.',
            'email.max' => 'Limite o campo a 300 caracteres.',
            'email.unique' => 'Você já está cadastrado em nossa Newsletter.'
        ];
    }
}