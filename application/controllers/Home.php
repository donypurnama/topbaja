<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        //end here
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);

        $this->settings["title"] = "TOP BAJA: Besi & Baja Specialist";
    }

    public function index () {
        //get banners
        $banners = $this->standard_model->get("banner_id, banner_image, banner_url", [
          "banner_status" => 1
        ], "banners");

        //get produk pilihan / selection
        $selections = $this->standard_model->get_join("products.product_id,
        products.product_name, products.product_url, products.product_status,
        products.product_price, products.product_discount, products.product_primary_image",
        "display_selection_products", "products", "display_selection_products.product_id = products.product_id", [
          "products.product_status" => 1
        ], "display_selection_products.display_selection_product_created_time");

        //get produk terlaris / top selling
        $topsellings = $this->standard_model->get_join("products.product_id,
        products.product_name, products.product_url, products.product_status,
        products.product_price, products.product_discount, products.product_primary_image",
        "display_top_products", "products", "display_top_products.product_id = products.product_id", [
          "products.product_status" => 1
        ], "display_top_products.display_top_product_created_time");

        //get discount product
        $discountproducts = $this->standard_model->get_join("products.product_id,
        products.product_name, products.product_url, products.product_status,
        products.product_price, products.product_discount, products.product_primary_image",
        "display_discount_products", "products", "display_discount_products.product_id = products.product_id", [
          "products.product_status" => 1
        ], "display_discount_products.display_discount_product_created_time");

        //get brands
        $brands = $this->standard_model->get("brand_id, brand_name, brand_image, brand_url", [], "brands");

        //get blogs
        $blogs = $this->standard_model->get("article_id, article_url, article_title, article_content", [
          "article_status" => 1
        ], "articles", "article_id", "DESC", 2);

        //clean blog html tags to text-only & truncate string to specified width
        foreach ($blogs as $key=>&$value) {
          $value["article_content"] = strip_tags($value["article_content"]);
          $value["article_content"] = mb_strimwidth($value["article_content"], 0, 250, '...');
        }

//        $this->json->stringify($selections);

        $this->settings["main"] = $this->load->view("main/main", [
          "main_banners" => $banners,
          "main_selections" => $selections,
          "main_topselling" => $topsellings,
          "main_discountproduct" => $discountproducts,
          "main_brands" => $brands,
          "main_blogs" => $blogs
        ], true);

        $this->template->page($this->settings);
	}
}
