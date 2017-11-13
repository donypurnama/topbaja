<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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

      $data = $this->standard_model->get("`contact_id`, `contact_title`, `contact_person_name`, `contact_person_phone`, `contact_person_email`, `contact_company_name`, `contact_description`, `contact_created_time`, `contact_seen`",[],"contacts", "contact_created_time","DESC", $per_page, $offset);

       //$this->json->stringify($blogs);

       $total_rows = count($this->standard_model->get("contact_id", [], "contacts"));

       //pagination total page & current page calculation
       $pagination = [
         "total_page" => ceil($total_rows / $per_page),
         "current_page" => $current_page
       ];

       if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

       $this->settings["main"] = $this->load->view("main/contact_view", [
           "data" => $data,
           "pagination" => $pagination
       ], true);

       $this->settings["header"] = $this->load->view("header/header", [
           "menu" => "Pesan",
           "menu_url" => "contact"
       ], true);

       $this->settings['sidebar'] = $this->load->view("sidebar/sidebar", [
         "menu" => "contact",
         "menu_url" => "contact"
       ], true);

    $this->template->page($this->settings);
	}

  public function edit ($id=null) {
      $where = [
        "contact_id" => $id
      ];
      //$data =$this->standard_model->get_join("`order_id`, `order_ref`, orders.customer_id, `order_grand_total`, `order_status`,`customer_first_name`,`customer_last_name`,`order_seen`","orders","customers","orders.customer_id= customers.customer_id",$where, "order_id");
      $config = [
          "sidebar" => $this->load->view("sidebar/sidebar", [
            "menu" => "contact",
            "menu_url" => "contact"
          ], true),
          "header" => $this->load->view("header/header", [
            "menu" => " Edit Pesan",
            "menu_url" => "contact"
          ], true),
          "main" => $this->load->view("main/contact_edit", [
            "data"=>  $this->standard_model->find("`contact_id`, `contact_title`, `contact_person_name`, `contact_person_phone`, `contact_person_email`, `contact_company_name`, `contact_description`, `contact_created_time`, `contact_seen`",$where,"contacts")
          ], true)
      ];
      $data['contact_seen'] = date("Y-m-d");
      if ($this->standard_model->update($data, "contacts",$where) !== false) {
          $this->template->page($config);
      } else redirect("fail/");
  }
  public function update () {
      $where = [
        "contact_id" =>  $this->input->post("contact_id")
      ];

      $data=[
        "contact_person_name" => $this->input->post("contact_person_name"),
        "contact_person_phone" => $this->input->post("contact_person_phone"),
        "contact_person_email" => $this->input->post("contact_person_email"),
        "contact_company_name" => $this->input->post("contact_company_name"),
        "contact_description" => $this->input->post("contact_description")
      ];

      //$this->json->stringify($data);
      if ($this->standard_model->update($data, "contacts",$where) !== false) {
          redirect("contact/");
      } else redirect("fail/");
  }
}
