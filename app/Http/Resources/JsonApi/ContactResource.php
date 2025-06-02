<?php

namespace App\Http\Resources\JsonApi;

use Illuminate\Http\Request;

class ContactResource extends JsonApiResource
{
    public function getAttributes(): array
    {
        return [
            'name' => $this->resource['name'],
            'email' => $this->resource['email'],
            'phone' => $this->resource['phone'],
            'message' => $this->resource['message']
        ];
    }

    public function getRelationships(): array
    {
        return [];
    }

    protected function getIncluded(): array
    {
        return [];
    }
}