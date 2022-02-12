<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductServiceCategory;

class ProductServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductServiceCategory::factory()
            ->count(5)
            ->create();
    }
}
