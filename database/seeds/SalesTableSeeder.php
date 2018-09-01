<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x <= 10; $x++) {
            DB::table('sales')->insert([
                'sale' => (mt_rand(1*10, 20*10) / 10),
                'quantity' => mt_rand(1, 5),
                'created_at' => Carbon::now()->toDateTimeString(),
                'item_id' => mt_rand(1, 10), // TODO: Get ID from Model
            ]);
        }
    }
}
