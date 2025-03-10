<?php

namespace App\Console\Commands;

use App\Models\Site\Newsletter;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Jeffpereira\RealEstate\Models\Property\Business;
use Jeffpereira\RealEstate\Models\Property\BusinessProperty;
use Jeffpereira\RealEstate\Models\Property\ImageProperty;
use Jeffpereira\RealEstate\Models\Property\Property;
use Jeffpereira\RealEstate\Models\Property\SubType;
use Jeffpereira\RealEstate\Models\Property\Type;
use JPAddress\Models\Address\Address;
use JPAddress\Models\Address\Neighborhood;

class SyncOldWithNewDB extends Command
{
    /**
     * @var Business
     */
    protected $sale;

    /**
     * @var Business
     */
    protected $rent;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:dbs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync old db with new';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->sale = Business::firstOrCreate(['name' => 'Venda']);
        $this->rent = Business::firstOrCreate(['name' => 'Aluguel']);
        DB::connection('mysql_old')->table('immobiles')->get()->each(function ($immobile) {
            if (!$immobile->sold) {
                $property = $this->createProperty($immobile);
                $this->createBusinessProperty($immobile, $property);
                $this->createImageProperties($immobile, $property);
            }
        });
        $this->syncNewsletters();
        $this->syncUsers();
        return 0;
    }

    private function createProperty($immobile): Property
    {

        $code = Str::replaceFirst('AN-', '', $immobile->slug);
        $subType = SubType::firstOrCreate(['name' => 'Apartamento', 'type_id' => Type::firstOrCreate(['name' => 'Apartamento'])->id]);

        return Property::create([
            'address_id' => $this->getAddressId($immobile),
            'sub_type_id' => $subType->id,
            'slug' => Str::slug($immobile->slug),
            'code' => $code,
            'building_area' => $immobile->area_building,
            'total_area' => $immobile->area_total,
            'items' => $this->generateItems($immobile),
            'min_description' => $immobile->min_description,
            'content' => $immobile->description,
            'min_description' => $immobile->min_description,
            'max_dormitory' => $immobile->dormitory,
            'max_bathroom' => $immobile->bathroom,
            'max_suite' => $immobile->suite,
            'max_garage' => $immobile->garage,
            'active' => true,
            'created_at' => $immobile->created_at,
            'updated_at' => $immobile->updated_at,
        ]);
    }

    private function generateItems($immobile): string
    {
        $items = $immobile->value_condominium && $immobile->value_condominium > 0
            ? "Condomínio: " . number_format($immobile->value_condominium, 2, ',', '.') . ";"
            : '';
        $items .= $immobile->value_iptu && $immobile->value_iptu > 0
            ? "IPTU: " . number_format($immobile->value_iptu, 2, ',', '.') . ";"
            : '';
        return $items;
    }

    private function getAddressId($immobile): string
    {
        $neighborhoodOld = DB::connection('mysql_old')->table('neighborhoods')->whereId($immobile->neighborhood_id)->first();
        $cityOld = DB::connection('mysql_old')->table('cities')->whereId($neighborhoodOld->city_id)->first();
        $stateOld = DB::connection('mysql_old')->table('states')->whereId($cityOld->state_id)->first();

        return Property::createAddress([
            'neighborhood' => $neighborhoodOld->name,
            'city' => $cityOld->name,
            'state' => $stateOld->name,
            'initials' => $stateOld->initials,
            'country' => 'Brasil'
        ])->id;
    }

    private function createBusinessProperty($immobile, Property $property): void
    {
        if ($immobile->rent) {
            BusinessProperty::create([
                'property_id' => $property->id,
                'business_id' => $this->rent->id,
                'value' => $immobile->value_rent,
                'status' => true
            ]);
        }

        if ($immobile->sale) {
            BusinessProperty::create([
                'property_id' => $property->id,
                'business_id' => $this->sale->id,
                'value' => $immobile->value_sale,
                'status' => true
            ]);
        }
    }
    private function createImageProperties($immobile, Property $property): void
    {
        DB::connection('mysql_old')
            ->table('image_immobiles')
            ->whereImmobileId($immobile->id)
            ->get()
            ->each(function ($imageOld, $key) use ($property) {
                ImageProperty::create([
                    'property_id' => $property->id,
                    'way' => $imageOld->way,
                    'alt' => $imageOld->alt,
                    'order' => $key + 1,
                    'created_at' => $property->created_at,
                    'updated_at' => $property->updated_at
                ]);
            });
    }

    private function syncNewsletters(): void
    {
        DB::connection('mysql_old')
            ->table('newsletters')
            ->get()
            ->each(function ($newsletter) {
                Newsletter::create((array) $newsletter);
            });
    }

    private function syncUsers(): void
    {
        DB::connection('mysql_old')
            ->table('users')
            ->get()
            ->each(function ($user) {
                User::create((array) $user);
            });
    }
}
