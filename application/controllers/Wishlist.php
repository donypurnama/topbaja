<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Controller {

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

        if (!$this->session->userdata("antglobal") || $this->session->userdata("antglobal")["customer_logged_in"] === false) {
          $this->session->set_flashdata('front_login_wishlist', 'Maaf, Anda harus melakukan login terlebih dahulu.');
          redirect("login");
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

    public function index () {

      $wishlist = $this->standard_model->get_join("products.product_id, products.product_name, products.product_url, products.product_status,
      products.product_price, products.product_discount, products.product_primary_image, wishlists.product_id", "products", "wishlists", "products.product_id = wishlists.product_id", [
        "products.product_status" => 1
      ], "wishlists.wishtlist_id");


      //$this->json->stringify($wishlist);
      $this->settings["title"] = "Wishlists " . " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/wishlist", [
        "wishlist" => $wishlist,
        "menu" => [
          "order" => "",
          "wishlist" => "active",
          "account" => ""
        ]
      ], true);

      $this->template->page($this->settings);

	}

    public function add ($product_url) {

        $product_id = $this->standard_model->find("product_id", [
          "product_url" => $product_url
        ], "products");

        $exist = $this->standard_model->find_join("wishlists.product_id, products.product_name", "wishlists", "products", "wishlists.product_id = products.product_id", [
          "products.product_status" => 1,
          "products.product_url" => $product_url,
          "wishlists.customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ]);

        //$this->json->stringify($product_id);

        $data = [
          "customer_id" => $this->session->userdata("antglobal")["customer_id"],
          "product_id" => $product_id["product_id"]
        ];

        if ($exist) {
          $this->session->set_flashdata('double_add_wishlist', 'Maaf, Produk sudah ada di wishlist.');
          redirect("wishlist");
        } else {
          $this->standard_model->insert($data, "wishlists");
          redirect("wishlist");
        }
    }

    public function delete ($product_url) {

      $product_id = $this->standard_model->find("product_id", [
        "product_url" => $product_url
      ], "products");


      $where = [
        "product_id" => $product_id["product_id"]
      ];

      if ($this->standard_model->delete($where, "wishlists") !== false) {
          redirect("wishlist");
      } else redirect($this->session->set_flashdata('err_delete_wishlist', 'Maaf, produk tidak dapat dihapus.'));
        redirect("wishlist");
    }

}
