<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('convert_date_')) {

        /**
         * 
         * @param string $date | 01/28/2015
         * @return string formated date | 28 Jan, 2015
         */
        function convert_date_($date) {
                $CI = get_instance();
                $CI->load->library('Calendar');
                $CI->calendar->month_type = 'short';

                list($m_, $d_, $y_) = explode('/', $date);

                return $d_ . ' ' . $CI->calendar->get_month_name($m_) . ', ' . $y_;
        }

}
if (!function_exists('different_days_')) {

        /**
         * 
         * @param string $date_start | 01/28/2015
         * @param string $date_end | 01/28/2015
         * @return int different day(s)
         */
        function different_days_($date_start, $date_end) {
                $CI = get_instance();
                $CI->load->library('Calendar');

                list($m_1, $d_1, $y_1) = explode('/', $date_start);
                list($m_2, $d_2, $y_2) = explode('/', $date_end);


                if ($m_1 === $m_2 && $y_1 === $y_2) {

                        return (int) $d_2 - $d_1;
                } else if ($m_1 < $m_2 && $y_1 === $y_2) {

                        $days_in_betweens = 0;
                        $days_in_month_1 = $CI->calendar->get_total_days($m_1, $y_1);

                        for ($i = ($m_1 + 1); $i < $m_2; $i++) {
                                $days_in_betweens += $CI->calendar->get_total_days($i, $y_1);
                        }

                        $start = $days_in_month_1 - $d_1;
                        return (int) $start + $d_2 + $days_in_betweens;
                }
        }

}