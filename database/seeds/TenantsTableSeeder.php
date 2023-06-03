<?php

use App\Models\{
    Plan,
    Tenant
};
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $plans = Plan::first();
        $plans->tenants()->create([
            'name' => 'Yeto Africa',
            'url'  => 'yeto-africa',
            'email'=> 'pphelder@gmail.com',
            'nif'  => '123456789',
        ]);
    }
}
