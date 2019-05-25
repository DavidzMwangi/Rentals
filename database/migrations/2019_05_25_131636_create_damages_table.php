<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDamagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('damages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_number_id');
            $table->unsignedBigInteger('tenant_id');
            $table->string('description');
            $table->boolean('is_active');
            $table->float('price')->default(0);
            $table->timestamps();

            $table->foreign('room_number_id')->references('id')->on('room_numbers')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('damages');
    }
}
