<?php

namespace App\Listeners;

use App\Events\CreatedExpenseEvent;
use App\Notifications\DespesaCadastradaNotification;

class SendExpenseNotificationListener
{
    public function __construct()
    {
    }

    public function handle(CreatedExpenseEvent $event): void
    {
        $user = $event->expense->usuario()->first();
        $user?->notify(new DespesaCadastradaNotification($event->expense));
    }
}
