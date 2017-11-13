<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if ($this->session->userdata("antglobal_backend")["user_logged_in"] == false){
          redirect("Login");
        }
        $this->load->model("standard_model");
    }

    public function index () {
        // $config = [
        //     "sidebar" => $this->load->view("sidebar/sidebar", [
        //         "menu" => "quotation",
        //         "menu_url" => "quotation"
        //     ], true),
        //     "header" => $this->load->view("header/header", [
        //         "menu" => "permintaan",
        //         "menu_url" => "quotation"
        //     ], true),
        //     "main" => $this->load->view("main/quotation_view", [
        //       "data" => $this->standard_model->get_join("`quotation_id`, quotations.customer_id, `quotation_title`, `quotation_category`, `quotation_person_name`, `quotation_person_phone`, `quotation_person_email`, `quotation_company_name`, `quotation_description`, `quotation_created_time`, `quotation_seen`,`customer_first_name`,`customer_last_name`","quotations","customers","quotations.customer_id = customers.customer_id", [], "quotation_id")
        //     ], true)
        // ];
        // $this->template->page($config);

        $per_page = 15; //article displayed per page
        $total_rows = 0;
        $current_page = 1;

        if ($this->input->get("page") !== null) {
          $current_page = $this->input->get("page");
        }

        $limit = $per_page;
        $offset = ($current_page - 1) * $per_page;

        $data = $this->standard_model->get_join("`quotation_id`, quotations.customer_id, `quotation_title`, `quotation_category`, `quotation_person_name`, `quotation_person_phone`, `quotation_person_email`, `quotation_company_name`, `quotation_description`, `quotation_created_time`, `quotation_seen`,`customer_first_name`,`customer_last_name`","quotations","customers","quotations.customer_id = customers.customer_id", [], "quotation_id","DESC", $per_page, $offset);

         //$this->json->stringify($blogs);

         $total_rows = count($this->standard_model->get("quotation_id", [], "quotations"));

         //pagination total page & current page calculation
         $pagination = [
           "total_page" => ceil($total_rows / $per_page),
           "current_page" => $current_page
         ];

         if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

         $this->settings["main"] = $this->load->view("main/quotation_view", [
             "data" => $data,
             "pagination" => $pagination
         ], true);

         $this->settings["header"] = $this->load->view("header/header", [
           "menu" => "permintaan",
           "menu_url" => "quotation"
         ], true);

         $this->settings['sidebar'] = $this->load->view("sidebar/sidebar", [
           "menu" => "quotation",
           "menu_url" => "quotation"
         ], true);

      $this->template->page($this->settings);
	}

  public function detail ($id=null) {
      $where = [
        "quotation_id" => $id
      ];
      //$data =$this->standard_model->get_join("`order_id`, `order_ref`, orders.customer_id, `order_grand_total`, `order_status`,`customer_first_name`,`customer_last_name`,`order_seen`","orders","customers","orders.customer_id= customers.customer_id",$where, "order_id");
      $config = [
          "sidebar" => $this->load->view("sidebar/sidebar", [
            "menu" => "quotation",
            "menu_url" => "quotation"
          ], true),
          "header" => $this->load->view("header/header", [
            "menu" => "permintaan",
            "menu_url" => "quotation"
          ], true),
          "main" => $this->load->view("main/quotation_edit", [
            "data"=>  $this->standard_model->get_join("`quotation_id`, quotations.customer_id, `quotation_title`, `quotation_category`, `quotation_person_name`, `quotation_person_phone`, `quotation_person_email`, `quotation_company_name`, `quotation_description`, `quotation_created_time`, `quotation_seen`,`customer_first_name`,`customer_last_name`","quotations","customers","quotations.customer_id = customers.customer_id", $where, "quotation_id")
          ], true)
      ];
      $data['quotation_seen'] = date("Y-m-d");
      if ($this->standard_model->update($data, "quotations",$where) !== false) {
          $this->template->page($config);
      } else redirect("fail/");
  }
  public function update () {
      $where = [
        "quotation_id" =>  $this->input->post("quotation_id")
      ];

      $data=[
        "quotation_category" => $this->input->post("quotation_category"),
        "quotation_person_name" => $this->input->post("quotation_person_name"),
        "quotation_person_phone" => $this->input->post("quotation_person_phone"),
        "quotation_person_email" => $this->input->post("quotation_person_email"),
        "quotation_company_name" => $this->input->post("quotation_company_name"),
        "quotation_description" => $this->input->post("quotation_description")
      ];

      //$this->json->stringify($data);
      if ($this->standard_model->update($data, "quotations",$where) !== false) {
          redirect("quotation/");
      } else redirect("fail/");
  }
}
