<?php

namespace App\Observers;

use App\Models\Device;
use App\Http\Controllers\FcmController;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\CloudMessage;

class DeviceObserver
{
    /**
     * Handle the Device "created" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function created(Device $device)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['user_id' => $device->user_id,'title' => 'Success auth','body' => 'Вы успешно авторизованы!',]);
        app(FcmController::class)->sendPushNotification($myRequest);
    }

    /**
     * Handle the Device "updated" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function updated(Device $device)
    {
        //
    }

    /**
     * Handle the Device "deleted" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function deleted(Device $device)
    {
        // $messaging = app('firebase.messaging');
        // $data = [];
        // $notification = Notification::create('Title delete','Body delete device');
        // $message = CloudMessage::withTarget('token', $device->device_token)
        // ->withNotification($notification); // optional
        // $message->withData($data); // optional
        // $messaging->send($message);
    }

    /**
     * Handle the Device "restored" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function restored(Device $device)
    {
        //
    }

    /**
     * Handle the Device "force deleted" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function forceDeleted(Device $device)
    {
        //
    }
}
