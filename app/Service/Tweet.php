<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\ManageTweetSchedule;
use Atymic\Twitter\ApiV1\Service\Twitter;
use Atymic\Twitter\Exception\Request\UnauthorizedRequestException;

class Tweet
{
    /**
     * Send the tweets that should be sent now
     *
     * Steps:
     *
     * - Find all the tweets that are to be sent
     * - Send them.
     *
     * @param  Twitter  $twitter
     */
    public function send(Twitter $twitter, $tweets)
    {
        foreach ($tweets as $tweet) {
            try {
                $twitter->postTweet(
                    [
                        'status' => $tweet->message,
                        'response_format' => 'json'
                    ]
                );
            } catch (\BadMethodCallException|UnauthorizedRequestException $e) {
                var_dump($e->getMessage());
            }
        }
    }
}
