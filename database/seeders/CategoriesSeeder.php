<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'Clothes',
            'slug' => 'clothes',
            'gender_id' => 0,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('categories')->insert([
            'title' => 'Shoes',
            'slug' => 'shoes',
            'gender_id' => 0,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('categories')->insert([
            'title' => 'Accessories',
            'slug' => 'accessories',
            'gender_id' => 0,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        
    }
}
