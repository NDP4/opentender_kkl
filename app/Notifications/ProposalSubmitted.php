<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Proposal;

class ProposalSubmitted extends Notification
{
    use Queueable;

    protected $proposal;

    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Proposal Penawaran Berhasil Disubmit - Open Tender KKL D3 TI UDINUS')
            ->view('emails.proposal-submitted', [
                'proposal' => $this->proposal,
                'user' => $notifiable
            ]);
    }
}
