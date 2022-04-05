<?php

namespace App\Observers;

use App\Models\Order;
use App\Http\Controllers\FcmController;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');

        $data = [
            'action'=>'order',
            // 'id' => $order->id,
            // 'title' => $order->title,
            // 'description' => $order->description,
            // 'user_id' => $order->user_id,
            // 'img_url' => $order->img_url,
            // 'status' => $order->status,
            // 'created_at' => $order->created_at,
            // 'user' => $order->user,
        ];

        $myRequest->request->add(['title' => 'action','body' => 'created','data_field' => json_encode($data),]);

        app(FcmController::class)->sendPushNotificationDevices($myRequest);

    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');

        $data = [
            'action'=>'order',
            // 'id' => $order->id,
            // 'title' => $order->title,
            // 'description' => $order->description,
            // 'user_id' => $order->user_id,
            // 'img_url' => $order->img_url,
            // 'status' => $order->status,
            // 'created_at' => $order->created_at,
            // 'user' => $order->user,
        ];

        $myRequest->request->add(['title' => 'action','body' => 'updated','data_field' => json_encode($data),]);

        app(FcmController::class)->sendPushNotificationDevices($myRequest);
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');

        $data = [
            'action'=>'order',
            // 'id' => $order->id,
            // 'title' => $order->title,
            // 'description' => $order->description,
            // 'user_id' => $order->user_id,
            // 'img_url' => $order->img_url,
            // 'status' => $order->status,
            // 'created_at' => $order->created_at,
            // 'user' => $order->user,
        ];

        $myRequest->request->add(['title' => 'action','body' => 'deleted','data_field' => json_encode($data),]);

        app(FcmController::class)->sendPushNotificationDevices($myRequest);
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
