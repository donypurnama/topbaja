<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {

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
                "menu" => "faq"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "FAQ",
                "menu_url" => "faq"
            ], true),
            "main" => $this->load->view("main/faq_view", [
                "data" => $this->standard_model->get("faq_id, faq_question, faq_answer, faq_created_time", [],"faqs", "faq_id")
            ], true)
        ];

        $this->template->page($config);
	}

    public function add () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "faq"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "Tanya Jawab",
                "menu_url" => "faq"
            ], true),
            "main" => $this->load->view("main/faq_add", null, true)
        ];

        $this->template->page($config);
    }

    public function edit ($id = null) {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "faq"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "Tanya Jawab",
                "menu_url" => "faq"
            ], true),
            "main" => $this->load->view("main/faq_edit", [
                "data" => $this->standard_model->find("faq_id, faq_answer, faq_question", [
                    "faq_id" => $id
                ], "faqs")
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {
        $data = [
            "faq_answer" => $this->input->post("faq_answer"),
            "faq_question" => $this->input->post("faq_question"),
        ];

        if ($this->standard_model->insert($data, "faqs") !== false) {
            redirect("faq/");
        } else redirect("fail/");
    }

    public function update () {
        $data = [
            "faq_answer" => $this->input->post("faq_answer"),
            "faq_question" => $this->input->post("faq_question")
        ];

        $where = [
            "faq_id" => $this->input->post("faq_id")
        ];

        if ($this->standard_model->update($data, "faqs", $where) !== false) {
            redirect("faq/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $where = [
            "faq_id" => $id
        ];

        if ($this->standard_model->delete($where, "faqs") !== false) {
            redirect("faq/");
        } else redirect("fail/");
    }
}
