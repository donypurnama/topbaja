<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
          "active" => "contact",
          "cart" => $count_item //to display items in cart
        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);

        $this->settings["title"] = "TOP BAJA: Besi & Baja Specialist";
    }

    public function index () {

        $data = [
            "contact_id"            => "",
            "contact_title"         => "",
            "contact_person_name"   => "",
            "contact_person_phone"  => "",
            "contact_person_email"  => "",
            "contact_company_name"  => "",
            "contact_description"   => ""
        ];

        $this->settings["title"] = "Kontak Kami " . " - TOP BAJA";
        $this->settings["main"] = $this->load->view("main/contact", [
          "data" => $data
        ], true);
        $this->template->page($this->settings);
	}

  public function request () {

    $data = [
      "contact_title" => $this->input->post("contact_title"),
      "contact_person_name" => $this->input->post("contact_person_name"),
      "contact_person_phone" => $this->input->post("contact_person_phone"),
      "contact_person_email" => $this->input->post("contact_person_email"),
      "contact_company_name" => $this->input->post("contact_company_name"),
      "contact_description" => $this->input->post("contact_description")
    ];

    //$this->form_validation->set_rules('title', 'Customer ID', 'required');
    $this->form_validation->set_rules('contact_title', 'Judul', 'trim|required');
    $this->form_validation->set_rules('contact_person_name', 'Nama Pemesan', 'trim|required');
    $this->form_validation->set_rules('contact_person_phone', 'Nomor Telepon', 'trim|required|numeric');
    $this->form_validation->set_rules('contact_person_email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('contact_company_name', 'Nama Perusahaan', 'trim');
    $this->form_validation->set_rules('contact_description', 'Deskripsi', 'trim|required');
    $this->form_validation->set_message('alpha', '%s hanya boleh terdiri dari kombinasi huruf');
    $this->form_validation->set_message('numeric', '%s hanya boleh terdiri dari kombinasi angka');
    $this->form_validation->set_message('required', '%s harus diisi');


    if ($this->form_validation->run() == FALSE) {

      $this->settings["main"] = $this->load->view("main/contact", [
        "data" => $data
      ], true);

      $this->template->page($this->settings);

    } else {
      $this->standard_model->insert($data, "contacts");
      $this->settings["main"] = $this->load->view("main/contact_success", [
        "data" => $data
      ], true);

      $this->template->page($this->settings);
    }
  }

}
