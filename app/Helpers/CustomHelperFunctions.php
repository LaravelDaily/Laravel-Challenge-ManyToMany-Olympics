<?php

if (! function_exists('ordinalSuffix')){
    // generate ordinal suffix
    function ordinalSuffix($number)
    {

        if (!is_int($number)){
            throw new Exception('ordinalSuffix 1st parameter should be integer');
        }

        switch ($number){
            case 1:
                return "1st";
            case 2:
                return "2nd";
            case 3:
                return "3rd";
            default:
                return $number . "th";
        }
    }
}

