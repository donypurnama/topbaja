<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

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

    public function index ($blog_url = null) {
      if ($blog_url) {
        $blog = $this->standard_model->find("article_title, article_content, article_url, article_meta_description, article_created_time",[
            "article_status" => 1,
            "article_url" => $blog_url
        ], "articles");

        $this->settings["description"] = $blog["article_meta_description"];
        $this->settings["keywords"] = $blog["article_meta_description"];
        $this->settings["main"] = $this->load->view("main/detail_blog", [
            "blog" => $blog
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

        $blogs = $this->standard_model->get("article_title, article_content, article_url, article_meta_description, article_created_time",[
             "article_status" => 1
         ], "articles", "article_id", "DESC", $per_page, $offset);

         foreach ($blogs as $key=>&$value) {
           $value["article_content"] = strip_tags($value["article_content"]);
           $value["article_content"] = mb_strimwidth($value["article_content"], 0, 250, '...');
         }

        //  echo $this->json->stringify($blogs);
         $total_rows = count($this->standard_model->get("article_id", [
              "article_status" => 1
          ], "articles"));

         foreach ($blogs as $key=> &$value) {
           $value["article_image"] = null;
         }

         //pagination total page & current page calculation
         $pagination = [
           "total_page" => ceil($total_rows / $per_page),
           "current_page" => $current_page
         ];

         if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

         $this->settings["main"] = $this->load->view("main/blog", [
             "blogs" => $blogs,
             "pagination" => $pagination
         ], true);
      }

      $this->template->page($this->settings);

	}

}
