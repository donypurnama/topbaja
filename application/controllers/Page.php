<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

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

    public function index () {

    }

    public function about () {
      $this->settings["title"] = "Tentang Kami " . " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/about", [
        "active" => "about",
      ], true);

      $this->template->page($this->settings);
    }

    public function _about_topbaja () {
      $this->settings["title"] = "Tentang Kami " . " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/about_topbaja", [], true);

      $this->template->page($this->settings);
    }

    public function _about_contractor () {
      $this->settings["title"] = "Tentang Kami " . " - CONTRACTOR";
      $this->settings["main"] = $this->load->view("main/about_contractor", [], true);

      $this->template->page($this->settings);
    }

    public function _contact () { // BELUM RAPI
        $data = [
          "contact_id" => "",
          "contact_title" => "",
          "contact_person_name" => "",
          "contact_person_phone" => "",
          "contact_person_email" => "",
          "contact_company_name" => "",
          "contact_description" => ""
        ];

        $this->settings["title"] = "Kontak Kami " . " - TOP BAJA";
        $this->settings["main"] = $this->load->view("main/contact", [
          "data" => $data
        ], true);

      $this->template->page($this->settings);
    }


    public function _request () {

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

    public function faq () {
      $faq = $this->standard_model->get("faq_id, faq_answer, faq_question", [], "faqs");

      $this->settings["title"] = "Pertanyaan Umum " . " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/faq", [
        "faq" => $faq
      ], true);

      $this->template->page($this->settings);
    }

    public function terms () {
      $this->settings["title"] = "Syarat dan Ketentuan " . " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/terms", [], true);
      $this->template->page($this->settings);
    }

    public function policy () {
      $this->settings["title"] = "Kebijakan Pengunjung " . " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/policy", [], true);
      $this->template->page($this->settings);
    }

}
