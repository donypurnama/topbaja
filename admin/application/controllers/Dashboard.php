<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if ($this->session->userdata("antglobal_backend") || isset($this->session->userdata("antglobal_backend")["user_logged_in"])===false){
          redirect("Login");
        }
        $this->load->model("standard_model");
    }

    public function index () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "home",
                "menu_url" => "home"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "home",
                "menu_url" => "home"
            ], true),
            "main" => $this->load->view("main/home", null, true)
        ];

        $this->template->page($config);
	}

  public function logout(){
      $this->session->unset_userdata('logged_in');
      //session_destroy();
      redirect("login", "refresh");
  }
}
