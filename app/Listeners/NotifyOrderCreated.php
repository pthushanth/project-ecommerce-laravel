<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyOrderCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $admins = User::getAdmins();
        foreach ($admins as $admin) {
            // Mail::to($admin)->send('emails.post.created', $event->post);
            $admin->notify(new NewOrderNotification($event->order));
        }

        $client = User::getClient();
        $client->notify(new NewOrderNotification($event->order));
    }
}
