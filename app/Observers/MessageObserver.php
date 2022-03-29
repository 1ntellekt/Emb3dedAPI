<?php

namespace App\Observers;

use App\Models\Message;
use App\Http\Controllers\FcmController;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function created(Message $message)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');

        $data = [
            'id' => $message->id,
            'text_msg' => $message->text_msg,
            'img_msg' => $message->img_msg,
            'file_msg' => $message->file_msg,
            'file_3d_msg' => $message->file_3d_msg,
            'user_id_sender' => $message->user_id_sender,
            'user_id_recepient' => $message->user_id_recepient,
            'chat_id' => $message->chat_id,
        ];

        //dd(json_encode($data));

        if(!is_null($message->text_msg)){
            $myRequest->request->add(['user_id' => $message->user_id_recepient,'title' => 'Send message by '.$message->sender->login,'body' => $message->text_msg,'data_field' => json_encode($data) ]);
        } elseif(!is_null($message->img_msg)) {
            $myRequest->request->add(['user_id' => $message->user_id_recepient,'title' => 'Send message by '.$message->sender->login,'body' => 'Send image message','data_field' => json_encode($data),]);
        } elseif(!is_null($message->file_msg)) {
            $myRequest->request->add(['user_id' => $message->user_id_recepient,'title' => 'Send message by '.$message->sender->login,'body' => 'Send file message','data_field' => json_encode($data),]);
        } elseif(!is_null($message->file_3d_msg)) {
            $myRequest->request->add(['user_id' => $message->user_id_recepient,'title' => 'Send message by '.$message->sender->login,'body' => 'Send file 3d message','data_field' => json_encode($data),]);
        }
        app(FcmController::class)->sendPushNotification($myRequest);
    }

    /**
     * Handle the Message "updated" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function updated(Message $message)
    {
        //
    }

    /**
     * Handle the Message "deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function deleted(Message $message)
    {
        //
    }

    /**
     * Handle the Message "restored" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function restored(Message $message)
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     *
     * @param  \App\Models\Message  $message
     * @return void
     */
    public function forceDeleted(Message $message)
    {
        //
    }
}
