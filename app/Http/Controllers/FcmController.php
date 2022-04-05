<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use App\Notifications\FcmNotification;
use Exception;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Messaging\Message;
use Kreait\Firebase\Messaging\MulticastSendReport;
use Notification;
use Kreait\Firebase\Messaging\Notification as FcmNotif;

class FcmController extends Controller
{
    
    function sendPushNotification(Request $request)
    {

        //dd($request->all());

        $field = $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        //dd($request);

        //dd($request->data);

        $data=['key'=>'value'];

      if ($request->has('data_field')) {
            $data = json_decode($request->data_field,true);
            //$data = $request->data;
            //dd($data);
        }

        //dd($data);

        //dd($request);

        //$data = ['data1' => 'value', 'data2' => 'value2'];

        $query = Device::where('user_id',$field['user_id'])->get('token');

        if (is_null($query) || $query->count() == 0) {
           return response([
            'status' => false,
            'message' => 'User\'s devices not found!'
           ],200);
        }


        $deviceTokens  = array();

        foreach($query as $it){
            array_push($deviceTokens, $it['token']);
        }
    
        $messaging = app('firebase.messaging');

        $notification = FcmNotif::create($field['title'],$field['body']);

        // $data  = [
        //     'key' => 'value',
        // ];

        $message = CloudMessage::new();
        $message = $message->withNotification($notification);
        $message = $message->withData($data);

            try {
                
              $rep = $messaging->sendMulticast($message, $deviceTokens);

                return response([
                    'status' => true,
                    'message' => 'Send message success!',
                    'report-success' => $rep->successes()->count(),
                    'report-fail' => $rep->failures()->count(),
                ],200);

            } catch(Exception $e) {
                 return response([
                     'status' => false,
                     'message' => 'Error send message from server!'
                 ],200);
            }

        //dd($query);
        //dd(new FcmNotification($field['title'],$field['body'],$data));

        //User::find($field['user_id'])->notify(new FcmNotification($field['title'],$field['body'],$data));

                // return response([
                //     'status' => true,
                //     'message' => 'Send message success!',
                // ],200);
    }

    public function sendPushNotificationAllDevices(Request $request)
    {
        $field = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $query = Device::all();

        if (is_null($query) || $query->count() == 0) {
           return response([
            'status' => false,
            'message' => 'All Users devices not found!'
           ],200);
        }

        $deviceTokens  = array();

        foreach($query as $it){
            array_push($deviceTokens, $it['token']);
        }
    
        $messaging = app('firebase.messaging');

        $notification = FcmNotif::create($field['title'],$field['body']);

        $data  = [
            'key' => 'value',
        ];

        if ($request->has('data_field')) {
            $data = json_decode($request->data_field,true);
            //$data = $request->data;
            //dd($data);
        }

        $message = CloudMessage::new();
        $message = $message->withNotification($notification);
        $message = $message->withData($data);

            try {
                
              $rep = $messaging->sendMulticast($message, $deviceTokens);

                return response([
                    'status' => true,
                    'message' => 'Send message success!',
                    'report-success' => $rep->successes()->count(),
                    'report-fail' => $rep->failures()->count(),
                ],200);

            } catch(Exception $e) {
                 return response([
                     'status' => false,
                     'message' => 'Error send message from server!'
                 ],200);
            }
    }

    public function sendPushNotificationDevices(Request $request)
    {
        // $field = $request->validate([
        //     'title' => 'required',
        //     'body' => 'required',
        // ]);

        $query = Device::all();

        if (is_null($query) || $query->count() == 0) {
           return response([
            'status' => false,
            'message' => 'All Users devices not found!'
           ],200);
        }

        $deviceTokens  = array();

        foreach($query as $it){
            array_push($deviceTokens, $it['token']);
        }
    
        $messaging = app('firebase.messaging');

        //$notification = FcmNotif::create($field['title'],$field['body']);

        $data  = [
            'key' => 'value',
        ];

        if ($request->has('data_field')) {
            $data = json_decode($request->data_field,true);
            //$data = $request->data;
            //dd($data);
        }

        $message = CloudMessage::new();
        //$message = $message->withNotification($notification);
        $message = $message->withData($data);

            try {
                
              $rep = $messaging->sendMulticast($message, $deviceTokens);

                return response([
                    'status' => true,
                    'message' => 'Send message success!',
                    'report-success' => $rep->successes()->count(),
                    'report-fail' => $rep->failures()->count(),
                ],200);

            } catch(Exception $e) {
                 return response([
                     'status' => false,
                     'message' => 'Error send message from server!'
                 ],200);
            }
    }

}
