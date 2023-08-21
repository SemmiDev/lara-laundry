<?php

namespace App\Models;

use Illuminate\Support\Str;

class TrackingCode
{
    public static function Generate() : string
    {
        $uniqueNumber = Str::random(5);
        while (Order::where('code', $uniqueNumber)->exists()) {
            $uniqueNumber = Str::random(5);
        }
        return $uniqueNumber;
    }
}
