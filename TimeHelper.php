<?php

use CUW\App\Modules\Conditions\Base;

defined('ABSPATH') || exit;
class TimeHelper extends Base
{

    public function template($data = [], $print = false){
        ob_start();
        extract($data); // Extract the data array into individual variables
        include 'View.php';
        $view = ob_get_clean();
        if ($print) {
            echo $view; // Print the view if $print is true
        }
        return $view;
    }

    public function check($condition, $data)
    {

        $method = $condition['method'];
//        $currentTime = current_datetime()->format('H:i'); // Get the current time in the 'H:i' ;
        $currentTime = '22:00';
        $to = isset($condition['values']) && !empty($condition['values']['to']) ? $condition['values']['to'] : '00:00';
        $from = isset($condition['values']) && !empty($condition['values']['from']) ? $condition['values']['from'] : '00:00';

        //Converting the Time to Seconds
        $current_time = self::convertToSecond($currentTime);
        $from_time = self::convertToSecond($from);
        $to_time = self::convertToSecond($to);

        // Checking the Conditions
        if ($from_time == $to_time) {
            return false;
        }

        if ($from_time > $to_time) {
            $fromcheck = 84600 - $from_time;
            if (($current_time >= $from_time || $current_time <= $fromcheck) ||
                ($to_time >= $current_time || $current_time <= $to_time)
            ) {
                return ($method == 'in');
            } else {
                return ($method != 'in');
            }
        } else {
            return ($current_time >= $from_time && $current_time <= $to_time) == ($method == 'in');
        }
    }

    static function convertToSecond($time)
    {
        list($hours, $minutes) = explode(':', $time);
        return ($hours * 3600) + ($minutes * 60);
    }
}