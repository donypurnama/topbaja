<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {

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

    public function index ($brand_url) {

      $per_page = 30; //product displayed per page
      $total_rows = 0;
      $current_page = 1;

      if ($this->input->get("page") !== null) {
        $current_page = $this->input->get("page");
      }

      $limit = $per_page;
      $offset = ($current_page - 1) * $per_page;

      $brands = $this->standard_model->find("brand_id, brand_url, brand_name, brand_image, brand_description",[
        "brand_url" => $brand_url
      ], "brands");

      $products = $this->standard_model->get_join("products.product_id, products.product_url, products.product_name,
      products.product_status, products.product_price, products.product_discount, products.product_primary_image, brands.brand_id,
      brands.brand_url", "products", "brands", "products.brand_id = brands.brand_id", [
        "products.product_status" => 1,
        "brands.brand_url" => $brand_url
      ], "products.product_id", "DESC", $limit, $offset);

      $total_rows = count($this->standard_model->get("products.product_id", [
        "products.product_status" => 1,
        "products.brand_id" => $brands["brand_id"]
      ], "products"));

      $pagination = [
        "total_page" => ceil($total_rows / $per_page),
        "current_page" => $current_page
      ];

      if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;


      $this->settings["title"] = "Brand " . $brands["brand_name"] . " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/brand", [
        "brands" => $brands,
        "products" => $products,
        "pagination" => $pagination
      ], true);

      $this->template->page($this->settings);
    }

}
