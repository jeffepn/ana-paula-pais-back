<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immobiles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('slug', 10);
            $table->bigInteger('neighborhood_id')->unsigned();
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods');
            $table->boolean('rent')->nullable()->default(false);
            $table->boolean('sale')->nullable()->default(false);
            $table->decimal('value_rent', 10, 2)->nullable()->default(null);
            $table->decimal('value_sale', 10, 2)->nullable()->default(null);
            $table->integer('type');
            $table->integer('dormitory')->nullable()->default(null);
            $table->integer('suite')->nullable()->default(null);
            $table->integer('bathroom')->nullable()->default(null);
            $table->integer('garage')->nullable()->default(null);
            $table->decimal('value_condominium', 10, 2);
            $table->decimal('value_iptu', 10, 2);
            $table->decimal('area_total', 10, 2);
            $table->decimal('area_building', 10, 2);
            $table->string('min_description', 50);
            $table->text('description', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('immobiles');
    }
}