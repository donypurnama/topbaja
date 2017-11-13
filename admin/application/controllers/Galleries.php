<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries extends CI_Controller {

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
                  "menu" => "galleries"
              ], true),
              "header" => $this->load->view("header/header", [
                  "menu" => "galleries",
                  "menu_url" => "galleries"
              ], true),
                  "main" => $this->load->view("main/galleries_view", [
                  "data" => $this->standard_model->get("gallery_id, gallery_image, gallery_title, gallery_description, gallery_url, gallery_status, gallery_category_id", [],"galleries", "gallery_id")
              ], true)
          ];

          $this->template->page($config);
  	}

    public function edit ($id = null) {
        $banner_id = $id;
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "galleries"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "galleries",
                "menu_url" => "galleries"
            ], true),
            "main" => $this->load->view("main/galleries_edit", [
                "galleries_category"  => $this->standard_model->get("gallery_category_id, gallery_category_name", [],"galleries_category", "gallery_category_name", "ASC"),
                "data"                => $this->standard_model->find("gallery_id, gallery_image, gallery_title, gallery_description, gallery_url, gallery_status, gallery_category_id", [
                "gallery_id"          => $banner_id
                ], "galleries")
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {
        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/galleries");

        $data = [
            "gallery_title"         => $this->input->post("gallery_title"),
            "gallery_description"         => $this->input->post("gallery_description"),
            "gallery_url"         => $this->input->post("gallery_url"),
            "gallery_category_id" => $this->input->post("gallery_category_id"),
            "gallery_status"      => $this->input->post("gallery_status")
        ];

        $file_name                = "";
        $config["file_name"]      = $this->input->post("gallery_image");
        $config['allowed_types']  = '*';
        $config["upload_path"]    = $upload_path;
        $config['allowed_types']  = 'jpg|jpeg|png|gif|bmp';
        $config['max_size']       = '3072'; //3 MB
        $config["remove_spaces"]  = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload("gallery_image")) {
            $err = $this->upload->display_errors();
            $this->session->set_flashdata("error_upload", $err);
            redirect("galleries/add");
        } else {
            $upload_data = $this->upload->data();
            $data["gallery_image"] = $upload_data["file_name"];

            if ($this->standard_model->insert($data, "galleries") !== false) {
                redirect("galleries/");
            } else redirect("fail/");
        }
    }

    public function add () {

        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "galleries"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "galleries",
                "menu_url" => "galleries"
            ], true),
            "main" => $this->load->view("main/galleries_add", [
              "galleries_category"=>$this->standard_model->get("gallery_category_id, gallery_category_name", [],"galleries_category", "gallery_category_name", "ASC"),
            ], true)
        ];

        $this->template->page($config);
    }

    public function update () {
        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/galleries");

        $data = [
          "gallery_title"         => $this->input->post("gallery_title"),
          "gallery_description"         => $this->input->post("gallery_description"),
          "gallery_url"         => $this->input->post("gallery_url"),
          "gallery_category_id" => $this->input->post("gallery_category_id"),
          "gallery_status"      => $this->input->post("gallery_status")
        ];

        $where = [
            "gallery_id" => $this->input->post("gallery_id")
        ];

        if ($_FILES["gallery_image"]["name"] !== "") {
            $config["file_name"]      = $this->input->post("gallery_image");
            $config['allowed_types']  =   '*';
            $config["upload_path"]    = $upload_path;
            $config['allowed_types']  = 'jpg|jpeg|png|gif|bmp';
            $config['max_size']       = '3072'; //3 MB
            $config["remove_spaces"]  = TRUE;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload("banner_image")) {
                $err = $this->upload->display_errors();
                $this->session->set_flashdata("error_upload", $err);
                redirect("galleries/edit/".$this->input->post("gallery_id"));
            } else {
                $upload_data = $this->upload->data();
                $data["gallery_image"] = $upload_data["file_name"];

                $prev_data = $this->standard_model->find("gallery_image",$where,"galleries");
                //delete image
                unlink ($upload_path."/".$prev_data["gallery_image"]);
                //echo $upload_path."/".$prev_data["banner_image"];
            }
        }

        if ($this->standard_model->update($data, "galleries",$where) !== false) {
            redirect("galleries/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $image_path = realpath(APPPATH . "../../file_assets/galleries/");
        $where = [
            "gallery_id" => $id
        ];

        $data = $this->standard_model->find("gallery_image",$where,"galleries");
        //delete image
        unlink ($image_path."/".$data["gallery_image"]);

        if ($this->standard_model->delete($where, "galleries") !== false) {
            redirect("galleries/");
        } else redirect("fail/");
    }
}
