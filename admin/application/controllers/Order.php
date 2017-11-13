<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if ($this->session->userdata("antglobal_backend")["user_logged_in"] == false){
          redirect("Login");
        }
        $this->load->model("standard_model");
    }

    public function index ($filter = null) {
      if ($filter){
        if($filter == "not_seen"){
          $where = "`order_seen` IS NULL";
        }elseif($filter == "waiting_verification"){
          $where = "`order_status` = 1";
        }
        $per_page = 15; //article displayed per page
        $total_rows = 0;
        $current_page = 1;

        if ($this->input->get("page") !== null) {
          $current_page = $this->input->get("page");
        }

        $limit = $per_page;
        $offset = ($current_page - 1) * $per_page;

        $data = $this->standard_model->get_join("orders.customer_id,`customer_first_name`,`customer_last_name`, `order_id`, `order_ref`,`order_total`, `order_ship_receiver_name`, `order_ship_receiver_phone`, `order_ship_province`, `order_ship_city`, `order_ship_district`, `order_ship_address`, `order_ship_postal_code`, `order_grand_total`,  `order_status`, `order_created_time`, `order_last_changed_time`, `order_seen`","orders","customers","orders.customer_id= customers.customer_id", $where, "order_id, order_status","DESC", $per_page, $offset);

         //$this->json->stringify($blogs);

         $total_rows = count($this->standard_model->get("order_id", $where, "orders"));

         //pagination total page & current page calculation
         $pagination = [
           "total_page" => ceil($total_rows / $per_page),
           "current_page" => $current_page
         ];

         if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

         $this->settings["main"] = $this->load->view("main/order_view", [
             "data" => $data,
             "pagination" => $pagination
         ], true);

         $this->settings["header"] = $this->load->view("header/header", [
             "menu" => "Pesanan",
             "menu_url" => "order"
         ], true);

         $this->settings['sidebar'] = $this->load->view("sidebar/sidebar", [
           "menu" => "order",
           "menu_url" => "order"
         ], true);

         $this->template->page($this->settings);
      }else{
        $per_page = 15; //article displayed per page
        $total_rows = 0;
        $current_page = 1;

        if ($this->input->get("page") !== null) {
          $current_page = $this->input->get("page");
        }

        $limit = $per_page;
        $offset = ($current_page - 1) * $per_page;

        $data = $this->standard_model->get_join("orders.customer_id,`customer_first_name`,`customer_last_name`, `order_id`, `order_ref`,`order_total`, `order_ship_receiver_name`, `order_ship_receiver_phone`, `order_ship_province`, `order_ship_city`, `order_ship_district`, `order_ship_address`, `order_ship_postal_code`, `order_grand_total`,  `order_status`, `order_created_time`, `order_last_changed_time`, `order_seen`","orders","customers","orders.customer_id= customers.customer_id", [], "order_id, order_status","DESC", $per_page, $offset);

         //$this->json->stringify($blogs);

         $total_rows = count($this->standard_model->get("order_id", [], "orders"));

         //pagination total page & current page calculation
         $pagination = [
           "total_page" => ceil($total_rows / $per_page),
           "current_page" => $current_page
         ];

         if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

         $this->settings["main"] = $this->load->view("main/order_view", [
             "data" => $data,
             "pagination" => $pagination
         ], true);

         $this->settings["header"] = $this->load->view("header/header", [
             "menu" => "Pesanan",
             "menu_url" => "order"
         ], true);

         $this->settings['sidebar'] = $this->load->view("sidebar/sidebar", [
           "menu" => "order",
           "menu_url" => "order"
         ], true);

      $this->template->page($this->settings);
    }
	}

  public function detail ($order_id=null) {
      $where = [
        "order_id" => $order_id
      ];
      $order = $this->standard_model->find("*", $where, "orders");
      // $data =$this->standard_model->get_multiple_join("orders.customer_id,`customer_first_name`,`customer_last_name`,orders.`bank_id`,banks.bank_name, `order_id`, `order_ref`,`order_total`, `order_ship_receiver_name`, `order_ship_receiver_phone`, `order_ship_province`, `order_ship_city`, `order_ship_district`, `order_ship_address`, `order_ship_postal_code`, `order_ship_note`, `order_ship_vendor`, `order_ship_package`, `order_ship_etd`, `order_ship_cost`, `order_ship_date`, `order_ship_resi`, `order_grand_total`, `order_verification_photo`, `order_verification_sender_name`, `order_verification_sender_bank`, `order_verification_sender_bank_account`, `order_verification_total`, `order_verification_bank_to`, `order_points`, `order_status`, `order_created_time`, `order_last_changed_time`, `order_seen`","orders","customers","orders.customer_id= customers.customer_id","banks","banks.bank_id=orders.bank_id",$where, "order_id");
      // $this->json->stringify($data);
      $config = [
          "sidebar" => $this->load->view("sidebar/sidebar", [
              "menu" => "order"
          ], true),
          "header" => $this->load->view("header/header", [
              "menu" => "Edit Pesanan",
              "menu_url" => "order"
          ], true),
          "main" => $this->load->view("main/order_edit", [
            "data"=> $this->standard_model->get_multiple_join("orders.customer_id,`customer_first_name`,`customer_last_name`,orders.`bank_id`,banks.bank_name, `order_id`, `order_ref`,`order_total`, `order_ship_receiver_name`, `order_ship_receiver_phone`, `order_ship_province`, `order_ship_city`, `order_ship_district`, `order_ship_address`, `order_ship_postal_code`, `order_ship_note`, `order_ship_vendor`, `order_ship_package`, `order_ship_etd`, `order_ship_cost`, `order_ship_date`, `order_ship_resi`,`order_ship_weight`,`order_used_point`, `order_grand_total`, `order_verification_photo`, `order_verification_sender_name`, `order_verification_sender_bank`, `order_verification_sender_bank_account`, `order_verification_total`, `order_points`, `order_status`, `order_created_time`, `order_last_changed_time`, `order_seen`","orders","customers","orders.customer_id= customers.customer_id","banks","banks.bank_id=orders.bank_id",$where, "order_id"),
            "order_details" => $this->standard_model->get_join("`order_detail_id`, `order_id`, order_details.`product_id`, `product_name`,`product_qty`, order_details.`product_price`, order_details.`product_discount`, `order_subtotal`","order_details","products","order_details.product_id = products.product_id", $where , "order_detail_id"),
            "order"=>$order
          ], true)
      ];
      $data['order_seen'] = date("Y-m-d");
      if ($this->standard_model->update($data, "orders",$where) !== false) {
          $this->template->page($config);
      } else redirect("fail/");
  }

  public function update () {
      $where = [
        "order_id" =>  $this->input->post("order_id")
      ];

      $where_customer = [
        "customer_id" => $this->input->post("customer_id")
      ];
      $customer_data = $this->standard_model->find("customer_id,customer_point",$where_customer,"customers");

      $order_points = $this->input->post("order_points");
      $order_used_point = $this->input->post("order_used_point");
      $order_status_prev = $this->input->post("order_status_prev");
      $order_ship_date = str_replace('/', '-', $this->input->post("order_ship_date"));
      $order_ship_date = date("Y-m-d", strtotime($order_ship_date));

      $data=[
        "order_status" => $this->input->post("order_status"),
        "order_ship_resi" => $this->input->post("order_ship_resi"),
        "order_ship_address" => $this->input->post("order_ship_address"),
        "order_last_changed_time" => date("Y-m-d h:m:s")
      ];

      if ($data['order_status'] != 0 &&  $data['order_status'] != 4 ){
        $data['order_ship_date'] = $order_ship_date;
      }

      if (empty($data['order_status'])) {
        $data['order_status']= $order_status_prev;
      }

      //$this->json->stringify($data);
      //tambah poin customer jika order_status -> Sudah di proses
      if ($data['order_status']==2 && ($order_status_prev==0 ||$order_status_prev==1 )) {
          $customer =[
            "customer_point" => $customer_data['customer_point'] + $order_points
          ];
          //$this->json->stringify($customer);
          if ($this->standard_model->update($customer, "customers", $where_customer) !== false) {
            echo "success";
          }else{
            die;
          }
      };

      //tambah point customer dari order used poin jika dibatalkan
      if ($data['order_status']==4 ) {
        if($order_status_prev == 0 || $order_status_prev == 1 ){
          $order_points=0;
        }
        $customer =[
          "customer_point" => $customer_data['customer_point'] + $order_used_point - $order_points
        ];
        //$this->json->stringify($customer);
        if ($this->standard_model->update($customer, "customers", $where_customer) !== false) {
          echo "success";
        }else{
          die;
        }
      };
      //$this->json->stringify($data);
      if ($this->standard_model->update($data, "orders",$where) !== false) {
          redirect("order/");
      } else redirect("fail/");
  }
}
