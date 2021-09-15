<?php

use App\Models\plan;
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
        plan::create([
            'name' => 'Businers',
            'url' => 'businers',
            'price' => 499.99,
            'description' => 'Plano Empresarial',
        ]);
    }
}
