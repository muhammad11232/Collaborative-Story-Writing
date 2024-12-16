<?php
namespace App\Jobs;

use App\Models\Chapter;
use App\Models\User;
use App\Notifications\ChapterAddedNotification;
use App\Notifications\ChapterUpdatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;  // Import Log facade

class SendStoryNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $chapter;
    protected $action;

    public function __construct(User $user, Chapter $chapter, $action)
    {
        $this->user = $user;
        $this->chapter = $chapter;
        $this->action = $action;  // 'added' or 'updated'
    }

    public function handle()
    {
        
        if ($this->action == 'added') {
            // Notify the creator that a chapter was added
            $this->user->notify(new ChapterAddedNotification($this->chapter));
        }

        if ($this->action == 'updated') {
            // Notify the contributor that their chapter was updated
            $this->user->notify(new ChapterUpdatedNotification($this->chapter));
        }

    }
}
