<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {

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
                "menu" => "brand"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "brand",
                "menu_url" => "brand"
            ], true),
            "main" => $this->load->view("main/brand_view", [
                "data" => $this->standard_model->get("brand_id, brand_name, brand_url,brand_image, brand_description, brand_created_time", [],"brands", "brand_id")
            ], true)
        ];

        $this->template->page($config);
	}

    public function add () {
        $this->session->keep_flashdata("error_upload");
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "brand"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "brand",
                "menu_url" => "brand"
            ], true),
            "main" => $this->load->view("main/brand_add", null, true)
        ];

        $this->template->page($config);
    }

    public function edit ($brand_url = null) {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "brand"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "brand",
                "menu_url" => "brand"
            ], true),
            "main" => $this->load->view("main/brand_edit", [
                "data" => $this->standard_model->find("brand_id,brand_url,brand_name,brand_image,brand_description", [
                    "brand_url" => $brand_url
                ], "brands")
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {
        //$this->json->stringify($_POST);
        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/brands");

        $title =  $this->input->post("brand_name");
        $data = [
            "brand_name" => $title,
            "brand_url" => $this->create_slug($this->input->post("brand_name")),
            "brand_description" => $this->input->post("brand_description")
        ];

        $file_name="";
        $config["file_name"] = $title;
        $config['allowed_types'] = '*';
        $config["upload_path"] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
        $config['max_size'] = '3072'; //3 MB
        $config["remove_spaces"] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload("brand_image")) {
            $err = $this->upload->display_errors();
            $this->session->set_flashdata("error_upload", $err);
            redirect("brand/add");
        } else {

            $upload_data = $this->upload->data();
            $data["brand_image"] = $upload_data["file_name"];

            if ($this->standard_model->insert($data, "brands") !== false) {
                redirect("brand/");
            } else redirect("fail/");
        }
    }

    public function update () {
        //$this->json->stringify($_POST);
        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/brands");

        $title =  $this->input->post("brand_name");
        $data = [
            "brand_name" => $title,
            "brand_url" => $this->create_slug($this->input->post("brand_name")),
            "brand_description" => $this->input->post("brand_description")
        ];
        $brand_url = $data['brand_url'];
        //$this->json->stringify($data);
        $where = [
            "brand_id" => $this->input->post("brand_id")
        ];
        //$this->json->stringify();
        if ($_FILES['brand_image']['name']!=="") {
            $config["file_name"] = $title;
            $config['allowed_types'] = '*';
            $config["upload_path"] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
            $config['max_size'] = '3072'; //3 MB
            $config["remove_spaces"] = TRUE;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload("brand_image")) {
                $err = $this->upload->display_errors();
                //die($err);
                $this->session->set_flashdata("error_upload", $err);
                redirect("brand/edit/$brand_url");

            } else {
                $upload_data = $this->upload->data();
                $data["brand_image"] = $upload_data["file_name"];

                $prev_data = $this->standard_model->find("brand_image",$where,"brands");
                //delete image
                unlink ($upload_path."/".$prev_data["brand_image"]);
                //echo $upload_path."/".$prev_data["brand_image"];
            }
        }

        if ($this->standard_model->update($data, "brands",$where) !== false) {
            redirect("brand/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $image_path = realpath(APPPATH . "../../file_assets/brands/");
        $where = [
            "brand_id" => $id
        ];

        $data = $this->standard_model->find("brand_image",$where,"brands");
        //delete image
        unlink ($image_path."/".$data["brand_image"]);

        if ($this->standard_model->delete($where, "brands") !== false) {
            redirect("brand/");
        } else redirect("fail/");
    }

    public function validate(){
        $validation_rules = array(
             array(
                   'field'   => "brand_name",
                   'label'   => 'Brand',
                   'rules'   => "max_length[100]|is_unique[brands.brand_name]",
                   'errors'  => array(
                          'is_unique'     => '%s sudah tersedia.',
                          'max_length' => '%s lebih dari 100 karakter.')
                )
      );
      $this->form_validation->set_rules($validation_rules);
      if($this->form_validation->run() == false){
          $config = [
              "sidebar" => $this->load->view("sidebar/sidebar", [
                  "menu" => "brand"
              ], true),
              "header" => $this->load->view("header/header", [
                  "menu" => "brand",
                  "menu_url" => "brand"
              ], true),
              "main" => $this->load->view("main/brand_add", null, true)
          ];

          $this->template->page($config);
      }else {
          $this->insert();
      }
    }

}
