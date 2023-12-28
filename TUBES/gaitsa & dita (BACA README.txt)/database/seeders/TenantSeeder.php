<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::create([
            'name' => 'Warunk GG',
            'description' => 'Ga enak lu bole tabok gw',
            'address' => 'Jl. Otista No. 0',
            'phone' => '082398147823'
        ]);

        Tenant::create([
            'name' => 'Bang Jago',
            'description' => 'Chefnya sangat amat jago',
            'address' => 'Jl. Viva la vida No. 921',
            'phone' => '089287923017'
        ]);
    }
}
