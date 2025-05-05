<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Proposal;

class ProposalReviewed extends Notification
{
    protected $proposal;
    protected $status;
    protected $notes;

    public function __construct(Proposal $proposal, string $status, string $notes)
    {
        $this->proposal = $proposal;
        $this->status = $status;
        $this->notes = $notes;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Update Status Proposal - Open Tender KKL D3 TI UDINUS')
            ->view('emails.proposal-reviewed', [
                'proposal' => $this->proposal,
                'status' => $this->status,
                'notes' => $this->notes,
                'user' => $notifiable
            ]);
    }
}
