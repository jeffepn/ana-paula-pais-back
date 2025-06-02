<?php

namespace App\Http\Resources\JsonApi;

use App\Models\Site\Newsletter;

class NewsletterResource extends JsonApiResource
{
    public function __construct(Newsletter $resource)
    {
        parent::__construct($resource);
    }

    public function getAttributes(): array
    {
        return [
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'created_at' => $this->resource->created_at
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