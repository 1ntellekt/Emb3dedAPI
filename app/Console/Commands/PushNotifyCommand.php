<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\FcmController;

class PushNotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:notifyAll {title} {body}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send push notification all users with title and body';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $myRequest = new \Illuminate\Http\Request();
        $myRequest->setMethod('POST');
        $myRequest->request->add(['title'=> $this->argument('title'),'body' => $this->argument('body')]);
        app(FcmController::class)->sendPushNotificationAllDevices($myRequest);
    }
}
