<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangeCoin implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customer;

    /**
     * Create a new event instance.
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get the channels the event should broadcast on.
     * Nhận các kênh sự kiện sẽ phát sóng
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('customer.'.$this->customer->id);
    }

    /**
     * Data to broadcast with the event.
     * Dữ liệu để phát sóng với sự kiện
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->customer->id,
            'coin' => $this->customer->coin,
        ];
    }
}
