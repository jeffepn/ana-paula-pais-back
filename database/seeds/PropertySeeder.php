<?php

namespace Database\Seeders;


use Jeffpereira\RealEstate\Models\Property\Business;
use Jeffpereira\RealEstate\Models\Property\BusinessProperty;
use Jeffpereira\RealEstate\Models\Property\ImageProperty;
use Jeffpereira\RealEstate\Models\Property\Property;
use Jeffpereira\RealEstate\Models\Property\Type;
use Jeffpereira\RealEstate\Models\Property\SubType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Jeffpereira\RealEstate\Models\Property\Situation;
use JPAddress\Models\Address\Address;
use JPAddress\Models\Address\City;
use JPAddress\Models\Address\Country;
use JPAddress\Models\Address\Neighborhood;
use JPAddress\Models\Address\State;
use Faker\Factory;

class PropertySeeder extends Seeder
{
    protected $faker;

    public function run(): void
    {
        $this->faker = Factory::create('pt_BR');

        $this->createBusinesses();
        $this->createTypes();
        $this->createCountries();
        $this->createStates();
        $this->createCities();
        $this->createNeighborhoods();
        $this->createProperties();
        $this->createBusinessProperties();
        $this->createImages();
    }

    private function createBusinesses(): void
    {
        $businesses = [
            ['name' => 'VENDA'],
            ['name' => 'ALUGUEL'],
        ];

        foreach ($businesses as $business) {
            Business::updateOrCreate($business);
        }
    }

    private function createTypes(): void
    {
        $types = [
            ['name' => 'Apartamento'],
            ['name' => 'Casa'],
            ['name' => 'Comercial'],
            ['name' => 'Terreno'],
        ];

        foreach ($types as $type) {
            $currentType = Type::updateOrCreate($type);
            SubType::updateOrCreate(array_merge(['type_id' => $currentType->id], $type));
        }
    }

    private function createCountries(): void
    {
        Country::updateOrCreate(['name' => "Brasil"]);
    }

    private function createStates(): void
    {
        $country = Country::first();
        $states = [
            ['country_id' => $country->id, 'name' => 'São Paulo', 'initials' => 'SP'],
            ['country_id' => $country->id, 'name' => 'Rio de Janeiro', 'initials' => 'RJ'],
            ['country_id' => $country->id, 'name' => 'Minas Gerais', 'initials' => 'MG'],
        ];

        foreach ($states as $state) {
            State::updateOrCreate($state);
        }
    }

    private function createCities(): void
    {
        $cities = [
            ['name' => 'São Paulo', 'state_id' => State::inRandomOrder()->first()->id],
            ['name' => 'Rio de Janeiro', 'state_id' => State::inRandomOrder()->first()->id],
            ['name' => 'Belo Horizonte', 'state_id' => State::inRandomOrder()->first()->id],
        ];

        foreach ($cities as $city) {
            City::updateOrCreate($city);
        }
    }

    private function createNeighborhoods(): void
    {
        $neighborhoods = [
            ['name' => 'Jardins', 'city_id' => City::inRandomOrder()->get()->first()->id],
            ['name' => 'Vila Mariana', 'city_id' => City::inRandomOrder()->get()->first()->id],
            ['name' => 'Copacabana', 'city_id' => City::inRandomOrder()->get()->first()->id],
            ['name' => 'Ipanema', 'city_id' => City::inRandomOrder()->get()->first()->id],
            ['name' => 'Savassi', 'city_id' => City::inRandomOrder()->get()->first()->id],
            ['name' => 'Lourdes', 'city_id' => City::inRandomOrder()->get()->first()->id],
        ];

        foreach ($neighborhoods as $neighborhood) {
            Neighborhood::updateOrCreate($neighborhood);
        }
    }

    private function createProperties(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $minDormitory = $this->faker->numberBetween(1, 5);
            $minSuite = $this->faker->numberBetween(1, 5);
            $minGarage = $this->faker->numberBetween(1, 5);
            $minRestroom = $this->faker->numberBetween(1, 5);
            $minBathroom = $this->faker->numberBetween(1, 5);

            $property = new Property();
            $property->code = str_pad($i + 1, 4, '0', STR_PAD_LEFT);
            $property->min_description = $this->faker->text(200);
            $property->content = $this->faker->randomHtml();
            $property->total_area = $this->faker->numberBetween(0, 500);
            $property->useful_area = $this->faker->boolean(20)
                ? $this->faker->numberBetween(0, 500)
                : null;
            $property->ground_area = $this->faker->boolean(20)
                ? $this->faker->numberBetween(0, 500)
                : null;
            $property->building_area = $this->faker->boolean(20)
                ? $this->faker->numberBetween(0, 500)
                : null;
            $property->min_dormitory = $minDormitory;
            $property->max_dormitory = $this->faker->boolean(20)
                ? ($minDormitory + $this->faker->numberBetween(1, 5))
                : null;
            $property->min_suite = $minSuite;
            $property->max_suite = $this->faker->boolean(20)
                ? ($minSuite + $this->faker->numberBetween(1, 5))
                : null;
            $property->min_garage = $minGarage;
            $property->max_garage = $this->faker->boolean(20)
                ? ($minGarage + $this->faker->numberBetween(1, 5))
                : null;
            $property->min_restroom = $minRestroom;
            $property->max_restroom = $this->faker->boolean(20)
                ? ($minRestroom + $this->faker->numberBetween(1, 5))
                : null;
            $property->min_bathroom = $minBathroom;
            $property->max_bathroom = $this->faker->boolean(20)
                ? ($minBathroom + $this->faker->numberBetween(1, 5))
                : null;
            $property->sub_type_id = SubType::inRandomOrder()->first()->id;
            $property->situation_id = Situation::updateOrCreate(['name' => "PRONTO"])->id;
            $property->address_id = Address::create(['neighborhood_id' => Neighborhood::inRandomOrder()->first()->id])->id;
            $property->active = 1;
            $property->save();
        }
    }

    private function createImages(): void
    {
        Property::all()->each(function ($property) {
            for ($i = 0; $i < 5; $i++) {
                $imageRandom = "properties/{$property->id}-{$i}.jpg";
                $contents = file_get_contents('https://picsum.photos/800/600');
                Storage::disk('public')->put($imageRandom, $contents);

                $image = new ImageProperty();
                $image->property_id = $property->id;
                $image->way = $imageRandom;
                $image->thumbnail = $imageRandom;
                $image->order = $i;
                $image->save();
            }
        });
    }

    private function createBusinessProperties(): void
    {
        Property::all()->each(function ($property) {
            Business::all()->each(function ($business) use ($property) {
                if (rand(1, 100) < 30) {
                    return true;
                }

                BusinessProperty::create([
                    'business_id' => $business->id,
                    'property_id' => $property->id,
                    'value' => $business->name === 'VENDA'
                        ? rand(100000, 1000000)
                        : rand(700, 4000),
                ]);
            });
        });
    }
}