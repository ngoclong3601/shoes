<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_name' => "Air Force 1 Nike-Gucci Coloway ",
            'price' => "3200000",
            'image' =>'nike-air-force-1-id-gucci-1.jpg',
            'category_id' => '1',
            'prkeywords' => 'Nike Gucci Colorway',
        ]);
        DB::table('products')->insert([
            'product_name' => "Air Jordan 1 Mid Electro Orange",
            'price' => "4500000",
            'image' =>'Air-Jordan-1-Mid-Electro-Orange.jpg',
            'category_id' => '1',
            'prkeywords' => 'Electro Orange',
         

        ]);
        DB::table('products')->insert([
            'product_name' => "Nike Air Force 1 Low Space Jam",
            'price' => "4600000",
            'image' =>'Nike-Air-Force-1-Low-Space-Jam.jpg',
            'category_id' => '1',
            'prkeywords' => 'Low Space Jam',
        

        ]);
        DB::table('products')->insert([
            'product_name' => "New Balance 990 VS2 Grey",
            'price' => "5500000",
            'image' =>'New-Balance-990-VS2-Grey.jpg',
            'category_id' => '5',
            'prkeywords' => 'New Balance 990 VS2',
           

        ]);
        DB::table('products')->insert([
            'product_name' => "Classic Sport SK8-HI",
            'price' => "1500000",
            'image' =>'van.png',
            'category_id' => '4',
            'prkeywords' => 'SK8-HI',
           

        ]);
    }
}
