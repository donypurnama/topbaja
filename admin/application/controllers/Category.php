<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
                  "menu" => "kategori"
              ], true),
              "header" => $this->load->view("header/header", [
                  "menu" => "kategori",
                  "menu_url" => "category"
              ], true),
              "main" => $this->load->view("main/category_view", [
                  "data" => $this->standard_model->get("category_id, category_name, category_url,category_image, category_description, category_created_time", [],"categories", "category_id")
              ], true)
          ];

          $this->template->page($config);
  	}

    public function edit ($category_url = null) {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "kategori"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "Kategori",
                "menu_url" => "category"
            ], true),
            "main" => $this->load->view("main/category_edit", [
                "data" => $this->standard_model->find("category_id,category_url,category_name,category_image,category_description", [
                    "category_url" => $category_url
                ], "categories")
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {
        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/categories");

        $title =  $this->input->post("category_name");
        $data = [
            "category_name" => $title,
            "category_url" => $this->create_slug($this->input->post("category_name")),
            "category_description" => $this->input->post("category_description")
        ];

        $file_name="";
        $config["file_name"] = $title;
        $config['allowed_types'] = '*';
        $config["upload_path"] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
        $config['max_size'] = '3072'; //3 MB
        $config["remove_spaces"] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload("category_image")) {
          $err = $this->upload->display_errors();
          $this->session->set_flashdata("error_upload", $err);
          redirect("category/add");
        } else {
            $upload_data = $this->upload->data();
            $data["category_image"] = $upload_data["file_name"];

            if ($this->standard_model->insert($data, "categories") !== false) {
                redirect("category/");
            } else redirect("fail/");
        }
    }

    public function add () {
        //var_dump ($this->session->flashdata('error'));
        // /die();
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "kategori"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "kategori",
                "menu_url" => "category"
            ], true),
            "main" => $this->load->view("main/category_add", null, true)
        ];

        $this->template->page($config);
    }

    public function update () {
        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/categories");

        $title =  $this->input->post("category_name");
        $data = [
            "category_name" => $title,
            "category_url" => $this->create_slug($this->input->post("category_name")),
            "category_description" => $this->input->post("category_description")
        ];

        $where = [
            "category_id" => $this->input->post("category_id")
        ];

        if ($_FILES["category_image"]["name"] !== "") {
            $config["file_name"] = $title;
            $config['allowed_types'] = '*';
            $config["upload_path"] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
            $config['max_size'] = '3072'; //3 MB
            $config["remove_spaces"] = TRUE;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload("category_image")) {
                $err = $this->upload->display_errors();
                $this->session->set_flashdata("error_upload", $err);
                redirect("category/edit/".$data['category_url']);
            } else {
                $upload_data = $this->upload->data();
                $data["category_image"] = $upload_data["file_name"];

                $prev_data = $this->standard_model->find("category_image",$where,"categories");
                //delete image
                //unlink ($upload_path."/".$data["category_image"]);
                echo $upload_path."/".$prev_data["category_image"];
            }
        }

        if ($this->standard_model->update($data, "categories",$where) !== false) {
            redirect("category/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $image_path = realpath(APPPATH . "../../file_assets/categories/");
        $where = [
            "category_id" => $id
        ];

        $data = $this->standard_model->find("category_image",$where,"categories");
        //delete image
        unlink ($image_path."/".$data["category_image"]);

        if ($this->standard_model->delete($where, "categories") !== false) {
            redirect("category/");
        } else redirect("fail/");
    }

    public function validate(){
        $validation_rules = array(
             array(
                   'field'   => "category_name",
                   'label'   => 'Kategori',
                   'rules'   => "max_length[100]|is_unique[categories.category_name]",
                   'errors'  => array(
                          'is_unique'     => '%s sudah tersedia.',
                          'max_length' => '%s lebih dari 100 karakter.')
                )
      );
      $this->form_validation->set_rules($validation_rules);
      if($this->form_validation->run() == false){
          $config = [
              "sidebar" => $this->load->view("sidebar/sidebar", [
                  "menu" => "category"
              ], true),
              "header" => $this->load->view("header/header", [
                  "menu" => "Kategori",
                  "menu_url" => "category"
              ], true),
              "main" => $this->load->view("main/category_add", null, true)
          ];

          $this->template->page($config);
      }else {
          $this->insert();
      }
    }
}
