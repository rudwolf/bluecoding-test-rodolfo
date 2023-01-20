<?php

namespace App\Http\Controllers;

use App\Models\ShortenUrl;
use Illuminate\Http\Request;
use App\Services\ShortenUrlService;

class ShortenUrlController extends Controller
{
    public function shorten(Request $request)
    {
        $headers = @get_headers($request->url);
        // Use condition to check the existence of URL
        if (false == $headers || strpos($headers[0], '404')) {
            return response()->json(['error' => 'Invalid URL'], 400);
        }

        // Check if the url was already shortened
        $shortenedUrl = ShortenUrl::where('source_url', $request->url)->get();
        if (!$shortenedUrl->isEmpty()) {
            return response()->json(['data' => $shortenedUrl]);
        }

        // URL exists, let's keep going
        $shortenedUrl = new ShortenUrl();
        $shortenUrlService = new ShortenUrlService;
        $encoded_url_code = $shortenUrlService->Encode($request->url);
        $page_title = $shortenUrlService->getPageTitle($request->url);
        $encoded_url = 'http://blue.test/short/'.$encoded_url_code;
        $shortenedUrl->source_url = $request->url;
        $shortenedUrl->shortened_url = $encoded_url;
        $shortenedUrl->page_title = $page_title;
        $shortenedUrl->save();
        return response()->json(['data' => $shortenedUrl]);
    }

    public function redirect(Request $request)
    {
        $urlCode = $request->route('code');
        $shortenedUrl = ShortenUrl::where('shortened_url', 'http://blue.test/short/'.$urlCode)->first();
        if (!$shortenedUrl) {
            return response()->json(['error' => 'Short url not found'], 404);
        }
        $shortenedUrl->visit_count++;
        $shortenedUrl->save();

        return redirect($shortenedUrl->source_url);
    }
}
