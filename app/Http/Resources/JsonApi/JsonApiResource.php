<?php

namespace App\Http\Resources\JsonApi;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

abstract class JsonApiResource extends JsonResource
{
    public Collection $included;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->included = collect();
    }

    abstract public function getAttributes(): array;
    abstract public function getRelationships(): array;
    abstract protected function getIncluded(): array;

    public function toArray($request): array
    {
        $this->loadIncluded();
        $relationships = $this->getRelationships();
        $id = $this->getId();

        $data = $id ?
            [
                'type' => $this->getType(),
                'id' => $id,
                'attributes' => $this->getAttributes(),
            ]
            : [
                'type' => $this->getType(),
                'attributes' => $this->getAttributes(),
            ];


        if (!empty($relationships)) {
            $data['relationships'] = $relationships;
        }

        return $data;
    }

    public function getType(): string
    {
        return "contacts";
    }

    public function getId(): string
    {
        return $this->resource->id ?? '';
    }

    public function loadIncluded(): void
    {
        $this->included = collect($this->getIncluded());
    }

    protected function addToIncluded(array $data): void
    {
        $this->included->push($data);
    }
}