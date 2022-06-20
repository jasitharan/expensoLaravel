<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'images/user_images/noimage.jpg';
        \App\Models\User::create([
            "name" => 'admin',
            "email" => 'admin@mail.com',
            "password" => bcrypt('12345678'),
            "phoneNumber" => '1234567890',
            "company_id" => 1,
            "role" => "admin",
            'url_image' => Storage::url($path)
        ]);
    }
}
