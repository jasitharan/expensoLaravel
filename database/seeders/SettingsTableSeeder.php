<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'app_name' => 'Expenso',
            "app_short_description" => 'this is expenso',
            "app_version" => "1.0.0",
            "fcm_key" => 'AAAA55mJKO8:APA91bG9DamDJu-e0zuxMVmJ6ZIjWsjWWYTbi4NVKWE2qhNDPrM2NaMPHOIZJ0IvyPRfr3cmyJE1mTCZwriEFHLNfq9Q4cj035AZLRoIyy1Mod-XCpdyU1dApd3CwQjaUUUrm17g3ghb',
            "mail_mailer" => "smtp",
            "mail_host" => "smtp.mailtrap.io",
            'mail_port' => '2525',
            "mail_username" => '0d923775ddf42b',
            "mail_password" => '9d47958d54b7ab',
            'mail_sender_email' => 'admin@mail.com',
            'mail_sender_name' => 'flutter expenso app',
            'mail_encryption' => 'tls'
        ]);
    }
}
