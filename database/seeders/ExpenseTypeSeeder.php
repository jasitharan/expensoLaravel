<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\ExpenseType::create([
            "expType" => 'Traveling',
            "url_image" => '/storage/images/expense_type_images/noimage.jpg',
            "expCostLimit" => 100000
        ]);
    
    }
}
