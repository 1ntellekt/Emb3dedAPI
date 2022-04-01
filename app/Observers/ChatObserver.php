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
        
    }

    /**
     * Handle the Chat "updated" event.
     *
     * @param  \App\Models\Chat  $chat
     * @return void
     */
    public function updated(Chat $chat)
    {

        if($chat->download_first == true){
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['user_id' => $chat->user_id_first,'title' => 'Aceess download','body' => $chat->user_first->login.' get access to download on chat',]);
            app(FcmController::class)->sendPushNotification($myRequest);
        } else {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['user_id' => $chat->user_id_first,'title' => 'Close download','body' => $chat->user_first->login.' close access to download on chat',]);
            app(FcmController::class)->sendPushNotification($myRequest);
        }



        if($chat->download_second == true){
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['user_id' => $chat->user_id_second,'title' => 'Aceess download','body' => $chat->user_second->login.' get access to download on chat',]);
            app(FcmController::class)->sendPushNotification($myRequest);
        } else {
            $myRequest = new \Illuminate\Http\Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['user_id' => $chat->user_id_second,'title' => 'Close download','body' => $chat->user_second->login.' close access to download on chat',]);
            app(FcmController::class)->sendPushNotification($myRequest);
        }
    }

    /**
     * Handle the Chat "deleted" event.
     *
     * @param  \App\Models\Chat  $chat
     * @return void
     */
    public function deleted(Chat $chat)
    {
        //
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
