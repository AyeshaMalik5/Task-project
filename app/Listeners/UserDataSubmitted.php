<?php

namespace App\Listeners;

use App\Events\testemail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserDataSubmitted
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(testemail $event): void
    {
               echo $event->email.",,,,,,,,,,this is listnere";

    }
}
