<?php

namespace App\Services;

class HelperService
{
    public static function dateToString(array $date)
    {
        return is_array($date) ? $date['year'] . '-' . $date['month'] . '-' . $date['day'] : null;
    }

    public static function dateToArray(string $date)
    {
        if(empty($date)){
            return null;
        }

        $x = explode('-', $date);
        $obj = array(
            'year' => is_integer($x[0]),
            'month' => is_integer($x[1]),
            'day' => is_integer($x[2]),
        );

        return $obj;
    }

}
