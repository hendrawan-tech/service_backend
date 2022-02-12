<?php

namespace Database\Seeders;

use App\Models\Orderitems;
use Illuminate\Database\Seeder;

class OrderitemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orderitems::factory()
            ->count(5)
            ->create();
    }
}
