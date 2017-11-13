<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public $settings;

    function __construct () {
        parent::__construct();
        if (($this->session->userdata("antglobal")) || isset($this->session->userdata("antglobal")["customer_logged_in"])) redirect("home");
        $this->load->model("standard_model");
        //get header categories & types
        $categories = $this->standard_model->get("category_id, category_name, category_url, category_image", [], "categories");
        foreach ($categories as $key=>&$value) {
          $value["types"] = $this->standard_model->get("type_id, type_name, type_url", [
            "category_id" => $value["category_id"]
          ], "types");
        }

        $this->settings["header"] = $this->load->view("header/header", [
          "header_categories" => $categories,
          "active" => ""
        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);
    }

    public function index () {
      $data = [
        "customer_email_address" => "",
        "customer_passcode" => ""
      ];

      $this->settings["title"] = "Log In " .  " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/login", [
        "data" => $data
      ], true);
      $this->template->page($this->settings);
    }

    public function validate_login () {
      $email = $this->input->post("customer_email_address", true);
      $passcode = $this->input->post("customer_passcode", true);

      $this->form_validation->set_rules("customer_email_address", "Email", "trim|required|valid_email");
      $this->form_validation->set_rules("customer_passcode", "Password", "required");
      $this->form_validation->set_message('required', '%s harus diisi');

      if ($this->form_validation->run() != FALSE) {
        $cust = $this->standard_model->find("customer_id, customer_email_address, customer_first_name, customer_last_name, customer_passcode", [
          "customer_email_address" => $email,
          "customer_status" => 1
        ], "customers");
        //if email exists
        if ($cust) {
          //if password match
          if ($this->encryption->decrypt($cust["customer_passcode"]) === $passcode) {
            $sess_array = [
              "customer_id" => $cust["customer_id"],
              "customer_email_address" => $cust["customer_email_address"],
              "customer_first_name" => $cust["customer_first_name"],
              "customer_last_name" => $cust["customer_last_name"],
              "customer_logged_in" => true
            ];
            $this->session->set_userdata('antglobal', $sess_array);
            redirect("home");
          } else {
            $this->session->set_flashdata('front_login_err', 'Maaf, password yang Anda masukkan salah.');
            redirect("login");
          }
        } else {
          $this->session->set_flashdata('front_login_err', 'Maaf, email yang Anda masukkan tidak terdaftar.');
          redirect("login");
        }
      }
    }
}
//FRD 300 : fiori_anj - password123
