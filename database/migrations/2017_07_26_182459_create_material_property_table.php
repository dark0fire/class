<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_property', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->integer('value');
            $table->integer('unit_id')->unsigned();
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_property');
    }
}
