<?php

namespace App\Providers;

use App\Models\Chat;
use App\Models\Device;
use App\Models\Message;
use App\Models\News_item;
use App\Models\Order;
use App\Observers\ChatObserver;
use App\Observers\DeviceObserver;
use App\Observers\MessageObserver;
use App\Observers\NewsItemObserver;
use App\Observers\OrderObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Device::observe(DeviceObserver::class);
        Message::observe(MessageObserver::class);
        Chat::observe(ChatObserver::class);
        Order::observe(OrderObserver::class);
        News_item::observe(NewsItemObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
