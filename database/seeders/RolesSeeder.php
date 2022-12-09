<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'title'      => 'admin',
            'guard_name' => 'admin',
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('roles')->insert([
            'title'      => 'user',
            'guard_name' => 'user',
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
