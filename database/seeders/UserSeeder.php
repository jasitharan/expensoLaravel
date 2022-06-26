<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'images/user_images/noimage.jpg';
        
        $address = \App\Models\Address::create([
            "address" => 'araly north',
            "city" => 'jaffna',
            "province" => 'northern',
            "country" => 'srilanka'
        ]);
        
        $bank = \App\Models\Bank::create([
            "name" => 'araly north',
            "number" => 'jaffna',
            "branch" => 'northern',
        ]);
        
        \App\Models\User::create([
            "name" => 'user',
            "email" => 'user@mail.com',
            "password" => bcrypt('12345678'),
            "phoneNumber" => '1234567890',
            "company_id" => 2,
            "role" => "employee",
            'url_image' => Storage::url($path),
            'address_id' => $address->id,
            'bank_id' => $bank->id
        ]);
    }
}
