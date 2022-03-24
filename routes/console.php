<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('sendpush:user {id} {title} {body}', function ($id, $title, $body){
    $myRequest = new \Illuminate\Http\Request();
    $myRequest->setMethod('POST');
    $myRequest->request->add(
     ['user_id' => $id,
     'title' => $title,
     'body' => $body,]);
    app(FcmController::class)->sendPushNotification($myRequest);
});
