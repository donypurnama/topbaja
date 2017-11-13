<?php
/*
Array Helper extending native CodeIgniter Array Helper.
@author Effene Herry <effene.hrr@gmail.com>
*/
if (!function_exists("filter_element")) {
    /*
    Filter an element of array via callback function.
    
    @param array $param Array parameter
    @param string $key Array key to search
    @param string|object $callback String native PHP function or lambda function.
    @return mixed|false
    */
    function filter_element($param, $key, $callback) {
        if (!is_array($param) || !(is_int($key) || is_string($key))) {
            return false;
        }

        if (isset($param[$key]) && is_callable($callback)) {
            if (call_user_func($callback, $param[$key])) {
                return $param[$key];
            }
        }

        return false;
    }
}
?>
