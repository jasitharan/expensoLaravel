<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShowEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ShowEntry::create([
            "expense_types" => 10,
            "expenses" => 10,
            "users" => 10,
            'companies' => 10,
        ]);
    }
}
