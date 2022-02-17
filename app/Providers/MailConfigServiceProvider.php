<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;



class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('settings')) {
            $mail = DB::table('settings')->first();
            if ($mail) //checking if table is not empty
            {
                $config = array(
                    'driver'     => $mail->mail_mailer,
                    'host'       => $mail->mail_host,
                    'port'       => $mail->mail_port,
                    'from'       => array('address' => $mail->mail_sender_email, 'name' => $mail->mail_sender_name),
                    'encryption' => $mail->mail_encryption,
                    'username'   => $mail->mail_username,
                    'password'   => $mail->mail_password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
