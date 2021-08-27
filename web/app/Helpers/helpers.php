<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('images')) {
    /**
     * Get url to view image
     *
     * @param  string|null  $path
     * @param  \Illuminate\Support\Facades\Storage
     * @return string
     */
    function images($path = null)
    {
        if($path) return Storage::url($path);
    }
}
