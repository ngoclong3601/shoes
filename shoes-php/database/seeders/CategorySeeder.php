<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => "NIKE",
            'keywords' => "nike",
        ]);
        DB::table('categories')->insert([
            'name' => "CONVERSES",
            'keywords' => "converses",
        ]);
        DB::table('categories')->insert([
            'name' => "ADIDAS",
            'keywords' => "adidas",
        ]);
        DB::table('categories')->insert([
            'name' => "VANS",
            'keywords' => "vans",
        ]);
        DB::table('categories')->insert([
            'name' => "NEW BALANCE",
            'keywords' => "new balance",
        ]);
        DB::table('categories')->insert([
            'name' => "BALANCIAGA",
            'keywords' => "balanciaga",
        ]);
    }
}
