<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [

            [
                'first_name'        => 'Admin',
                'last_name'         => 'Istrator',
                'email'             => 'administrator@gmail.com',
                'name'=>'Admin',
                'user_type'=>0,
                'phone_number'=>'0708768974',
                'avatar'=>'user.jpg',
                'password'          => bcrypt('1234'),
                'is_verified'         => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            ];

        \Illuminate\Support\Facades\DB::table('users')->insert($users);

    }
}
