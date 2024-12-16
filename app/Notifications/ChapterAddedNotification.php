<?php

namespace App\Notifications;

use App\Models\Chapter;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ChapterAddedNotification extends Notification
{
    protected $chapter;

    public function __construct(Chapter $chapter)
    {
        $this->chapter = $chapter;
    }

    public function via($notifiable)
    {
        return ['mail'];  // You can also use 'database' or other channels as required
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new chapter has been added to your story: ' . $this->chapter->story->title)
                    ->action('View Chapter', url('/stories/'.$this->chapter->story->id))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new chapter has been added to your story: ' . $this->chapter->story->title,
            'chapter_id' => $this->chapter->id
        ];
    }
}
