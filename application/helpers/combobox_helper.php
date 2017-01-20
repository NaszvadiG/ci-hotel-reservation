<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('for_combo_box_addroom_HAS')) {

    function for_combo_box_addroom_HAS() {
        return array(
            'breakfast' => 'Break Fast',
            'aircon' => 'Aircon',
            'gym' => 'Gym',
            'tvlcd' => 'TV LCD',
            'wifi' => 'Wifi',
        );
    }

}