<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class SocialMediaController extends Controller
{
    public function socialMediaPage()
    {
        $apiKey = env('YOUTUBE_API_KEY');
        $channelId = env('YOUTUBE_CHANNEL_ID');

        // Fetch Latest 6 YouTube Videos
        $url = "https://www.googleapis.com/youtube/v3/search?key=$apiKey&channelId=$channelId&part=snippet,id&order=date&maxResults=6";

        $response = Http::get($url)->json();

        $videos = [];

        if (isset($response['items'])) {
            foreach ($response['items'] as $item) {
                if (isset($item['id']['videoId'])) {
                    $videos[] = [
                        'videoId' => $item['id']['videoId'],
                        'title' => $item['snippet']['title'],
                        'thumbnail' => $item['snippet']['thumbnails']['high']['url'],
                    ];
                }
            }
        }

        return view('users.socialMedia', compact('videos'));
    }
}
