<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessCrawlUrl;

class CustomCrawlerController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Crawl the website content.
     *
     * @return true
     */
    public function fetchContent(Request $request)
    {
        $url = isset($request->url) ? $request->url : '';
        dispatch(new ProcessCrawlUrl($url));

        return response()->json(['status' => 'ok', 'url_requested' => $url]);
    }
}
