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
            "category" => 10,
            "news" => 10,
            "comment" => 10
        ]);
    }
}
