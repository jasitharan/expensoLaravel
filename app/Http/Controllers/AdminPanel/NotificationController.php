<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Setting;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Send Notification Page
    public function getNotificationPage()
    {

        $news = News::all();
        $data = array(
            'news' => $news,
        );
        return view('notification')->with($data);
    }

    public function sendNotification(Request $request)
    {

        $request->validate(
            [
                'news' => 'required',
                'notificationBody' => 'required'
            ]
        );

        $settings = Setting::first();
        $news = json_decode($request->news);
        $SERVER_API_KEY = $settings->fcm_key;

        $data = [
            "to" => "/topics/all",
            "notification" => [
                "title" => $news->title,
                "body" => $request->notificationBody,
                "image" => $news->url_image,
                "sound" => "default"
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        return redirect('/notifications')->with('success', 'Notification Send Successfully');
    }
}
