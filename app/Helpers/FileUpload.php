<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Storage;

class FileUpload
{

    public static function image($file, $path = 'images/'): string
    {
        $path = $path . date('Ymd');
        try {
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }
            return Storage::disk('public')->putFile($path, $file);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public static function video($file, $path = 'videos/'): string
    {
        $path = $path . date('Ymd');
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }
        return Storage::disk('public')->putFile($path, $file);
    }

    public static function delete($path)
    {
        return Storage::disk('public')->delete($path);
    }

}
