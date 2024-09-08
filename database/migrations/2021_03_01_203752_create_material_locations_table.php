<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id')->unsigned();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
//            $table->integer('material_id_foreign')->unsigned();
//            $table->foreign('material_id_foreign')->references('component_id')->on('material_assemblies')->onDelete('cascade');
            $table->string('GPItemNumber')->nullable();
            $table->string('units');
            $table->double('unitCost',8,4);
            $table->double('freightCost',8,4);
//            $table->double('totalCost',8,4);
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
        Schema::dropIfExists('material_locations');
    }
}
