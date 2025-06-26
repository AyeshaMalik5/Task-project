<?php

namespace App\Listeners;

use App\Events\AcceptOrrejectOder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailtoEmployee
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
    public function handle(AcceptOrrejectOder $event): void
{
  
        $task = $event->task;
        $user = $task->user;

        if (!$user) {
            \Log::error('User not found for task ID: ' . $task->id);
            return;
        }

        // Create plain message
        $status = ucfirst($task->status); // like "Accepted" or "Rejected"
        $messageBody = "Hello {$user->name},\n\nYour parcel with Task Code {$task->code} has been {$status}.\n\nThank you.";

        // Send plain text email
        Mail::raw($messageBody, function ($message) use ($user, $status) {
        $message->to('ayeshamalik40001@gmail.com');
            $message->subject("Task Status: {$status}");
        });
    }
}


