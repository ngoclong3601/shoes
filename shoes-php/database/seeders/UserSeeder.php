<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Long",
            'email' =>'lengoclong3601@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Thủ Đức',
            'phone' => '0123456789',
            'level' => '1'
        ]);   DB::table('users')->insert([
            'name' => "Test",
            'email' =>'Test@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Bình Dương',
            'phone' => '0123454572',
            'level' => '2'
        ]);

    }
}
