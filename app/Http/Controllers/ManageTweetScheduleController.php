<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditScheduleTweetRequest;
use App\Http\Requests\ScheduleTweetRequest;
use App\Models\ManageTweetSchedule;
use Illuminate\Contracts\View\View;

class ManageTweetScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view(
            'tweetschedule.list',
            [
                'scheduled_tweets' => ManageTweetSchedule::where('sent', false)
                    ->orderByDesc('tweet_at')
                    ->get(),
                'sent_tweets' => ManageTweetSchedule::where('sent', true)
                    ->orderByDesc('tweet_at')
                    ->get(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tweetschedule.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleTweetRequest $request)
    {
        $scheduledTweet = new ManageTweetSchedule;

        $scheduledTweet->tweet_at = $request->tweet_at;
        $scheduledTweet->message = $request->message;
        $scheduledTweet->media = $request->media;
        $scheduledTweet->save();

        return redirect()->route('tweets.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageTweetSchedule  $manageTweetSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view(
            'tweetschedule.edit',
            [
                'tweet' => ManageTweetSchedule::findOrFail($id)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageTweetSchedule  $manageTweetSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(EditScheduleTweetRequest $request, $id)
    {
        $scheduledTweet = ManageTweetSchedule::findOrFail($id);

        $scheduledTweet->tweet_at = $request->tweet_at;
        $scheduledTweet->message = $request->message;
        $scheduledTweet->media = $request->media;
        $scheduledTweet->save();

        return redirect()->route('tweets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageTweetSchedule  $manageTweetSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ManageTweetSchedule::destroy($id);

        return redirect()->route('tweets.index');
    }
}
