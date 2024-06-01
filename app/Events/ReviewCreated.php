<?php

namespace App\Events;

use App\Models\Review;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReviewCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function handle()
    {
        $totalRating = Review::where('travel_id', $this->review->travel_id)->avg('rating');

        // Update total_rating in RestoList
        $restoList = \App\Models\RestoList::find($this->review->travel_id);
        $restoList->total_rating = $totalRating;
        $restoList->save();
    }
}
