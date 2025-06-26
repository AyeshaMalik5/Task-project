<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\sendMailevent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailtoAdmin
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
 public function handle(sendMailevent $event): void
{
    $task = $event->task;

    // Check if the task exists
    if (!$task) {
        \Log::error('Task not found in sendMailevent');
        return;
    }

    // Check if the task has a related user
    $user = $task->user;
    if (!$user) {
        \Log::error('User not found for task ID: ' . $task->id);
        return;
    }

    // Send mail
    Mail::send('sendMailEvent', ['user' => $user, 'task' => $task], function ($message) use ($user) {
        $message->to('ayeshamalik40001@gmail.com'); // or use a fixed email for testing
        $message->subject('New Task Submitted by ' . $user->name);
    });
}

}

