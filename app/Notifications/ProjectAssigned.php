<?php

namespace App\Notifications;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectAssigned extends Notification
{
    use Queueable;

    public $project;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'type'=>'Project_assigned',
            'title'=> $this->project->title
        ];
    }
}
