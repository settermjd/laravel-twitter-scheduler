<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageTweetSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'media', 'tweet_at'];

    public function fetchScheduledTweets(): Collection
    {
        return $this->newQuery()->get(
            [
                'id', 'message', 'tweet_at', 'media'
            ]
        )->where('sent', 0);
    }

    public function fetchSentTweets(): Collection
    {
        return $this->newQuery()->get(
            [
                'id', 'message', 'tweet_at', 'media'
            ]
        )->where('sent', 1);
    }
}
