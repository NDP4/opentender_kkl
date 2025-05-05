<?php

namespace App\Notifications;

use App\Models\Announcement;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AnnouncementNotification extends Notification
{
    protected $announcement;

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pengumuman Tahap Presentasi - Open Tender KKL D3 TI UDINUS')
            ->view('emails.announcement', [
                'announcement' => $this->announcement,
                'user' => $notifiable
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->announcement->title,
            'content' => $this->announcement->content,
            'date' => $this->announcement->announcement_date,
        ];
    }
}
