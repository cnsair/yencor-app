<?php

namespace App\Notifications;

use App\Models\Vehicle;
use App\Enums\VerificationStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class VehicleApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The approved vehicle instance
     */
    public Vehicle $vehicle;

    /**
     * Create a new notification instance
     */
    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
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
            ->subject('✅ Vehicle Approved: ' . $this->vehicle->make . ' ' . $this->vehicle->model)
            ->greeting('Congratulations ' . $notifiable->name . '!')
            ->line('Your vehicle has been successfully approved and is now active in our system.')
            ->line('Vehicle Details:')
            ->line('- Make: ' . $this->vehicle->make)
            ->line('- Model: ' . $this->vehicle->model)
            ->line('- Year: ' . $this->vehicle->year_of_manufacture)
            ->line('- License Plate: ' . $this->vehicle->license_date)
            ->line('')
            ->action('View Your Vehicle', route('vehicles.show', $this->vehicle))
            ->line('You can now use this vehicle for all platform services.')
            ->line('If you have any questions, please contact our support team.')
            ->salutation('Best Regards, ' . config('app.name'));
    }

    /**
     * Get the array representation for database storage
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'vehicle.approved',
            'message' => 'Your vehicle has been approved',
            'vehicle_id' => $this->vehicle->id,
            'make' => $this->vehicle->make,
            'model' => $this->vehicle->model,
            'year' => $this->vehicle->year_of_manufacture,
            'license_plate' => $this->vehicle->license_date,
            'url' => route('vehicles.show', $this->vehicle),
            'approved_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Get the broadcastable representation of the notification
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'type' => 'vehicle.approved',
            'message' => 'Your vehicle has been approved',
            'vehicle_id' => $this->vehicle->id,
            'url' => route('vehicles.show', $this->vehicle),
            'make' => $this->vehicle->make,
            'model' => $this->vehicle->model,
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

    /**
     * Get the notification's unique identifier
     */
    public function id(): string
    {
        return 'vehicle-approval-' . $this->vehicle->id . '-' . now()->timestamp;
    }
}