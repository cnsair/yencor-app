<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DriverStatusUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $newStatus;

    public function __construct($newStatus)
    {
        $this->newStatus = $newStatus;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $statusLabels = [
            4 => 'Active',
            3 => 'Inactive',
            2 => 'Suspended',
        ];
    
        return (new MailMessage)
                    ->subject('Your Driver Status Has Been Updated')
                    ->line('Your status has been updated to: ' . $statusLabels[$this->newStatus])
                    ->action('View Your Dashboard', url('/driver/dashboard'))
                    ->line('Thank you for being a valued driver!');
    }
}
