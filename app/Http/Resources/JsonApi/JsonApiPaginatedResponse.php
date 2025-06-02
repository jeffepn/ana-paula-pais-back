<?php

namespace App\Http\Resources\JsonApi;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class JsonApiPaginatedResponse extends JsonResource
{
    protected string $resourceClass;
    protected Collection $included;

    public function __construct(LengthAwarePaginator $paginator, string $resourceClass)
    {
        parent::__construct($paginator);
        $this->resourceClass = $resourceClass;
        $this->included = collect();
    }

    public function toArray($request): array
    {
        $resources = $this->resourceClass::collection($this->resource->items());

        // Coleta todos os recursos incluídos
        $resources->each(function ($resource) {
            $resource->loadIncluded();
            $this->included = $this->included->merge($resource->included);
        });

        return [
            'data' => $resources->map(function ($resource) {
                $id = $resource->getId();
                $relationships = $resource->getRelationships();

                $data = $id ?
                    [
                        'type' => $resource->getType(),
                        'id' => $id,
                        'attributes' => $resource->getAttributes(),
                    ]
                    : [
                        'type' => $resource->getType(),
                        'attributes' => $resource->getAttributes(),
                    ];


                if (!empty($relationships)) {
                    $data['relationships'] = $relationships;
                }
                return $data;
            }),
            'included' => $this->included->unique(function ($item) {
                return $item['type'] . '-' . $item['id'];
            })->values(),
            'meta' => [
                'total' => $this->resource->total(),
                'current_page' => $this->resource->currentPage(),
                'per_page' => $this->resource->perPage(),
                'last_page' => $this->resource->lastPage()
            ],
            'links' => [
                'first' => $this->resource->url(1),
                'last' => $this->resource->url($this->resource->lastPage()),
                'prev' => $this->resource->previousPageUrl(),
                'next' => $this->resource->nextPageUrl()
            ]
        ];
    }
}