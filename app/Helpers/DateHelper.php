<?php


namespace App\Helpers;
use Carbon\Carbon;


class DateHelper {


    public static function date($data) {

        $myDate = Carbon::parse($data);

        return $myDate->isWeekend();

    }
}