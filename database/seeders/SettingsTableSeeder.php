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
            "fcm_key" => 'AAAABKkCICw:APA91bFlDP-p5eFdUQ01DFXz_Q_yg-2c8mpqzBjBqhkNs3V3vkqn4iGf_HExqmVQa7dLahrcdJOEvv5c2GYvCUKybo6lqs3aY9afduq_fgRzec1pUzNtMX-z09mOOiV8Pwr_jChKbbCx',
            "mail_mailer" => "smtp",
            "mail_host" => "smtp.mailtrap.io",
            'mail_port' => '2525',
            "mail_username" => '1aecbe4eb00cec',
            "mail_password" => '58e642f8ac23e9',
            'mail_sender_email' => 'admin@mail.com',
            'mail_sender_name' => 'flutter expenso app',
            'mail_encryption' => 'tls'
        ]);
    }
}
