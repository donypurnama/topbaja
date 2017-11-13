<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public $settings;

    function __construct () {
        parent::__construct();
        $this->load->model("standard_model");
        $count_item = 0;
        $customer = [];
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
          "active" => "category",
          "customer" => $customer,
          "cart" => $count_item //to display items in cart
        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);

        $this->settings["title"] = "TOP BAJA: Besi & Baja Specialist";
    }

    public function index ($category_url = null, $type_url = null) {
        //path

        //pagination
        $per_page = 30; //products displayed per page
        $total_rows = 0;
        $current_page = 1;

        //if there's page parameter then current page = page parameter else, current page = 1
        if ($this->input->get("page") !== null) {
          $current_page = $this->input->get("page");
        }
        $limit = $per_page;
        $offset = ($current_page - 1) * $per_page;

        //filter brands
        $brands = [];
        $filter_brands = null;
        if (!empty($this->input->get("brands"))) {
          foreach($this->input->get("brands") as $brand) {
            $brands[] = "products.brand_id = " . $brand;
          }

          if (!empty($brands)) {
            $filter_brands = implode(' OR ', $brands);
          }
        }

        //sort
        $sort = $this->input->get("sort");
        $order = "products.product_created_time";
        $order_sort = "DESC";

        if ($sort == "cheapest") {
          $order = "products.product_price";
          $order_sort = "ASC";
        } else if ($sort == "discount") {
          $order = "products.product_discount";
          $order_sort = "DESC";
        } else {
          $order = "products.product_created_time";
          $order_sort = "DESC";
        }

        //get product,categories,type
        $products = [];
        $categories = [];
        $types = null;
        $side_category = [];
        $side_brands = [];

        $side_category = $this->standard_model->get("category_id, category_name, category_url", [], "categories");
        foreach ($side_category as $key=>&$value) {
          $value["side_type"] = $this->standard_model->get("type_id, type_name, type_url", [
            "category_id" => $value["category_id"]
          ], "types");
        }

        if ($category_url && $type_url) {
          $products = $this->standard_model->get_double_join("products.product_id, products.product_url, products.product_name,
          products.product_status, products.product_price, products.product_discount, products.product_primary_image, categories.category_url, types.type_url",
          "products", "categories", "types", "products.category_id = categories.category_id", "products.type_id = types.type_id", [
            "products.product_status" => 1,
            "categories.category_url" => $category_url,
            "types.type_url" => $type_url
          ], $order, $order_sort, $per_page, $offset, $filter_brands);

          $total_rows = count($this->standard_model->get_double_join("products.product_id",
          "products", "categories", "types", "products.category_id = categories.category_id", "products.type_id = types.type_id", [
            "products.product_status" => 1,
            "categories.category_url" => $category_url,
            "types.type_url" => $type_url
          ], null, null, null, null, $filter_brands));

          $categories = $this->standard_model->find("category_id, category_name, category_url, category_description", [
            "category_url" => $category_url
          ], "categories");

          $types = $this->standard_model->find("type_id, type_name, type_url, type_description", [
            "type_url" => $type_url
          ], "types");

          $side_brands = $this->standard_model->get_join_group("products.brand_id, brands.brand_name", "products", "brands", "products.brand_id = brands.brand_id", [
            "products.category_id" => $categories["category_id"],
            "products.type_id" => $types["type_id"],
          ], "products.brand_id", "ASC", "products.brand_id");
          //$this->json->stringify($products);

        } else if ($category_url != null && $type_url == null) {
          $products = $this->standard_model->get_join("products.product_id, products.product_url, products.product_name,
          products.product_status, products.product_price, products.product_discount, products.product_primary_image, categories.category_url",
          "products", "categories", "products.category_id = categories.category_id", [
            "products.product_status" => 1,
            "categories.category_url" => $category_url
          ], $order, $order_sort, $per_page, $offset, $filter_brands);

          $total_rows = count($this->standard_model->get_join("products.product_id",
          "products", "categories", "products.category_id = categories.category_id", [
            "products.product_status" => 1,
            "categories.category_url" => $category_url
          ], null, null, null, null, $filter_brands));

          $categories = $this->standard_model->find("category_id, category_name, category_url, category_description", [
            "category_url" => $category_url
          ], "categories");

          $side_brands = $this->standard_model->get_join_group("products.brand_id, brands.brand_name", "products", "brands", "products.brand_id = brands.brand_id", [
            "products.category_id" => $categories["category_id"]
          ], "products.brand_id", "ASC", "products.brand_id");
        }

        //insert selected brands to side brands (if any)
        if (!empty($this->input->get("brands"))) {
          foreach ($side_brands as $key=>&$value) {
            $value["checked"] = "";
            foreach($this->input->get("brands") as $brand) {
              if ($value["brand_id"] == $brand) $value["checked"] = "checked";
            }
          }
        }

        //pagination total page & current page calculation
        $pagination = [
          "total_page" => ceil($total_rows / $per_page),
          "current_page" => $current_page
        ];

        if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

        $this->settings["title"] = "Kategori " . $categories["category_name"] . " - TOP BAJA";
        $this->settings["main"] = $this->load->view("main/category", [
          "products" => $products,
          "category" => $categories,
          "type" => $types,
          "side_categories" => $side_category,
          "side_brands" => $side_brands,
          "pagination" => $pagination
        ], true);

        $this->template->page($this->settings);
	}
}
