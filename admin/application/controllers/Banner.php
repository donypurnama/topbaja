<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {

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
                  "menu" => "banner"
              ], true),
              "header" => $this->load->view("header/header", [
                  "menu" => "banner",
                  "menu_url" => "banner"
              ], true),
              "main" => $this->load->view("main/banner_view", [
                  "data" => $this->standard_model->get("banner_id, banner_image, banner_url,banner_status,banner_created_time", [],"banners", "banner_id")
              ], true)
          ];

          $this->template->page($config);
  	}

    public function edit ($id = null) {
        $banner_id = $id;
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "banner"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "banner",
                "menu_url" => "banner"
            ], true),
            "main" => $this->load->view("main/banner_edit", [
                "data" => $this->standard_model->find("banner_id,banner_image,banner_url,banner_status", [
                    "banner_id" => $banner_id
                ], "banners")
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {
        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/banners");

        $data = [
            "banner_url" => $this->input->post("banner_url"),
            "banner_status" => $this->input->post("banner_status")
        ];

        $url = parse_url($data['banner_url']);
        $title = strtok($url['path'],".");

        $file_name="";
        $config["file_name"] = $title;
        $config['allowed_types'] = '*';
        $config["upload_path"] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
        $config['max_size'] = '3072'; //3 MB
        $config["remove_spaces"] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload("banner_image")) {
            //$err = $this->upload->display_errors();
            $err = $this->upload->display_errors();
            $this->session->set_flashdata("error_upload", $err);
            redirect("banner/add");
        } else {
            $upload_data = $this->upload->data();
            $data["banner_image"] = $upload_data["file_name"];

            if ($this->standard_model->insert($data, "banners") !== false) {
                redirect("banner/");
            } else redirect("fail/");
        }
    }

    public function add () {

        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "banner"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "banner",
                "menu_url" => "banner"
            ], true),
            "main" => $this->load->view("main/banner_add", null, true)
        ];

        $this->template->page($config);
    }

    public function update () {
        $this->load->library("upload");

        $upload_path = realpath(APPPATH . "../../file_assets/banners");
        $data = [
            "banner_url" => $this->input->post("banner_url"),
            "banner_status" => $this->input->post("banner_status")
        ];

        $url = parse_url($data['banner_url']);
        $title = strtok($url['path'],".");

        $where = [
            "banner_id" => $this->input->post("banner_id")
        ];

        if ($_FILES["banner_image"]["name"] !== "") {
            $config["file_name"] = $title;
            $config['allowed_types'] = '*';
            $config["upload_path"] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
            $config['max_size'] = '3072'; //3 MB
            $config["remove_spaces"] = TRUE;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload("banner_image")) {
                // $err = $this->upload->display_errors();
                // die($err);
                $err = $this->upload->display_errors();
                $this->session->set_flashdata("error_upload", $err);
                redirect("banner/edit/".$this->input->post("banner_id"));
            } else {
                $upload_data = $this->upload->data();
                $data["banner_image"] = $upload_data["file_name"];

                $prev_data = $this->standard_model->find("banner_image",$where,"banners");
                //delete image
                unlink ($upload_path."/".$prev_data["banner_image"]);
                //echo $upload_path."/".$prev_data["banner_image"];
            }
        }

        if ($this->standard_model->update($data, "banners",$where) !== false) {
            redirect("banner/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $image_path = realpath(APPPATH . "../../file_assets/banners/");
        $where = [
            "banner_id" => $id
        ];

        $data = $this->standard_model->find("banner_image",$where,"banners");
        //delete image
        unlink ($image_path."/".$data["banner_image"]);

        if ($this->standard_model->delete($where, "banners") !== false) {
            redirect("banner/");
        } else redirect("fail/");
    }
}
