<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if ($this->session->userdata("antglobal_backend")["user_logged_in"] == false){
          redirect("Login");
        }

        $this->load->model("standard_model");
    }

    function create_slug($string){
        $replace = '-';
        $string = strtolower($string);

        //replace / and . with white space
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);

        //remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        //convert whitespaces and underscore to $replace
        $string = preg_replace("/[\s_]/", $replace, $string);

        //limit the slug size
        $string = substr($string, 0, 100);

        //slug is generated
        return ($ext) ? $string.$ext : $string;
    }

    public function index () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "tipe"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "tipe",
                "menu_url" => "type"
            ], true),
            "main" => $this->load->view("main/type_view", [
                "data" => $this->standard_model->get_join("type_id,type_name, type_url, type_description,type_created_time, category_name","types","categories","types.category_id = categories.category_id", [], "type_id")
            ], true)
        ];

        $this->template->page($config);
	}

    public function add () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "tipe"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "tipe",
                "menu_url" => "type"
            ], true),
            "main" => $this->load->view("main/type_add", [
              "data" => $this->standard_model->get("category_id, category_name", [],"categories", "category_name", "ASC")
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
            "category_id" => $this->input->post("category_id"),
            "type_name" => $this->input->post("type_name"),
            "type_url" => $this->create_slug($this->input->post("type_name")),
            "type_description" => $this->input->post("type_description")
        ];

        if ($this->standard_model->insert($data, "types") !== false) {
            redirect("type/");
        } else redirect("fail/");

    }

    public function update () {
        $data = [
            "category_id" => $this->input->post("category_id"),
            "type_name" => $this->input->post("type_name"),
            "type_url" => $this->create_slug($this->input->post("type_name")),
            "type_description" => $this->input->post("type_description"),
            "type_last_changed_time" => date("Y-m-d H:i:s")
        ];

        $where = [
            "type_id" => $this->input->post("type_id")
        ];


        if ($this->standard_model->update($data, "types",$where) !== false) {
            redirect("type/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $where = [
            "type_id" => $id
        ];
        if ($this->standard_model->delete($where, "types") !== false) {
            redirect("type/");
        } else redirect("fail/");
    }

    public function validate(){
        $validation_rules = array(
             array(
                   'field'   => "type_name",
                   'label'   => 'Tipe',
                   'rules'   => "max_length[100]|is_unique[types.type_name]",
                   'errors'  => array(
                          'is_unique'     => '%s sudah tersedia.',
                          'max_length' => '%s lebih dari 100 karakter.')
                )
      );
      $this->form_validation->set_rules($validation_rules);
      if($this->form_validation->run() == false){
          $config = [
              "sidebar" => $this->load->view("sidebar/sidebar", [
                  "menu" => "tipe"
              ], true),
              "header" => $this->load->view("header/header", [
                  "menu" => "tipe",
                  "menu_url" => "type"
              ], true),
              "main" => $this->load->view("main/type_add", [
                "data" => $this->standard_model->get("category_id, category_name", [],"categories", "category_name", "ASC")
              ], true)
          ];

          $this->template->page($config);
      }else {
          $this->insert();
      }
    }

}
