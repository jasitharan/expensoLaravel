<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $address = \App\Models\Address::create([
            "address" => 'araly north',
            "city" => 'jaffna',
            "province" => 'northern',
            "country" => 'srilanka'
        ]);
        
        \App\Models\Company::create([
            "id" => 1,
            "name" => 'all',
            "address_id" => $address->id
        ]);
        
        $address2 = \App\Models\Address::create([
            "address" => 'Wellawatta',
            "city" => 'Colombo',
            "province" => 'Western',
            "country" => 'srilanka'
        ]);
        
        \App\Models\Company::create([
            "id" => 2,
            "name" => 'Company 1',
            "address_id" => $address2->id
        ]);
    }
}
