<?php

namespace App\Helper;

use Carbon\Carbon;

class DateHelper
{
    public static function getDayName($date)
    {
        $new_date = Carbon::parse($date)->locale('id');
        return $new_date->dayName;
    }

    public static function getDateString($date)
    {
        $new_date = Carbon::parse($date)->locale('id');

        return $new_date->day . ' ' . $new_date->monthName . ' ' . $new_date->year;
    }

    public static function formatTime($time)
    {
        $new_time = Carbon::parse($time)->locale('id');
        return $new_time->format('H:i');
    }
}
