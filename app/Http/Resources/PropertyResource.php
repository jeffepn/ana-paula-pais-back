<?php

namespace App\Http\Resources;

use App\Http\Resources\JsonApi\JsonApiResource;
use Illuminate\Support\Facades\Storage;

class PropertyResource extends JsonApiResource
{
    public function getAttributes(): array
    {
        return [
            'code' => $this->code,
            'slug' => $this->slug,
            'min_description' => $this->min_description,
            'content' => $this->content,
            'items' => $this->items,
            'building_area' => $this->building_area,
            'total_area' => $this->total_area,
            'useful_area' => $this->useful_area,
            'ground_area' => $this->ground_area,
            'min_dormitory' => $this->min_dormitory,
            'max_dormitory' => $this->max_dormitory,
            'min_bathroom' => $this->min_bathroom,
            'max_bathroom' => $this->max_bathroom,
            'min_suite' => $this->min_suite,
            'max_suite' => $this->max_suite,
            'min_garage' => $this->min_garage,
            'max_garage' => $this->max_garage,
            'min_restroom' => $this->min_restroom,
            'max_restroom' => $this->max_restroom,
            'embed' => $this->embed,
            'has_plate' => $this->has_plate,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function getRelationships(): array
    {
        return [
            'businesses' => [
                'data' => $this->businesses->map(function ($business) {
                    return [
                        'type' => 'businesses',
                        'id' => $business->pivot->id
                    ];
                })
            ],
            'type' => [
                'data' => [
                    'type' => 'types',
                    'id' => $this->sub_type->type->id
                ]
            ],
            'sub_type' => [
                'data' => [
                    'type' => 'sub_types',
                    'id' => $this->sub_type->id
                ]
            ],
            'address' => [
                'data' => [
                    'type' => 'addresses',
                    'id' => $this->address->id
                ]
            ],
            'neighborhood' => [
                'data' => [
                    'type' => 'neighborhoods',
                    'id' => $this->address->neighborhood->id
                ]
            ],
            'city' => [
                'data' => [
                    'type' => 'cities',
                    'id' => $this->address->neighborhood->city->id
                ]
            ],
            'state' => [
                'data' => [
                    'type' => 'states',
                    'id' => $this->address->neighborhood->city->state->id
                ]
            ],
            'images' => [
                'data' => $this->images->map(function ($image) {
                    return [
                        'type' => 'images',
                        'id' => $image->id
                    ];
                })
            ]
        ];
    }

    protected function getIncluded(): array
    {
        $included = [];

        // Adiciona os negócios (businesses)
        $this->businesses->each(function ($business) use (&$included) {
            $included[] = [
                'type' => 'businesses',
                'id' => $business->pivot->id,
                'attributes' => [
                    'name' => $business->name,
                    'name_completed' => $business->name_completed,
                    'value' => $business->pivot->value,
                    'old_value' => $business->pivot->old_value,
                    'status' => $business->pivot->status,
                    'status_situation' => $business->pivot->status_situation
                ]
            ];
        });

        // Adiciona o tipo e subtipo
        $included[] = [
            'type' => 'types',
            'id' => $this->sub_type->type->id,
            'attributes' => [
                'name' => $this->sub_type->type->name,
                'slug' => $this->sub_type->type->slug
            ]
        ];

        $included[] = [
            'type' => 'sub_types',
            'id' => $this->sub_type->id,
            'attributes' => [
                'name' => $this->sub_type->name,
                'slug' => $this->sub_type->slug
            ]
        ];

        // Adiciona o endereço
        $included[] = [
            'type' => 'addresses',
            'id' => $this->address->id,
            'attributes' => [
                'address' => $this->address->address,
                'number' => $this->address->number,
                'not_number' => $this->address->not_number,
                'complement' => $this->address->complement,
                'cep' => $this->address->cep,
                'longitude' => $this->address->longitude,
                'latitude' => $this->address->latitude
            ]
        ];

        // Adiciona o bairro
        $included[] = [
            'type' => 'neighborhoods',
            'id' => $this->address->neighborhood->id,
            'attributes' => [
                'name' => $this->address->neighborhood->name,
                'slug' => $this->address->neighborhood->slug
            ]
        ];

        // Adiciona a cidade
        $included[] = [
            'type' => 'cities',
            'id' => $this->address->neighborhood->city->id,
            'attributes' => [
                'name' => $this->address->neighborhood->city->name,
                'slug' => $this->address->neighborhood->city->slug
            ]
        ];

        // Adiciona o estado
        $included[] = [
            'type' => 'states',
            'id' => $this->address->neighborhood->city->state->id,
            'attributes' => [
                'name' => $this->address->neighborhood->city->state->name,
                'slug' => $this->address->neighborhood->city->state->slug,
                'initials' => $this->address->neighborhood->city->state->initials
            ]
        ];

        // Adiciona as imagens
        $this->images->each(function ($image) use (&$included) {
            $included[] = [
                'type' => 'images',
                'id' => $image->id,
                'attributes' => [
                    'url' => Storage::disk('public')->url($image->way),
                    'thumbnail' => $image->thumbnail ? Storage::disk('public')->url($image->thumbnail) : null,
                    'alt' => $image->alt,
                    'order' => $image->order
                ]
            ];
        });

        return $included;
    }
}