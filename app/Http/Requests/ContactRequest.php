<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:300',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:300',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Como podemos te chamar',
            'name.max' => 'Que nome grande hein... Limite ele a 50 caracteres.',
            'email.required' => 'Precisamos saber seu e-mail, para que possamos entrar em contato.',
            'email.email' => 'Formato de e-mail inválido.',
            'email.max' => 'Limite o campo a 300 caracteres.',
            'phone.max' => 'Limite o campo a 20 caracteres.',
            'message.required' => 'Descreva em poucas palavras: sua dúvida, mensagem ou sugestão.',
            'message.max' => 'Limite o campo a 300 caracteres.'
        ];
    }
}