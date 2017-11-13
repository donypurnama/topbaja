<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if ($this->session->userdata("antglobal_backend")["user_logged_in"] == false || $this->session->userdata("antglobal_backend")["user_access_level"] == 0 ){
          redirect("Login");
        }

        $this->load->model("standard_model");
    }


    public function index () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "admin"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "Admin",
                "menu_url" => "user"
            ], true),
            "main" => $this->load->view("main/user_view", [
                "data" => $this->standard_model->get("user_id`, `user_name`, `user_fullname`, `user_passcode`, `user_access_level`, `user_status`", [], "users")
            ], true)
        ];

        $this->template->page($config);
	  }

    public function add () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "Admin"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "Admin",
                "menu_url" => "user"
            ], true),
            "main" => $this->load->view("main/user_add", [
            ], true)
        ];

        $this->template->page($config);
    }

    public function edit ($type_url = null) {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "tipe"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "tipe",
                "menu_url" => "type"
            ], true),
            "main" => $this->load->view("main/type_edit", [
                "data" => $this->standard_model->find("type_id, type_name, type_url, type_description, category_id", [
                    "type_url" => $type_url
                ], "types"),
                "categories" => $this->standard_model->get("category_id, category_name", [],"categories", "category_name", "ASC")
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {
        $data = [
            "user_name" => $this->input->post("user_name"),
            "user_fullname" => $this->input->post("user_fullname"),
            "user_passcode" => $this->encryption->encrypt($this->input->post("user_passcode")),
            "user_access_level" =>$this->input->post("user_access_level"),
            "user_status" => $this->input->post("user_status")
        ];
        //$this->json->stringify($data);
        if ($this->standard_model->insert($data, "users") !== false) {
            redirect("user/");
        } else redirect("fail/");

    }

    public function delete ($id = null) {
        $where = [
            "user_id" => $id
        ];
        if ($this->standard_model->delete($where, "users") !== false) {
            redirect("user/");
        } else redirect("fail/");
    }

    public function validate(){
        $validation_rules = array(
             array(
                   'field'   => "user_name",
                   'label'   => 'Username',
                   'rules'   => "max_length[50]|is_unique[users.user_name]|required",
                   'errors'  => array(
                          'required'     => '%s harus diisi.',
                          'is_unique'     => '%s sudah tersedia.',
                          'max_length' => '%s lebih dari 50 karakter.')
                ),
              array(
                    'field'   => "user_fullname",
                    'label'   => 'Nama',
                    'rules'   => "max_length[100]|required",
                    'errors'  => array(
                           'required'     => '%s harus diisi.',
                           'max_length' => '%s lebih dari 100 karakter.')
               ),
               array(
                   'field'   => "user_passcode",
                   'label'   => 'Password',
                   'rules'   => "required",
                   'errors'  => array(
                          'required'     => '%s harus diisi.')
                )
      );
      $this->form_validation->set_rules($validation_rules);
      if($this->form_validation->run() == false){
          $config = [
              "sidebar" => $this->load->view("sidebar/sidebar", [
                  "menu" => "Admin"
              ], true),
              "header" => $this->load->view("header/header", [
                  "menu" => "Admin",
                  "menu_url" => "user"
              ], true),
              "main" => $this->load->view("main/user_add", [
              ], true)
          ];

          $this->template->page($config);
      }else {
          $this->insert();
      }
    }
}
