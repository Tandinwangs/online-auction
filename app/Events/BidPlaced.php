<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Item;
use App\Models\Bid;

class BidPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item;
    public $highestBid;

    public function __construct(Item $item, Bid $bid)
    {
        $this->item = $item;
        $this->highestBid = $bid->amount;
    }

    public function broadcastOn()
    {
        return new Channel('bids.'.$this->item->id);
    }

    public function broadcastAs()
    {
        return 'BidPlaced';
    }
}
