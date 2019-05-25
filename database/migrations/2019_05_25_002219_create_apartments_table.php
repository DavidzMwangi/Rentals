<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('apartment_name');
            $table->string('description');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('landlord_id');
            $table->timestamps();


            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('landlord_id')->references('id')->on('land_lords')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
