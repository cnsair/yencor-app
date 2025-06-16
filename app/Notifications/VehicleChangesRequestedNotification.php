<?php

namespace App\Notifications;

use App\Models\Vehicle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VehicleChangesRequestedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance
     */
    public function __construct(
        public Vehicle $vehicle,
        public string $changesRequested
    ) {}

    /**
     * Get the notification's delivery channels
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Vehicle Verification Changes Requested')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your vehicle ('.$this->vehicle->make.' '.$this->vehicle->model.') verification requires changes:')
            ->line('**Changes requested:**')
            ->line($this->changesRequested)
            ->action('Update Vehicle Details', route('driver.vehicles.show', $this->vehicle))
            ->line('Thank you for using our service!');
    }

    /**
     * Get the array representation of the notification
     */
    public function toArray($notifiable): array
    {
        return [
            'message' => 'Vehicle verification changes requested',
            'vehicle_id' => $this->vehicle->id,
            'vehicle_make' => $this->vehicle->make,
            'vehicle_model' => $this->vehicle->model,
            'changes' => $this->changesRequested,
            'action_url' => route('driver.vehicles.show', $this->vehicle)
        ];
    }
}