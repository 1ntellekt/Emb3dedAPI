<?php

namespace App\Observers;

use App\Models\Chat;
use App\Http\Controllers\FcmController;

class ChatObserver
{
    /**
     * Handle the Chat "created" event.
     *
     * @param  \App\Models\Chat  $chat
     * @return void
     */
    public function created(Chat $chat)
    {
        $data = [
            'action' => 'chat_holder',
        ];

        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['user_id' => $chat->user_id_first,'data_field' => json_encode($data),]);
        app(FcmController::class)->sendPushNotificationOnlyData($myRequest);

        $myRequest2 = new \Illuminate\Http\Request();
        $myRequest2->setMethod('POST');
        $myRequest2->request->add(['user_id' => $chat->user_id_second,'data_field' => json_encode($data),]);
        app(FcmController::class)->sendPushNotificationOnlyData($myRequest2);
    }

    /**
     * Handle the Chat "updated" event.
     *
     * @param  \App\Models\Chat  $chat
     * @return void
     */
    public function updated(Chat $chat)
    {

        $data = [
            'action' => 'chat_holder',
            'id' => $chat->id,
            'download_first' => $chat->download_first,
            'download_second' => $chat->download_second,
        ];

        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['user_id' => $chat->user_id_first,'data_field' => json_encode($data),]);
        app(FcmController::class)->sendPushNotificationOnlyData($myRequest);

        $myRequest2 = new \Illuminate\Http\Request();
        $myRequest2->setMethod('POST');
        $myRequest2->request->add(['user_id' => $chat->user_id_second,'data_field' => json_encode($data),]);
        app(FcmController::class)->sendPushNotificationOnlyData($myRequest2);
    }

    /**
     * Handle the Chat "deleted" event.
     *
     * @param  \App\Models\Chat  $chat
     * @return void
     */
    public function deleted(Chat $chat)
    {
        $data = [
            'action' => 'chat_holder',
        ];

        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['user_id' => $chat->user_id_first,'data_field' => json_encode($data),]);
        app(FcmController::class)->sendPushNotificationOnlyData($myRequest);

        $myRequest2 = new \Illuminate\Http\Request();
        $myRequest2->setMethod('POST');
        $myRequest2->request->add(['user_id' => $chat->user_id_second,'data_field' => json_encode($data),]);
        app(FcmController::class)->sendPushNotificationOnlyData($myRequest2);
    }

    /**
     * Handle the Chat "restored" event.
     *
     * @param  \App\Models\Chat  $chat
     * @return void
     */
    public function restored(Chat $chat)
    {
        //
    }

    /**
     * Handle the Chat "force deleted" event.
     *
     * @param  \App\Models\Chat  $chat
     * @return void
     */
    public function forceDeleted(Chat $chat)
    {
        //
    }
}
