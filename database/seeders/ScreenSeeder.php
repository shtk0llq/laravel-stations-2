<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            ['id' => 1, 'name' => 'スクリーン1'],
            ['id' => 2, 'name' => 'スクリーン2'],
            ['id' => 3, 'name' => 'スクリーン3'],
        ];

        foreach ($seeds as $seed) {
            DB::table('screens')->insert($seed);
        }
    }
}
