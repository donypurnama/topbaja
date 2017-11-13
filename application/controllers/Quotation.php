<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation extends CI_Controller {

    public $settings;

    function __construct () {
        parent::__construct();
        if (!$this->session->userdata("antglobal")) {
          $this->session->set_flashdata("front_login_redirect", "Maaf, Anda harus melakukan login untuk mengakses halaman penawaran/pembelian");
          redirect("login");
        }
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
          "active" => "",
          "customer" => $customer,
          "cart" => $count_item //to display items in cart

        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);

        $this->settings["title"] = "TOP BAJA: Besi & Baja Specialist";
    }

    public function index () {
      $data = [
        "customer_id" => "",
        "quotation_title" => "",
        "quotation_category" => "",
        "quotation_person_name" => "",
        "quotation_person_phone" => "",
        "quotation_person_email" => "",
        "quotation_company_name" => "",
        "quotation_description" => ""
      ];

      $this->settings["title"] = "Penawaran " . " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/quotation", [
        "data" => $data
      ], true);

      $this->template->page($this->settings);
    }

    public function request () {

      $data = [
        "customer_id" => $this->session->userdata("antglobal")["customer_id"],
        "quotation_title" => $this->input->post("quotation_title"),
        "quotation_category" => $this->input->post("quotation_category"),
        "quotation_person_name" => $this->input->post("quotation_person_name"),
        "quotation_person_phone" => $this->input->post("quotation_person_phone"),
        "quotation_person_email" => $this->input->post("quotation_person_email"),
        "quotation_company_name" => $this->input->post("quotation_company_name"),
        "quotation_description" => $this->input->post("quotation_description")
      ];

      //$this->form_validation->set_rules('title', 'Customer ID', 'required');
      $this->form_validation->set_rules('quotation_category', 'Kategori', 'trim|required|alpha');
      $this->form_validation->set_rules('quotation_title', 'Judul', 'trim|required');
      $this->form_validation->set_rules('quotation_person_name', 'Nama Pemesan', 'trim|required');
      $this->form_validation->set_rules('quotation_person_phone', 'Nomor Telepon', 'trim|required|numeric');
      $this->form_validation->set_rules('quotation_person_email', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('quotation_company_name', 'Nama Perusahaan', 'trim');
      $this->form_validation->set_rules('quotation_description', 'Deskripsi', 'trim|required');
      $this->form_validation->set_message('alpha', '%s hanya boleh terdiri dari kombinasi huruf');
      $this->form_validation->set_message('numeric', '%s hanya boleh terdiri dari kombinasi angka');
      $this->form_validation->set_message('required', '%s harus diisi');


      if ($this->form_validation->run() == FALSE) {

        $this->settings["main"] = $this->load->view("main/quotation", [
          "data" => $data
        ], true);

        $this->template->page($this->settings);
      } else {
        $this->standard_model->insert($data, "quotations");
        $this->settings["main"] = $this->load->view("main/quotation_success", [
          "data" => $data
        ], true);

        $this->template->page($this->settings);
      }
    }

}
