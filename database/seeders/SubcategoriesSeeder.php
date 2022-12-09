<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            'title' => 'T-shirts',
            'slug' => 't-shirts',
            'category_id' => 1,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
