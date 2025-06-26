<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskStatusUpdatedNotification extends Notification
{
    use Queueable;

    public $taskId;
    public $taskName;
    public $taskStatus;

    public function __construct($taskId, $taskName, $taskStatus)
    {
        $this->taskId = $taskId;
        $this->taskName = $taskName;
        $this->taskStatus = $taskStatus;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'task_id' => $this->taskId,
            'task_name' => $this->taskName,
            'status' => $this->taskStatus,
            'message' => 'Your task has been ' . $this->taskStatus . '.'
        ];
    }
}
