<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('size')->insert([
            'name_size' => '39',
            'quantity' => '5'

        ]);
        DB::table('size')->insert([
            'name_size' => '40',
            'quantity' => '10'

        ]);
        DB::table('size')->insert([
            'name_size' => '41',
            'quantity' => '10'

        ]);
        DB::table('size')->insert([
            'name_size' => '42',
            'quantity' => '8'

        ]);
    }
}
