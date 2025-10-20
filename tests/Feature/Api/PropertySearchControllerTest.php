<?php

namespace Tests\Feature\Api;

use Jeffpereira\RealEstate\Models\Property\Business;
use Jeffpereira\RealEstate\Models\Property\BusinessProperty;
use Jeffpereira\RealEstate\Models\Property\ImageProperty;
use Jeffpereira\RealEstate\Models\Property\Property;
use Jeffpereira\RealEstate\Models\Property\SubType;
use Jeffpereira\RealEstate\Models\Property\Type;
use JPAddress\Models\Address\Address;
use JPAddress\Models\Address\City;
use JPAddress\Models\Address\Neighborhood;
use JPAddress\Models\Address\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PropertySearchControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private Property $property;
    private Business $business;
    private Type $type;
    private SubType $subType;
    private Address $address;
    private Neighborhood $neighborhood;
    private City $city;
    private State $state;
    private ImageProperty $image;

    /** @test */
    public function it_can_search_properties_without_filters()
    {
        $response = $this->getJson('/api/properties/search');

        $response->assertStatus(Response::HTTP_OK);
        // dd($response->json());
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'type',
                    'id',
                    'attributes' => [
                        'code',
                        'slug',
                        'min_description',
                        'content',
                        'building_area',
                        'total_area',
                        'useful_area',
                        'ground_area',
                        'min_dormitory',
                        'max_dormitory',
                        'min_bathroom',
                        'max_bathroom',
                        'min_suite',
                        'max_suite',
                        'min_garage',
                        'max_garage',
                    ],
                    'relationships' => [
                        'businesses',
                        'type',
                        'sub_type',
                        'address',
                        'neighborhood',
                        'city',
                        'state',
                        'images',
                    ],
                ],
            ],
            'included' => [
                '*' => [
                    'type',
                    'id',
                    'attributes',
                ],
            ],
            'meta' => [
                'total',
                'current_page',
                'per_page',
                'last_page',
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
        ]);
    }

    /** @test */
    public function it_can_search_properties_by_business()
    {
        $response = $this->getJson('/api/properties/search?business=' . $this->business->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.attributes.code', $this->property->code);
    }

    /** @test */
    public function it_can_search_properties_by_neighborhood()
    {
        $response = $this->getJson('/api/properties/search?neighborhood=' . $this->neighborhood->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.attributes.code', $this->property->code);
    }

    /** @test */
    public function it_can_search_properties_by_type()
    {
        $response = $this->getJson('/api/properties/search?type=' . $this->subType->id);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.attributes.code', $this->property->code);
    }

    /** @test */
    public function it_can_search_properties_by_garage_range()
    {
        $response = $this->getJson('/api/properties/search?min_garage=1&max_garage=3');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.attributes.code', $this->property->code);
    }

    /** @test */
    public function it_can_search_properties_by_dormitory_range()
    {
        $response = $this->getJson('/api/properties/search?min_dormitory=2&max_dormitory=4');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.attributes.code', $this->property->code);
    }

    /** @test */
    public function it_can_search_properties_by_bathroom_range()
    {
        $response = $this->getJson('/api/properties/search?min_bathroom=1&max_bathroom=3');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.attributes.code', $this->property->code);
    }

    /** @test */
    public function it_can_search_properties_by_suite_range()
    {
        $response = $this->getJson('/api/properties/search?min_suite=0&max_suite=2');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.attributes.code', $this->property->code);
    }

    /** @test */
    public function it_returns_empty_results_when_suite_range_does_not_match()
    {
        $response = $this->getJson('/api/properties/search?min_suite=3&max_suite=5');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(0, 'data')
            ->assertJsonPath('meta.total', 0);
    }

    /** @test */
    public function it_returns_empty_results_when_suite_range_is_invalid()
    {
        $response = $this->getJson('/api/properties/search?min_suite=5&max_suite=2');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(0, 'data')
            ->assertJsonPath('meta.total', 0);
    }

    /** @test */
    public function it_can_search_properties_by_price_range()
    {
        $response = $this->getJson('/api/properties/search?price_min=400000&price_max=600000');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.attributes.code', $this->property->code);
    }

    /** @test */
    public function it_returns_empty_results_when_price_range_does_not_match()
    {
        $response = $this->getJson('/api/properties/search?price_min=700000&price_max=800000');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(0, 'data')
            ->assertJsonPath('meta.total', 0);
    }

    /** @test */
    public function it_returns_empty_results_when_price_range_is_invalid()
    {
        $response = $this->getJson('/api/properties/search?price_min=600000&price_max=400000');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(0, 'data')
            ->assertJsonPath('meta.total', 0);
    }

    /** @test */
    public function it_can_search_properties_by_area_range()
    {
        $response = $this->getJson('/api/properties/search?area_min=100&area_max=300');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.attributes.code', $this->property->code);
    }

    /** @test */
    public function it_returns_empty_results_when_area_range_does_not_match()
    {
        $response = $this->getJson('/api/properties/search?area_min=400&area_max=500');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(0, 'data')
            ->assertJsonPath('meta.total', 0);
    }

    /** @test */
    public function it_returns_empty_results_when_area_range_is_invalid()
    {
        $response = $this->getJson('/api/properties/search?area_min=300&area_max=100');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(0, 'data')
            ->assertJsonPath('meta.total', 0);
    }

    /** @test */
    public function it_can_paginate_results()
    {
        // Criar mais 15 propriedades
        Property::factory(15)->create([
            'address_id' => $this->address->id,
            'sub_type_id' => $this->subType->id,
            'active' => 1,
        ])->each(fn ($property) => BusinessProperty::factory()->create([
            'property_id' => $property->id,
            'business_id' => $this->business->id,
            'value' => 500000.00,
            'old_value' => 550000.00,
            'status' => true,
            'status_situation' => 1,
        ]));

        $response = $this->getJson('/api/properties/search?page=2&size=10');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(6, 'data') // 16 propriedades no total, 10 na primeira página, 6 na segunda
            ->assertJsonPath('meta.current_page', 2)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonPath('meta.total', 16);
    }

    /** @test */
    public function it_returns_empty_results_when_no_properties_match_filters()
    {
        $response = $this->getJson('/api/properties/search?min_garage=10');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(0, 'data')
            ->assertJsonPath('meta.total', 0);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Criar estado
        $this->state = State::factory()->create([
            'name' => 'São Paulo',
            'slug' => 'sao-paulo',
            'initials' => 'SP',
        ]);

        // Criar cidade
        $this->city = City::factory()->create([
            'name' => 'São Paulo',
            'slug' => 'sao-paulo',
            'state_id' => $this->state->id,
        ]);

        // Criar bairro
        $this->neighborhood = Neighborhood::factory()->create([
            'name' => 'Vila Mariana',
            'slug' => 'vila-mariana',
            'city_id' => $this->city->id,
        ]);

        // Criar endereço
        $this->address = Address::factory()
            ->create([
                'address' => 'Rua Exemplo',
                'number' => 123,
                'neighborhood_id' => $this->neighborhood->id,
            ]);

        // Criar tipo
        $this->type = Type::factory()->create([
            'name' => 'Casa',
            'slug' => 'casa',
        ]);

        // Criar subtipo
        $this->subType = SubType::factory()->create([
            'name' => 'Casa Padrão',
            'slug' => 'casa-padrao',
            'type_id' => $this->type->id,
        ]);

        // Criar negócio
        $this->business = Business::factory()->create([
            'name' => 'Venda',
            'name_completed' => 'Venda de Imóvel',
        ]);

        // Criar propriedade
        $this->property = Property::factory()->create([
            'code' => 12345,
            'slug' => 'casa-vila-mariana',
            'min_description' => 'Casa em Vila Mariana',
            'content' => 'Descrição completa da casa',
            'building_area' => 150.5,
            'total_area' => 200.0,
            'useful_area' => 180.0,
            'ground_area' => 250.0,
            'min_dormitory' => 3,
            'max_dormitory' => 3,
            'min_bathroom' => 2,
            'max_bathroom' => 2,
            'min_suite' => 1,
            'max_suite' => 1,
            'min_garage' => 2,
            'max_garage' => 2,
            'address_id' => $this->address->id,
            'sub_type_id' => $this->subType->id,
            'active' => 1,
        ]);

        // Vincular negócio à propriedade
        BusinessProperty::factory()->create([
            'property_id' => $this->property->id,
            'business_id' => $this->business->id,
            'value' => 500000.00,
            'old_value' => 550000.00,
            'status' => true,
            'status_situation' => 1,
        ]);

        // Criar imagem
        $this->image = ImageProperty::factory()->create([
            'property_id' => $this->property->id,
            'way' => 'properties/image.jpg',
            'thumbnail' => 'properties/thumb.jpg',
            'alt' => 'Casa em Vila Mariana',
            'order' => 1,
        ]);
    }
}
