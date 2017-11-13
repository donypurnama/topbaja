<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if ($this->session->userdata("antglobal_backend")["user_logged_in"] == false){
          redirect("Login");
        }
        $this->load->model("standard_model");
    }

    public function index () {
      $per_page = 10; //article displayed per page
      $total_rows = 0;
      $current_page = 1;

      if ($this->input->get("page") !== null) {
        $current_page = $this->input->get("page");
      }

      $limit = $per_page;
      $offset = ($current_page - 1) * $per_page;

      $data = $this->standard_model->get("promo_id,promo_title,promo_content,promo_url,promo_meta_description,promo_created_time,promo_status",[],"promos", "promo_id","DESC", $per_page, $offset);

       //$this->json->stringify($blogs);
       $total_rows = count($this->standard_model->get("promo_id", [], "promos"));

       foreach($data as $key=>&$value){
           preg_match_all('/<img[^>]+>/i',$value["promo_content"], $temp);
           if ($temp[0]) {
               $value["promo_cover"] = $temp[0][0];
           } else {
               $value["promo_cover"] = "<img src='../file_assets/placeholder.png'>";
           }
           if ($value["promo_status"] == 0) {
               $value["promo_status"] = "Draft";
           } else {
               $value["promo_status"] = "Published";
           }

       }

       //pagination total page & current page calculation
       $pagination = [
         "total_page" => ceil($total_rows / $per_page),
         "current_page" => $current_page
       ];

       if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

       $this->settings["main"] = $this->load->view("main/promo_view", [
           "data" => $data,
           "pagination" => $pagination
       ], true);

       $this->settings["header"] = $this->load->view("header/header", [
         "menu" => "promo",
         "menu_url" => "promo"
       ], true);

       $this->settings['sidebar'] = $this->load->view("sidebar/sidebar", [
         "menu" => "promo"
       ], true);

    $this->template->page($this->settings);

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

    public function add () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "promo"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "promo",
                "menu_url" => "promo"
            ], true),
            "main" => $this->load->view("main/promo_add", null, true)
        ];

        $this->template->page($config);
    }

    public function edit ($promo_url = null) {

        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "promo"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "promo",
                "menu_url" => "promo"
            ], true),
            "main" => $this->load->view("main/promo_edit", [
                "data" => $this->standard_model->find("promo_id,promo_title,promo_content,promo_url,promo_status,promo_description, promo_meta_description",["promo_url" => $promo_url], "promos")
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {
        $data = [
            "promo_title" => $this->input->post("promo_title"),
            "promo_url" => $this->create_slug($this->input->post("promo_title")),
            "promo_content" => $this->input->post("promo_content"),
            "promo_meta_description" => $this->input->post("promo_meta_description"),
            "promo_status" => $this->input->post("promo_status")
        ];

        //$this->json->stringify($data);

        if ($this->standard_model->insert($data, "promos") !== false) {
            redirect("promo/");
        } else redirect("fail/");
    }

    public function update () {

        $current_data = $this->standard_model->find([
            "promo_id" => $this->input->post("promo_id")
         ], "promos");


        $data = [
            "promo_title" => $this->input->post("promo_title"),
            "promo_url" => $this->create_slug($this->input->post("promo_title")),
            "promo_content" => $this->input->post("promo_content"),
            "promo_meta_description" => $this->input->post("promo_meta_description"),
            "promo_status" => $this->input->post("promo_status"),
            "promo_last_changed_time" => date("Y-m-d H:i:s")
        ];

        $where = [
            "promo_id" => $this->input->post("promo_id")
        ];

        //$this->json->stringify($data);

        if ($this->standard_model->update($data, "promos", $where) !== false) {
            redirect("promo/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $where = [
            "promo_id" => $id
        ];

        if ($this->standard_model->delete($where, "PROMOS") !== false) {
            redirect("promo/");
        } else redirect("fail/");
    }
}
