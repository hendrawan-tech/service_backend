<?php

namespace Database\Seeders;

use App\Models\ProductService;
use Illuminate\Database\Seeder;

class ProductServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductService::factory()
            ->count(5)
            ->create();
    }
}
