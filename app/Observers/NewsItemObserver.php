<?php

namespace App\Observers;

use App\Models\News_item;

class NewsItemObserver
{
    /**
     * Handle the News_item "created" event.
     *
     * @param  \App\Models\News_item  $news_item
     * @return void
     */
    public function created(News_item $news_item)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');

        $data = [
            'action'=>'news',
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
     * Handle the News_item "updated" event.
     *
     * @param  \App\Models\News_item  $news_item
     * @return void
     */
    public function updated(News_item $news_item)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');

        $data = [
            'action'=>'news',
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
     * Handle the News_item "deleted" event.
     *
     * @param  \App\Models\News_item  $news_item
     * @return void
     */
    public function deleted(News_item $news_item)
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');

        $data = [
            'action'=>'news',
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
     * Handle the News_item "restored" event.
     *
     * @param  \App\Models\News_item  $news_item
     * @return void
     */
    public function restored(News_item $news_item)
    {
        //
    }

    /**
     * Handle the News_item "force deleted" event.
     *
     * @param  \App\Models\News_item  $news_item
     * @return void
     */
    public function forceDeleted(News_item $news_item)
    {
        //
    }
}
