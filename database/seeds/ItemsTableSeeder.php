<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x <= 10; $x++) {
            DB::table('items')->insert([
                'name' => str_random(10),
                'description' => str_random(10),
                'stock' => mt_rand(1, 100),
                'cost' => (mt_rand(1*10, 100*10) / 10),
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
