<?php

namespace App\Events;

use App\Models\Customer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class SendNotifyRechargeCard implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notifications;
    public Customer $customer;
    public int $totalNotifications;

    /**
     * Create a new event instance.
     */
    public function __construct($customer)
    {
        $notifications = $customer->unreadNotifications()->latest()->first();
        $this->notifications = $notifications;
        $this->customer = $customer;
        $this->totalNotifications = $customer->unreadNotifications->count();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('Send-Notify-Recharge-Card.'.$this->customer->id);
    }
}
