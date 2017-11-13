<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if ($this->session->userdata("antglobal_backend")["user_logged_in"] == false){
          redirect("Login");
        }

        $this->load->model("standard_model");
    }

    public function init ($url = null) {
      if ($url == "customer") {
        $view  = "report_customer_view";
        $title = "Pelanggan";
        $menu = "pelanggan";
      }elseif ($url == "sales") {
        $view  = "report_sales_view";
        $title = "Penjualan";
        $menu = "penjualan";
      }
      $config = [
           "sidebar" => $this->load->view("sidebar/sidebar", [
               "menu" => $menu
           ], true),
           "header" => $this->load->view("header/header", [
               "menu" => "Laporan $title",
               "menu_url" => "report/init/$url"
           ], true),
           "main" => $this->load->view("main/$view", ["data"=>null], true)
       ];

       $this->template->page($config);
	  }

    public function customer (){
        $start_date =$this->input->post("start_date");
        $end_date =$this->input->post("end_date");
        //$this->json->stringify($date);

        $per_page = 10; //article displayed per page
        $total_rows = 0;
        $current_page = 1;

        if ($this->input->get("page") !== null) {
          $current_page = $this->input->get("page");
        }
        $start_date  = str_replace('/', '-', $start_date );
        $end_date  = str_replace('/', '-', $end_date );
        $start_date  = date("Y-m-d H:i:s",strtotime($start_date ."00:00:0"));
        $end_date  =  date("Y-m-d H:i:s",strtotime($end_date ."23:59:0"));

        $date = [
          "start_date" => $start_date,
          "end_date" => $end_date,
        ];
        $limit = $per_page;
        $offset = ($current_page - 1) * $per_page;

        //$data =  $this->standard_model->complex_query($query);
        $data = $this->standard_model->get_groupby("customers.customer_id, concat(customers.customer_first_name, ' ',customers.customer_last_name) as `customer_name`,customers.customer_point,customers.customer_email_address, (
              SELECT COUNT(orders.order_id) FROM orders WHERE orders.customer_id = customers.customer_id AND orders.order_created_time BETWEEN '$start_date' AND '$end_date') as `customer_order_transaction`,(
              SELECT COUNT(quotations.quotation_id) FROM quotations WHERE quotations.customer_id = customers.customer_id AND quotations.quotation_created_time BETWEEN  '$start_date' AND '$end_date') as `customer_quotation_transaction`",[], "customers", "customers.customer_id","customer_name", "ASC", $per_page, $offset);
        //$this->json->stringify($data);

       $total_rows = count($this->standard_model->get("customer_id", [], "customers"));

       //pagination total page & current page calculation
       $pagination = [
         "total_page" => ceil($total_rows / $per_page),
         "current_page" => $current_page
       ];

       if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

       $this->settings["main"] = $this->load->view("main/report_customer_view", [
           "data" => $data,
           "date" => $date,
           "pagination" => $pagination
       ], true);

       $this->settings["header"] = $this->load->view("header/header", [
           "menu" => "Laporan Pelanggan",
           "menu_url" => "report/customer"
       ], true);

       $this->settings['sidebar'] = $this->load->view("sidebar/sidebar", [
         "menu" => "pelanggan",
         "menu_url" => "report/customer"
       ], true);

       $this->template->page($this->settings);

    }
  public function detail_customer ($id=null,$start_date=null,$end_date=null) {
        $customer_id = $id;
        $start_date  = date("Y-m-d H:i:s",strtotime($start_date ."00:00:0"));
        $end_date  =  date("Y-m-d H:i:s",strtotime($end_date ."23:59:0"));
        $where_orders = "customers.customer_id = $customer_id AND order_created_time BETWEEN '$start_date' AND '$end_date'";
        $where_quotations ="customers.customer_id= $customer_id AND quotation_created_time BETWEEN '$start_date' AND '$end_date'";

        $data_orders = $this->standard_model->get_join("orders.customer_id,`customer_first_name`,`customer_last_name`, `order_id`, `order_ref`,`order_total`, `order_ship_receiver_name`, `order_ship_receiver_phone`, `order_ship_province`, `order_ship_city`, `order_ship_district`, `order_ship_address`, `order_ship_postal_code`, `order_ship_note`, `order_ship_vendor`, `order_ship_package`, `order_ship_etd`, `order_ship_cost`, `order_ship_date`, `order_ship_resi`, `order_grand_total`, `order_points`, `order_status`, `order_created_time`, `order_last_changed_time`, `order_seen`","orders","customers","orders.customer_id= customers.customer_id", $where_orders, "order_id, order_status","DESC");

        $data_quotations =$this->standard_model->get_join("quotations.customer_id, `customer_first_name`,`customer_last_name`, quotation_id, quotation_created_time, quotation_title, quotation_category, quotation_description","quotations","customers","quotations.customer_id= customers.customer_id", $where_quotations, "quotation_id","DESC");

        // /$this->json->stringify($data_quotations);
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "pelanggan"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "Laporan Pelanggan",
                "menu_url" => "report/customer"
            ], true),
            "main" => $this->load->view("main/report_customer_detail", [
                "data_orders" => $data_orders,
                "data_quotations" => $data_quotations,
            ], true)
        ];
        $this->template->page($config);
    }

    public function sales () {
      $start_date =$this->input->post("start_date");
      $end_date =$this->input->post("end_date");
      $start_date  = str_replace('/', '-', $start_date );
      $end_date  = str_replace('/', '-', $end_date );
      $start_date  = date("Y-m-d H:i:s",strtotime($start_date ."00:00:0"));
      $end_date  =  date("Y-m-d H:i:s",strtotime($end_date ."23:59:0"));
      $where_orders = "order_created_time BETWEEN '$start_date' AND '$end_date'";
      $where_quotations ="quotation_created_time BETWEEN '$start_date' AND '$end_date'";

      $date =[
        "start_date" =>$start_date,
        "end_date"=> $end_date
      ];
      //$this->json->stringify($date);
      $data_orders = $this->standard_model->get_join("orders.customer_id,`customer_first_name`,`customer_last_name`, `order_id`, `order_ref`,`order_total`, `order_ship_receiver_name`, `order_ship_receiver_phone`, `order_ship_province`, `order_ship_city`, `order_ship_district`, `order_ship_address`, `order_ship_postal_code`, `order_ship_note`, `order_ship_vendor`, `order_ship_package`, `order_ship_etd`, `order_ship_cost`, `order_ship_date`, `order_ship_resi`, `order_grand_total`, `order_points`, `order_status`, `order_created_time`, `order_last_changed_time`, `order_seen`","orders","customers","orders.customer_id= customers.customer_id", $where_orders, "order_id, order_status","DESC");

      $data_quotations =$this->standard_model->get_join("quotations.customer_id, `customer_first_name`,`customer_last_name`, quotation_id, quotation_created_time, quotation_title, quotation_category, quotation_description","quotations","customers","quotations.customer_id= customers.customer_id", $where_quotations, "quotation_id","DESC");

      //$this->json->stringify($data_quotations);
      $config = [
          "sidebar" => $this->load->view("sidebar/sidebar", [
              "menu" => "penjualan"
          ], true),
          "header" => $this->load->view("header/header", [
              "menu" => "Laporan Penjualan",
              "menu_url" => "report/init/sales"
          ], true),
          "main" => $this->load->view("main/report_sales_view", [
              "data_orders" => $data_orders,
              "data_quotations" => $data_quotations,
              "date" => $date
          ], true)
      ];
      $this->template->page($config);
	}
}
