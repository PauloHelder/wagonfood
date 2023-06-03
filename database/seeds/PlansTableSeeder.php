<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name'          => 'Free',
            'url'           => 'free',
            'price'         =>  00.00,
            'description'   => 'Plano Gratis',
        ]);
    }
}
