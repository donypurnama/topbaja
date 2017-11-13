<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if ($this->session->userdata("antglobal_backend")["user_logged_in"] == false){
          redirect("Login");
        }

        $this->load->model("standard_model");
    }

    public function index () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "testimonials"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "TESTIMONIALS",
                "menu_url" => "testimonials"
            ], true),
            "main" => $this->load->view("main/testimonials_view", [
                "data" => $this->standard_model->get("testimonials_id, testimonials_quote, testimonials_customers, testimonials_email, testimonials_website, testimonials_image, testimonials_created_time", [],
                "testimonials",
                "testimonials_id")
            ], true)
        ];

        $this->template->page($config);
	}

    public function add () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "testimonials"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "Testimonial",
                "menu_url" => "testimonials"
            ], true),
            "main" => $this->load->view("main/testimonials_add", null, true)
        ];

        $this->template->page($config);
    }

    public function edit ($id = null) {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "testimonials"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "Tanya Jawab",
                "menu_url" => "testimonials"
            ], true),
            "main" => $this->load->view("main/testimonials_edit", [
                "data" => $this->standard_model->find("testimonials_id, testimonials_quote, testimonials_customers, testimonials_email, testimonials_website, testimonials_image, testimonials_status",[
                    "testimonials_id" => $id
                ], "testimonials")
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {

        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/testimonials");

        $data = [
            "testimonials_quote"     => $this->input->post("testimonials_quote"),
            "testimonials_customers" => $this->input->post("testimonials_customers"),
            "testimonials_email"     => $this->input->post("testimonials_email"),
            "testimonials_website"   => $this->input->post("testimonials_website"),
            "testimonials_status"    => $this->input->post("testimonials_status"),
        ];
        // $this->json->stringify($data);

        $file_name                = "";
        $config["file_name"]      = $this->input->post("testimonials_image");
        $config['allowed_types']  = '*';
        $config["upload_path"]    = $upload_path;
        $config['allowed_types']  = 'jpg|jpeg|png|gif|bmp';
        $config['max_size']       = '3072'; //3 MB
        $config["remove_spaces"]  = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload("testimonials_image")) {
            $err = $this->upload->display_errors();
            $this->session->set_flashdata("error_upload", $err);
            redirect("testimonials/add");

        } else {

            $upload_data = $this->upload->data();
            $data["testimonials_image"] = $upload_data["file_name"];

            if ($this->standard_model->insert($data, "testimonials") !== false) {
                redirect("testimonials/");
            }
            else redirect("fail/");
        }
    }

    public function update () {

        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/testimonials");

        $data = [
            "testimonials_quote"     => $this->input->post("testimonials_quote"),
            "testimonials_customers" => $this->input->post("testimonials_customers"),
            "testimonials_email"     => $this->input->post("testimonials_email"),
            "testimonials_website"   => $this->input->post("testimonials_website"),
            "testimonials_status"    => $this->input->post("testimonials_status"),
        ];
        // $this->json->stringify($data);

        $where = [
            "testimonials_id" => $this->input->post("testimonials_id")
        ];

        if ($_FILES["testimonials_image"]["name"] !== "") {
            $file_name                = "";
            $config["file_name"]      = $this->input->post("testimonials_image");
            $config['allowed_types']  = '*';
            $config["upload_path"]    = $upload_path;
            $config['allowed_types']  = 'jpg|jpeg|png|gif|bmp';
            $config['max_size']       = '3072'; //3 MB
            $config["remove_spaces"]  = TRUE;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload("testimonials_image")) {
                $err = $this->upload->display_errors();
                $this->session->set_flashdata("error_upload", $err);
                redirect("testimonials/edit/".$this->input->post("testimonials_id"));
            } else {
                $upload_data = $this->upload->data();
                $data["testimonials_image"] = $upload_data["file_name"];

                $prev_data = $this->standard_model->find("testimonials_image",$where,"testimonials");
                //delete image
                unlink ($upload_path."/".$prev_data["testimonials_image"]);
                //echo $upload_path."/".$prev_data["product_image"];
            }
        }


        if ($this->standard_model->update($data, "testimonials", $where) !== false) {
            redirect("testimonials/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $where = [
            "testimonials_id" => $id
        ];

        if ($this->standard_model->delete($where, "testimonials") !== false) {
            redirect("testimonials/");
        } else redirect("fail/");
    }
}
