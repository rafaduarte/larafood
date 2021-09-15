<?php

use App\Models\plan;
use App\Models\Tenant;
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
        $plan = plan::first();

        $plan->tenants()->create([
            'cnpj' => '2554536546654',
            'name' => 'PontoPonto',
            'url' => 'Pontoponto',
            'email' => 'ponto@mail.com',
        ]);
    }
}
