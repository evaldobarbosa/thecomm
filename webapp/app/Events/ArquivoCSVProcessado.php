<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArquivoCSVProcessado implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public $arquivoCSV, public $userId)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // \Log::info('usuario' . auth()->id());

        // return new PrivateChannel('csv.' . $this->userId);
        // return new Channel('csv');
        return new PresenceChannel('csv');
    }

    // public function broadcastAs()
    // {
    //     return 'csv-processado';
    // }

    // public function broadcastWith()
    // {
    //     return [ 'arquivo' => $this->arquivoCSV ];
    // }
}
