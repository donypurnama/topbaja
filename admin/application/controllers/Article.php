<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

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

      $data = $this->standard_model->get("article_id,article_title,article_content,article_url,article_meta_description,article_created_time,article_status",[],"articles", "article_id","DESC", $per_page, $offset);

       //$this->json->stringify($blogs);

       $total_rows = count($this->standard_model->get("article_id", [], "articles"));


       foreach($data as $key=>&$value){
           preg_match_all('/<img[^>]+>/i',$value["article_content"], $temp);
           if ($temp[0]) {
               $value["article_cover"] = $temp[0][0];
           } else {
               $value["article_cover"] = "<img src='../file_assets/placeholder.png'>";
           }
           if ($value["article_status"] == 0) {
               $value["article_status"] = "Draft";
           } else {
               $value["article_status"] = "Published";
           }

       }

       //pagination total page & current page calculation
       $pagination = [
         "total_page" => ceil($total_rows / $per_page),
         "current_page" => $current_page
       ];

       if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

       $this->settings["main"] = $this->load->view("main/article_view", [
           "data" => $data,
           "pagination" => $pagination
       ], true);

       $this->settings["header"] = $this->load->view("header/header", [
         "menu" => "artikel",
         "menu_url" => "article"
       ], true);

       $this->settings['sidebar'] = $this->load->view("sidebar/sidebar", [
         "menu" => "artikel"
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
                "menu" => "artikel"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "artikel",
                "menu_url" => "article"
            ], true),
            "main" => $this->load->view("main/article_add", null, true)
        ];

        $this->template->page($config);
    }

    public function edit ($article_url = null) {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "artikel"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "artikel",
                "menu_url" => "article"
            ], true),
            "main" => $this->load->view("main/article_edit", [
                "data" => $this->standard_model->find("article_id,article_title,article_content,article_url,article_status,article_meta_description",["article_url" => $article_url], "articles")
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {
        $data = [
            "article_title" => $this->input->post("article_title"),
            "article_url" => $this->create_slug($this->input->post("article_title")),
            "article_content" => $this->input->post("article_content"),
            "article_meta_description" => $this->input->post("article_meta_description"),
            "article_status" => $this->input->post("article_status")
        ];

        //$this->json->stringify($data);

        if ($this->standard_model->insert($data, "articles") !== false) {
            redirect("article/");
        } else redirect("fail/");
    }

    public function update () {

        $current_data = $this->standard_model->find([
            "article_id" => $this->input->post("article_id")
         ], "articles");


        $data = [
            "article_title" => $this->input->post("article_title"),
            "article_url" => $this->create_slug($this->input->post("article_title")),
            "article_content" => $this->input->post("article_content"),
            "article_meta_description" => $this->input->post("article_meta_description"),
            "article_status" => $this->input->post("article_status"),
            "article_last_changed_time" => date("Y-m-d H:i:s")
        ];

        $where = [
            "article_id" => $this->input->post("article_id")
        ];

        //$this->json->stringify($data);

        if ($this->standard_model->update($data, "articles", $where) !== false) {
            redirect("article/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $where = [
            "article_id" => $id
        ];

        if ($this->standard_model->delete($where, "ARTICLES") !== false) {
            redirect("article/");
        } else redirect("fail/");
    }
}
