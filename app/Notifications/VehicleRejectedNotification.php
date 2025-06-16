<?php

namespace App\Notifications;

use App\Models\Vehicle;
use App\Enums\VerificationStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class VehicleRejectedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The vehicle instance
     */
    public Vehicle $vehicle;

    /**
     * The rejection reason
     */
    public string $reason;

    /**
     * Create a new notification instance
     */
    public function __construct(Vehicle $vehicle, string $reason)
    {
        $this->vehicle = $vehicle;
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('❌ Vehicle Documents Rejected: ' . $this->vehicle->make . ' ' . $this->vehicle->model)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We regret to inform you that your vehicle documents have been rejected.')
            ->line('Reason: ' . $this->reason)
            ->line('Please review the following documents and resubmit:')
            ->line('- Vehicle Photo: ' . ($this->vehicle->vehicle_photo ? 'Submitted' : 'Missing'))
            ->line('- Insurance Document: ' . ($this->vehicle->insurance_document ? 'Submitted' : 'Missing'))
            ->line('- Registration Document: ' . ($this->vehicle->registration_document ? 'Submitted' : 'Missing'))
            ->action('Resubmit Documents', route('driver.register-vehicle'))
            ->line('If you need assistance, please contact our support team.');
    }

    /**
     * Get the array representation for database storage
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'vehicle.rejected',
            'message' => 'Your vehicle submission has been rejected',
            'vehicle_id' => $this->vehicle->id,
            'make' => $this->vehicle->make,
            'model' => $this->vehicle->model,
            'reason' => $this->reason,
            'url' => route('vehicles.show', $this->vehicle),
            'time' => now()->toDateTimeString(),
        ];
    }

    /**
     * Get the broadcastable representation of the notification
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'type' => 'vehicle.rejected',
            'message' => 'Your vehicle submission has been rejected',
            'vehicle_id' => $this->vehicle->id,
            'url' => route('vehicles.show', $this->vehicle),
        ]);
    }

    /**
     * Determine which queues should be used for each notification channel
     */
    public function viaQueues(): array
    {
        return [
            'mail' => 'mail-queue',
            'database' => 'database-queue',
            'broadcast' => 'broadcast-queue',
        ];
    }
}