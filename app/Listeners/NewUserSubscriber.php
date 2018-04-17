<?php

namespace App\Listeners;

use App\Notifications\AlertFired;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class NewUserSubscriber implements ShouldQueue
{
    /**
     * @param $event
     */
    public function activationFor($event)
    {
        Log::info('activation', ['user' => $event->user]);
        Notification::route('mail', 'mark.cross@scientificgames.com')
            ->notify(new AlertFired($event));

    }

    /**
     * @param $event
     */
    public function roleAssign($event)
    {
        Log::info('role', ['user' => $event->user]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\UserRegistered',
            'App\Listeners\NewUserSubscriber@activationFor'
        );

        $events->listen(
            'App\Events\UserRegistered',
            'App\Listeners\NewUserSubscriber@roleAssign'
        );
    }
}
