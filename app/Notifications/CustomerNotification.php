<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;


class CustomerNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected  $customer;
    protected  $coin;

    /**
     * Create a new notification instance.
     */
    public function __construct($customer, $coin)
    {
        $this->customer = $customer;
        $this->coin = $coin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $customer = $this->customer;

        return [
            'message_to_information' => 'You have successfully recharged ' . $this->coin . ' coins',
            'created_at' => now(),
        ];
    }
}
