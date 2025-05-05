<?php

namespace App\Notifications;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WinnerAnnouncementNotification extends Notification
{
    use Queueable;

    protected $announcement;

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Selamat! Anda Terpilih Sebagai Pemenang Tender KKL')
            ->view('emails.winner-announcement', [
                'user' => $notifiable,
                'announcement' => $this->announcement
            ]);
    }
}
