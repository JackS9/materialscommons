<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use function config;

class BokehApiService
{
    public static function openBokehApp($appName)
    {
        $url = config('bokeh.url')."{$appName}";
        ray("url = {$url}");
        $response = Http::get($url);
        if ($response->failed()) {
            ray("  failed");
            return null;
        }

        return $response->body();
    }

    public static function bokehAppUrl($appName)
    {
        return config('bokeh.url').$appName;
    }
}