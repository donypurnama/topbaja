<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

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
          "active" => "blog",
          "cart" => $count_item //to display items in cart
        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);

        $this->settings["title"] = "TOP BAJA: Besi & Baja Specialist";
    }

    public function index ($gallery_id = null) {

      if ($gallery_id)
      {
          $galleries = $this->standard_model->find("gallery_id, gallery_image, gallery_title, gallery_description, gallery_url, gallery_status, gallery_category_id",[
              "gallery_status"  => 1,
              "gallery_id"      => $gallery_id
          ],  "galleries");

          $this->settings["gallery_url"]            = $galleries["gallery_url"];
          $this->settings["gallery_category_id"]    = $this->load->view("gallery_category_id/detail_gallery", [
                "galleries"    => $galleries
          ], true);
      }
      else
      {
        $per_page     = 10; //article displayed per page
        $total_rows   = 0;
        $current_page = 1;

        if ($this->input->get("page") !== null) {
          $current_page = $this->input->get("page");
        }

        $limit = $per_page;
        $offset = ($current_page - 1) * $per_page;

        $galleries = $this->standard_model->get("gallery_id, gallery_image, gallery_title, gallery_description, gallery_url, gallery_status, gallery_category_id",[
             "gallery_status" => 1
         ], "galleries", "gallery_id", "DESC", $per_page, $offset);

         foreach ($galleries as $key=>&$value) {
           $value["gallery_image"]  = strip_tags($value["gallery_image"]);
           $value["gallery_status"] = mb_strimwidth($value["gallery_status"], 0, 250, '...');
         }

        //  echo $this->json->stringify($blogsgallery_id
         $total_rows = count($this->standard_model->get("gallery_id", [
              "gallery_status" => 1
          ], "galleries"));

         // pagination total page & current page calculation
         $pagination = [
           "total_page" => ceil($total_rows / $per_page),
           "current_page" => $current_page
         ];

         if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

         $this->settings["main"] = $this->load->view("main/gallery", [
             "galleries" => $galleries,
             "pagination" => $pagination
         ], true);


      }
      $this->template->page($this->settings);
	}

}
