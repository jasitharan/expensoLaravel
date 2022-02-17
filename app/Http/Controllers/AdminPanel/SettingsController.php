<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    // Getting Setting Page
    public function getGlobalSetting()
    {


        $data = array(
            'settings' => Setting::first()
        );
        return view('settings.global_setting')->with($data);
    }

    public function getNotificationSetting()
    {
        $data = array(
            'settings' => Setting::first()
        );
        return view('settings.notification_setting')->with($data);
    }

    public function getMailSetting()
    {
        $data = array(
            'settings' => Setting::first()
        );
        return view('settings.mail_setting')->with($data);
    }


    // Saving Setting
    public function saveSettingGlobal(Request $request)
    {

        $request->validate([
            'app_name' => 'string',
            'app_short_description' => 'string',
            'app_version' => 'string'
        ]);


        Setting::first()->update(
            $request->all()
        );


        return redirect('/settings/global')->with('success', 'Setting Saved Successfully');
    }

    public function saveSettingMail(Request $request)
    {

        $request->validate([
            'mail_mailer' => 'string',
            'mail_host' => 'string',
            'mail_port' => 'string',
            'mail_username' => 'string',
            'mail_password' => 'string',
            'mail_sender_email' => 'string',
            'mail_sender_name' => 'string',
            'mail_encryption' => 'string'
        ]);


        Setting::first()->update(
            $request->all()
        );


        return redirect('/settings/mail')->with('success', 'Setting Saved Successfully');
    }

    public function saveSettingNotification(Request $request)
    {

        $request->validate([
            'fcm_key' => 'string',
        ]);


        Setting::first()->update(
            $request->all()
        );


        return redirect('/settings/notification')->with('success', 'Setting Saved Successfully');
    }
}
