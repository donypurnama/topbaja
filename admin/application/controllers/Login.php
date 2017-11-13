<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public $config = [];

    function __construct () {
      parent::__construct();

      if (($this->session->userdata("antglobal_backend")) || isset($this->session->userdata("antglobal_backend")["user_logged_in"])) redirect("home");
      $this->load->model("standard_model");


      $this->settings["header"] = $this->load->view("header/header", [
        "menu"=>" Login",
        "menu_url"=>""
      ], true);
      $this->settings["sidebar"] = $this->load->view("sidebar/sidebarlogin", [
        "menu"=>"Login",
        "menu_url"=>""
      ], true);
    }

    public function index ($err = null) {
      //$this->session->userdata
      $data = [
        "user_name" => "",
        "user_passcode" => ""
      ];

      $this->settings["title"] = "Log In " .  " - TOP BAJA";
      $this->settings["full"] = $this->load->view("main/login", [
        "data" => $data
      ], true);
      $this->template->page($this->settings);
	  }

    public function validate_login () {
      $username = $this->input->post("user_name", true);
      $passcode = $this->input->post("user_passcode", true);

      $this->form_validation->set_rules("user_name", "User Name", "trim|required");
      $this->form_validation->set_rules("user_passcode", "Password", "required");
      $this->form_validation->set_message('required', '%s harus diisi');

      if ($this->form_validation->run() != FALSE) {
        $user = $this->standard_model->find("user_id`, `user_name`, `user_fullname`, `user_passcode`, `user_access_level`, `user_status`", [
          "user_name" => $username,
          "user_status" => 1
        ], "users");

        //if email exists
        if ($user) {
          //if password match
          if ($this->encryption->decrypt($user["user_passcode"]) === $passcode) {
            $sess_array = [
              "user_id" => $user["user_id"],
              "user_name" => $user["user_name"],
              "user_fullname" => $user["user_fullname"],
              "user_access_level" => $user["user_access_level"],
              "user_logged_in" => true
            ];
            $this->session->set_userdata('antglobal_backend', $sess_array);
            redirect("home");
          } else {
            $this->session->set_flashdata('back_login_err', 'Maaf, password yang Anda masukkan salah.');
            redirect("login");
          }
        } else {
          $this->session->set_flashdata('back_login_err', 'Maaf, email yang Anda masukkan tidak terdaftar.');
          redirect("login");
        }
      }
    }


}
