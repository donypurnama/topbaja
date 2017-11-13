<?php
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/*
Class Utility for CodeIgniter page template and pagination custom library.
@author Effene Herry <effene.hrr@gmail.com>
*/

class Template {
    private $instance;

    /*
    Save a copy instance of CodeIgniter in library class and load required helper & libraries.
    */
    function __construct() {
        $this->instance =& get_instance();
        $this->instance->load->helper("array");
        $this->instance->load->helper("url");
        $this->instance->load->library("parser");
    }

    /*
    Utility library page template.
    @param array $config Configuration page template
    */
    public function page($config = []) {
        $config = is_array($config) ? $config : [];
        $settings = [
            "application_name" => "Situs Resmi ULP Kota Sorong",
            "author" => "ulp@sorongkota.go.id",
            "description" => "",
            "generator" => "Brackets",
            "keywords" => "",
            "meta_facebook" => null,
            "meta_twitter" => null,
            "google_analytics" => null,
            "title" => "Situs Resmi ULP Kota Sorong",
            "base_url" => base_url(),
            "link" => null,
            "header" => null,
            "slider" => null,
            "announcement" => null,
            "info" => null,
            "aside_left" => null,
            "aside_right" => null,
            "main" => null,
            "footer" => null,
            "script" => null,
            "menu" => null,
            "error" => null
        ];

        $config = array_intersect_key($config, array_flip(array_keys($settings)));
        foreach ($config as $key => $value) {
            $config[$key] = filter_element($config, $key, "is_string") !== false ? $config[$key] : $settings[$key];
        }

        $config = $config + $settings;
        $this->instance->parser->parse("page/page", $config);
    }
}
?>
