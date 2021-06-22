<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                    {{ $tweet->id }}
                </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">{{ $tweet->message }}</div>
    </td>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        {{ $tweet->media }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        {{ $tweet->tweet_at }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        @if ($tweet->sent) Yes @else No @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        @if (! $tweet->sent)
            <a href="{{ route('tweets.edit', $tweet->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> |
            <form action="{{ route('tweets.destroy', $tweet->id) }}" id="form_delete_tweet_{{ $tweet->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" name="submit" value="submit">Delete</button>
            </form>
        @endif
    </td>
</tr>
