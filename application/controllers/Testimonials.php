<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {

    public $settings;

    function __construct () {
        parent::__construct();
        $this->load->model("standard_model");
        $customer = [];
        $count_item = 0;
        //get header categories & types
        $categories = $this->standard_model->get("category_id, category_name, category_url, category_image", [], "categories");
        foreach ($categories as $key=>&$value) {
          $value["types"] = $this->standard_model->get("type_id, type_name, type_url", [
            "category_id" => $value["category_id"]
          ], "types");
        }
        //untuk isi cart
        if (($this->session->userdata("antglobal")) && $this->session->userdata("antglobal")["customer_logged_in"] === true) {
          //do this for the rest header except login and register
          $cart = $this->standard_model->find_join("sum(carts.product_qty) as count_item", "carts", "products", "carts.product_id = products.product_id", [
            "products.product_status" => 1,
            "carts.customer_id" => $this->session->userdata("antglobal")["customer_id"]
          ]);

          if ($cart["count_item"] != null) $count_item = $cart["count_item"];
          $customer = $this->standard_model->find("customer_first_name, customer_point", [
            "customer_id" => $this->session->userdata("antglobal")["customer_id"]
          ], "customers");
        }

        $this->settings["header"] = $this->load->view("header/header", [
          "header_categories" => $categories,
          "customer" => $customer,
          "active" => "testimonials",
          "cart" => $count_item //to display items in cart
        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);

        $this->settings["title"] = "TOP BAJA: Besi & Baja Specialist";
    }

    public function index ($testimonials_id = null) {

        if ($testimonials_id) {

          $testimonials = $this->standard_model->find("testimonials_quote, testimonials_customers, testimonials_email, testimonials_website, testimonials_image, testimonials_status, testimonials_created_time",[
              "testimonials_status" => 1,
              "testimonials_id" => $testimonials_id
          ], "testimonials");

          $this->settings["quote"] = $testimonials["testimonials_quote"];
          $this->settings["main"] = $this->load->view("main/testimonials", [
              "testimonials" => $testimonials
          ], true);

        } else {

          $per_page = 10; //article displayed per page
          $total_rows = 0;
          $current_page = 1;

          if ($this->input->get("page") !== null) {
            $current_page = $this->input->get("page");
          }

          $limit = $per_page;
          $offset = ($current_page - 1) * $per_page;

          $testimonials = $this->standard_model->get("testimonials_quote, testimonials_customers, testimonials_email, testimonials_website, testimonials_image, testimonials_status, testimonials_created_time",[
               "testimonials_status" => 1
           ], "testimonials", "testimonials_id", "DESC", $per_page, $offset);


           foreach ($testimonials as $key=>&$value) {
             $value["testimonials_quote"] = strip_tags($value["testimonials_quote"]);
             $value["testimonials_quote"] = mb_strimwidth($value["testimonials_quote"], 0, 250, '...');
           }

           // echo $this->json->stringify($testimonials);
           $total_rows = count($this->standard_model->get("testimonials_id", [
                "testimonials_status" => 1
            ], "testimonials"));

           //pagination total page & current page calculation
           $pagination = [
             "total_page" => ceil($total_rows / $per_page),
             "current_page" => $current_page
           ];

           if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

           $this->settings["main"] = $this->load->view("main/testimonials", [
               "testimonials" => $testimonials,
               "pagination" => $pagination
           ], true);
      }
      $this->template->page($this->settings);

	}

  public function create () {

    $data = [
        "testimonials_quote"     => '',
        "testimonials_customers" => '',
        "testimonials_email"     => '',
        "testimonials_website"   => '',
        "testimonials_status"    => '',
    ];

    $this->settings["title"] = "Tesimonial " . " - TOP BAJA";
    $this->settings["main"] = $this->load->view("main/create_testimonial", [
        "data" => $data,
    ], true);

    $this->template->page($this->settings);
  }

  public function requests () {

      $this->load->library("upload");
      $upload_path = realpath(APPPATH . "../file_assets/testimonials");

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
          // print_r($err);
          // redirect("testimonials/add");
          $this->settings["main"] = $this->load->view("main/testimonial_failed", [
            "data" => $data
          ], true);

      } else {

          $upload_data = $this->upload->data();
          $data["testimonials_image"] = $upload_data["file_name"];

          if ($this->standard_model->insert($data, "testimonials") !== false) {
              // redirect("testimonials/");
              $this->settings["main"] = $this->load->view("main/testimonial_success", [
                "data" => $data
              ], true);
          }
          else redirect("fail/");
      }

      $this->template->page($this->settings);
  }




}
