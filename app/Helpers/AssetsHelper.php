<?php

namespace App\Helpers;

class AssetsHelper

{

    public static function fixPath($path): string
    {
        $pathFix = trim($path);
        return substr($pathFix, 0, 1) === '/' ? substr($pathFix, 1) : $pathFix;
    }

    public static function assetAdmin($path): string
    {
        $path = self::fixPath($path);
        return asset('assets/admin/' . $path);
    }

    public static function assetKiaalap($path): string
    {
        $path = self::fixPath($path);
        return asset('assets/admin/kiaalap/' . $path);
    }

}
