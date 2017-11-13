<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
          "active" => "home",
          "customer" => $customer,
          "cart" => $count_item //to display items in cart
        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);

        $this->settings["title"] = "TOP BAJA: Besi & Baja Specialist";
    }

    public function index ($product_url = null) {

        $product = $this->standard_model->find_double_join("products.product_id, products.product_sku,
                                                          products.product_url, products.product_name, products.product_status,
                                                          products.product_price, products.product_courier, products.product_free_courier_id,
                                                          products.product_discount, products.product_description,
                                                          products.product_meta_description, products.product_primary_image, products.product_length,
                                                          products.product_width, products.product_weight, products.product_height,
                                                          products.type_id, products.brand_id, categories.category_url, categories.category_name,
                                                          type_name, types.type_url",
          "products", "categories", "types",
          "products.category_id = categories.category_id",
          "products.type_id = types.type_id", [
            "products.product_status" => 1,
            "products.product_url" => $product_url
        ]);

        $exp_product_free_courier_id = explode(',', $product['product_free_courier_id']);

        $side_category = [];
        $side_brands = [];

        $brand = $this->standard_model->find("brand_name, brand_image, brand_url", [
          "brand_id" => $product["brand_id"]
        ], "brands");

        $side_category = $this->standard_model->get("category_id, category_name, category_url", [], "categories");
        foreach ($side_category as $key=>&$value) {
          $value["side_type"] = $this->standard_model->get("type_id, type_name, type_url", [
            "category_id" => $value["category_id"]
          ], "types");
        }

        $product_images = $this->standard_model->get("product_image, product_image_description", [
            "product_id" => $product["product_id"]
        ], "product_images");

        $related_products = $this->standard_model->get("product_id, product_name, product_url, product_primary_image, product_price,
        product_discount, type_id", [
          "product_status" => 1,
          "type_id" => $product["type_id"],
          "product_id !=" => $product["product_id"],
        ], "products", "RAND()", null, 4);

        $this->settings["title"] = "Jual " . $product["product_name"] . " - TOP BAJA";
        $this->settings["description"] = $product["product_meta_description"];
        $this->settings["keywords"] = $product["product_meta_description"];
        $this->settings["main"] = $this->load->view("main/detail_product", [
            "product" => $product,
            "product_images" => $product_images,
            "side_categories" => $side_category,
            "related_products" => $related_products,
            "brand" => $brand,
            "exp_product_free_courier_id" => $exp_product_free_courier_id,
        ], true);

        $this->template->page($this->settings);
	}

}
