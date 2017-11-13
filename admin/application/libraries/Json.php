<?php
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/*
Class JSON for CodeIgniter custom library.
@author Effene Herry <effene.hrr@gmail.com>
*/
class JSON {
    private $instance;

    /*
    Save a copy instance of CodeIgniter in library class.
    */
    function __construct() {
        $this->instance =& get_instance();
    }

    /*
    Set the application header content type as application/json and show it as JSON file.
    @param array
    */
    public function stringify($param = []) {
        if (!is_array($param)) {
            $param = [];
        }

        $this->instance->output->set_content_type("application/json")->set_output(json_encode($param, JSON_PRETTY_PRINT))->_display();
        exit;
    }

    /*
    Parse the JSON string format.
    @param string|null
    @return array|boolean
    */
    public function parse($param = null) {
        if (!is_string($param)) {
            return false;
        }

        $result = json_decode($param, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $result;
        }

        return false;
    }
}
?>
