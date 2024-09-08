<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('locationName')->unique();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country'); 
            $table->string('currency');
            $table->boolean('VAT', false);
            $table->double('VATRate',8,2);
            $table->string('postalCode');
            $table->string('GPdatabase');//            
            $table->rememberToken();            
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
        Schema::dropIfExists('locations');
    }
}

