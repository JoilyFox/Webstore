<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 11; $i <= 21; $i++) {
            DB::table('products')->insert([
                'title' => 'Product '.$i,
                'slug' => 'product-'.$i,
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
                'in_stock' => rand(0, 1),
                'price' => rand(0.1, 999.99),
                'subcategory_id' => 1,                
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
