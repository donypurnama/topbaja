<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fail extends CI_Controller {

    public $config = [];

    function __construct () {
      parent::__construct();
      
    }

    public function index () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "error"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "Error",
                "menu_url" => "error"
            ], true),
            "main" => $this->load->view("errors/html/custom_error", null, true)
        ];

        $this->template->page($config);
	}
}
