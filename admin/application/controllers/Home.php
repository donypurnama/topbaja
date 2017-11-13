<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if ($this->session->userdata("antglobal_backend")["user_logged_in"] == false){
          redirect("Login");
        }
        $this->load->model("standard_model");
    }

    public function index () {
        // print_r($this->session->all_userdata());
        // die;
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "home",
                "menu_url" => "home"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "home",
                "menu_url" => "home"
            ], true),
            "main" => $this->load->view("main/home", [
              "selections"=> $this->standard_model->get_join("`display_selection_product_id`, display_selection_products.product_id, `display_selection_product_created_time`, product_name","display_selection_products","products","display_selection_products.product_id= products.product_id", [], "display_selection_product_id"),
              "discounts"=> $this->standard_model->get_join("`display_discount_product_id`, display_discount_products.product_id, `display_discount_product_created_time`, product_name","display_discount_products","products","display_discount_products.product_id= products.product_id", [], "display_discount_product_id"),
              "tops"=> $this->standard_model->get_join("`display_top_product_id`, display_top_products.product_id, `display_top_product_created_time`, product_name","display_top_products","products","display_top_products.product_id= products.product_id", [], "display_top_product_id"),
              "orders" => $this->standard_model->get_join("`order_id`, `order_ref`, orders.customer_id, `order_grand_total`, `order_status`,`customer_first_name`,`customer_last_name`,`order_seen`","orders","customers","orders.customer_id= customers.customer_id", "`order_seen` IS NULL", "order_id"),
              "quotations" => $this->standard_model->get_join("`quotation_id`, quotations.customer_id, `quotation_title`, `quotation_category`, `quotation_person_name`, `quotation_person_phone`, `quotation_person_email`, `quotation_company_name`, `quotation_description`, `quotation_created_time`, `quotation_seen`,`customer_first_name`,`customer_last_name`","quotations","customers","quotations.customer_id = customers.customer_id", "quotation_seen IS NULL", "quotation_id"),
              "contacts" => $this->standard_model->get("`contact_id`, `contact_title`, `contact_person_name`, `contact_person_phone`, `contact_person_email`, `contact_company_name`, `contact_description`, `contact_created_time`, `contact_seen`","contact_seen is NULL","contacts"),
              "not_verified_orders" => $this->standard_model->get("`order_id`, `order_status`,`order_seen`","order_status = 1","orders")

            ], true)
        ];

        $this->template->page($config);
	}

  public function delete ($product_cat=null,$product_id = null){
      $product_table= null;
      if ($product_cat == "selection") {
          $product_cat = "display_selection_product_id";
          $product_table = "display_selection_products";
      } elseif ($product_cat == "discount") {
          $product_cat = "display_discount_product_id";
          $product_table = "display_discount_products";
      } else{
          $product_cat = "display_top_product_id";
          $product_table = "display_top_products";
      }

      $where = [
          $product_cat => $product_id
      ];

      if ($this->standard_model->delete($where, $product_table) !== false) {
          redirect("home/");
      } else redirect("fail/");
  }

  public function logout(){
      $this->session->unset_userdata('logged_in');
      //session_destroy();
      redirect("login", "refresh");
  }

  public function order ($order_id=null) {

      $where = [
        "order_id" => $order_id
      ];
      //$data =$this->standard_model->get_join("`order_id`, `order_ref`, orders.customer_id, `order_grand_total`, `order_status`,`customer_first_name`,`customer_last_name`,`order_seen`","orders","customers","orders.customer_id= customers.customer_id",$where, "order_id");
      $config = [
          "sidebar" => $this->load->view("sidebar/sidebar", [
              "menu" => "home"
          ], true),
          "header" => $this->load->view("header/header", [
              "menu" => "Edit Order",
              "menu_url" => "home"
          ], true),
          "main" => $this->load->view("main/order_edit", [
            "data"=> $this->standard_model->get_join("orders.customer_id,`customer_first_name`,`customer_last_name`, `order_id`, `order_ref`,`order_total`, `order_ship_receiver_name`, `order_ship_receiver_phone`, `order_ship_province`, `order_ship_city`, `order_ship_district`, `order_ship_address`, `order_ship_postal_code`, `order_ship_note`, `order_ship_vendor`, `order_ship_package`, `order_ship_etd`, `order_ship_cost`, `order_ship_date`, `order_ship_resi`, `order_grand_total`, `order_verification_photo`, `order_verification_sender_name`, `order_verification_sender_bank`, `order_verification_sender_bank_account`, `order_verification_total`, `order_verification_bank_to`, `order_points`, `order_status`, `order_created_time`, `order_last_changed_time`, `order_seen`","orders","customers","orders.customer_id= customers.customer_id",$where, "order_id"),
            "order_details" => $this->standard_model->get_join("`order_detail_id`, `order_id`, order_details.`product_id`, `product_name`,`product_qty`, order_details.`product_price`, order_details.`product_discount`, `order_subtotal`","order_details","products","order_details.product_id = products.product_id", $where , "order_detail_id")
          ], true)
      ];
      $data['order_seen'] = date("Y-m-d");
      if ($this->standard_model->update($data, "orders",$where) !== false) {
          $this->template->page($config);
      } else redirect("fail/");

  }

  public function add_products($product_cat=null){
    if ($product_cat == "selection") {
        $title = "Pilihan";
        $product_table = "display_selection_products";
    } elseif ($product_cat == "discount") {
        $title = "Diskon";
        $product_table = "display_discount_products";
    } else{
        $title = "Terlaris";
        $product_table = "display_top_products";
    }
    $where ="`products`.`product_id` NOT IN (SELECT `product_id` FROM $product_table)";
    $config = [
        "sidebar" => $this->load->view("sidebar/sidebar", [
            "menu" => "home",
            "menu_url" => "home"
        ], true),
        "header" => $this->load->view("header/header", [
            "menu" => "Tambah Produk ".$title,
            "menu_url" => "home"
        ], true),
        "main" => $this->load->view("main/product_selection_add", [
          "data" => $this->standard_model->get("`product_id`, `product_sku`, `category_id`, `type_id`, `brand_id`, `product_name`, `product_url`, `product_meta_description`, `product_primary_image`, `product_description`, `product_price`, `product_status`, `product_discount`, `product_length`, `product_width`, `product_height`, `product_weight`, `product_created_time`, `product_last_changed_time`", $where,"products", "product_id"),
          "url"=>$product_cat
        ], true)
    ];

    $this->template->page($config);
  }

  public function add_product ($product_cat=null,$product_id = null){
      $product_table= null;
      if ($product_cat == "selection") {
          $product_table = "display_selection_products";
      } elseif ($product_cat == "discount") {
          $product_table = "display_discount_products";
      } else{
          $product_table = "display_top_products";
      }
      $data = [
        "product_id" => $product_id,
      ];

      if ($this->standard_model->insert($data, $product_table) !== false) {
          redirect("home/");
      } else redirect("fail/");
  }
}
