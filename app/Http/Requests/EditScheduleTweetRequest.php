<?php

namespace App\Http\Requests;

use App\Models\ManageTweetSchedule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditScheduleTweetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $tweet = ManageTweetSchedule::find($this->tweet);

        return [
            'message' => [
                'required',
                Rule::unique(ManageTweetSchedule::class)->ignore($tweet->id),
                'max:255'
            ],
            'tweet_at' => 'required|date|after:now',
            'media' => 'max:255|url',
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'Please enter a tweet message.',
            'message.unique' => 'A tweet with that message has already been scheduled.',
            'message.max' => 'The message length cannot be longer than 255 chars',
            'tweet_at.required' => 'Please enter the time and date to send the tweet.',
            'tweet_at.after' => 'The tweet cannot be sent in the past',
            'media.max' => 'The media URI cannot be longer than 255 chars',
        ];
    }
}
