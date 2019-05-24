<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function (Blueprint $table){
           $table->integer('user_type');//0-admin 1-landlord 2-tenant
           $table->boolean('is_verified')->default(true);
           $table->string('phone_number');
           $table->string('first_name');
           $table->string('last_name');
           $table->string('avatar')->default('user_jpg');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function (Blueprint $table){
            $table->dropColumn('user_type');
            $table->dropColumn('is_verified');
            $table->dropColumn('phone_number');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('avatar');



        });
    }
}
