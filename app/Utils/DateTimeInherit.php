<?php
namespace App\Utils;

use DateTime;
use DateInterval;

class DateTimeInherit extends DateTime {

    public function returnAdd(DateInterval $interval)
    {
        $dt = clone $this;
        $dt->add($interval);
        return $dt;
    }

    public function returnSub(DateInterval $interval)
    {
        $dt = clone $this;
        $dt->sub($interval);
        return $dt;
    }

    public static function addDateIntervals($intervalOne, $intervalTwo)
    {
        $keys = ["y", "m", "d", "h", "i", "s"];

        $intervalArrayOne = array_intersect_key((array)$intervalOne, array_flip($keys));
        $intervalArrayTwo = array_intersect_key((array)$intervalTwo, array_flip($keys));

        $result = array_map(function($v1, $v2){
            return abs($v1 + $v2);
        }, $intervalArrayOne, $intervalArrayTwo);

        if($result[4] >= 60) {
            $result[3] += floor($result[4] / 60);
            $result[4] = $result[4] % 60;
        }

        return new DateInterval(vsprintf("P%dY%dM%dDT%dH%dM%dS", $result));
    }

    public static function durationToInterval($duration)
    {
        $duration = explode(":",$duration);
        $hour = intval($duration[0]);
        $minute = intval($duration[1]);

        return new DateInterval("PT".$hour."H".$minute."M");
    }

}