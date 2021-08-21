<?php

if (!function_exists('get_places')) {
    function get_places()
    {
        return [
            [
                'type' => 'gold',
                'position' => '1st'
            ],
            [
                'type' => 'silver',
                'position' => '2nd'
            ],
            [
                'type' => 'bronze',
                'position' => '3rd'
            ],
        ];
    }
}
