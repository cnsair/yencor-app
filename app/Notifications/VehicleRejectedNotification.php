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
            ->subject('[Action Required] Vehicle Approval Rejected - ' . $this->vehicle->make . ' ' . $this->vehicle->model)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We regret to inform you that your vehicle submission has been rejected.')
            ->line('Vehicle Details:')
            ->line('- Make: ' . $this->vehicle->make)
            ->line('- Model: ' . $this->vehicle->model)
            ->line('- VIN: ' . $this->vehicle->vin)
            ->line('')
            ->line('Rejection Reason:')
            ->line($this->reason)
            ->action('View Vehicle Details', route('vehicles.show', $this->vehicle))
            ->line('Please correct the issues and resubmit your vehicle for approval.')
            ->line('If you have any questions, please contact our support team.')
            ->salutation('Regards, ' . config('app.name'));
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