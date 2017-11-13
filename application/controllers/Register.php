<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public $settings;

    function __construct () {
        parent::__construct();
        if (($this->session->userdata("antglobal")) || ($this->session->userdata("antglobal")["customer_logged_in"])) redirect("home");

         $this->load->model("standard_model");

        //get header categories & types
        $categories = $this->standard_model->get("category_id, category_name, category_url, category_image", [], "categories");
        foreach ($categories as $key=>&$value) {
          $value["types"] = $this->standard_model->get("type_id, type_name, type_url", [
            "category_id" => $value["category_id"]
          ], "types");
        }

        $this->settings["header"] = $this->load->view("header/header", [
          "header_categories" => $categories,
          "active" => ""
        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);

        $this->settings["title"] = "TOP BAJA: Besi & Baja Specialist";
    }

    public function index () {
      $data = [
        "customer_first_name" => "",
        "customer_last_name" => "",
        "customer_gender" => "",
        "customer_phone" => "",
        "customer_company_name" => "",
        "customer_email_address" => "",
        "customer_passcode" => "",
        "customer_passconf" => ""
      ];

      $this->settings["title"] = "Register " . " - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/register", [
        "data" => $data
      ], true);
      $this->template->page($this->settings);
    }

    public function validate () {

      $data = [
        "customer_first_name" => ($this->input->post("customer_first_name")) ? $this->input->post("customer_first_name") : "",
        "customer_last_name" => ($this->input->post("customer_last_name")) ? $this->input->post("customer_last_name") : "",
        "customer_gender" => ($this->input->post("customer_gender")) ? $this->input->post("customer_gender") : "",
        "customer_phone" => ($this->input->post("customer_phone")) ? $this->input->post("customer_phone") : "",
        "customer_company_name" => ($this->input->post("customer_company_name")) ? $this->input->post("customer_company_name") : "",
        "customer_email_address" => ($this->input->post("customer_email_address")) ? $this->input->post("customer_email_address") : "",
        "customer_passcode" => ($this->input->post("customer_passcode")) ? $this->input->post("customer_passcode") : "",
        "customer_passconf" => ($this->input->post("customer_passconf")) ? $this->input->post("customer_passconf") : ""
      ];

      $this->form_validation->set_rules('customer_first_name', 'Nama Depan', 'trim|required');
      $this->form_validation->set_rules('customer_last_name', 'Nama Belakang', 'trim|required');
      $this->form_validation->set_rules('customer_email_address' ,'Email', 'trim|required|valid_email|is_unique[customers.customer_email_address]');
      $this->form_validation->set_rules('customer_phone', 'Nomor Hp', 'trim|required|numeric');
      $this->form_validation->set_rules('customer_gender', 'Jenis Kelamin', 'trim|required');
      $this->form_validation->set_rules('customer_company_name', 'Nama Perusahaan', 'trim');
      $this->form_validation->set_rules('customer_passcode', 'Password', 'required');
      $this->form_validation->set_rules('customer_passconf', 'Verifikasi Password', 'required|matches[customer_passcode]');
      $this->form_validation->set_message('is_unique', 'Email sudah terdaftar, silahkan gunakan email yang lain');
      $this->form_validation->set_message('alpha', '%s hanya boleh terdiri dari kombinasi huruf');
      $this->form_validation->set_message('numeric', '%s hanya boleh terdiri dari kombinasi angka');
      $this->form_validation->set_message('required', '%s harus diisi');
      $this->form_validation->set_message('matches', 'Verifikasi Password tidak sesuai');

      if ($this->form_validation->run() == FALSE)
      {
        $this->settings["main"] = $this->load->view("main/register", [
          "data" => $data
        ], true);
        $this->template->page($this->settings);
      }
      else
      {
        //check the registration form
        unset($data["customer_passconf"]);

        $data["customer_token"] = md5(uniqid($data["customer_email_address"], true));

        //sending email success
        if ($this->mail_verification($data["customer_token"], $data["customer_first_name"], $data["customer_email_address"])) {
          $data["customer_passcode"] = $this->encryption->encrypt($data["customer_passcode"]);
          $this->standard_model->insert($data, "customers");
          $this->settings["main"] = $this->load->view("main/register_success", [
            "data" => $data
          ], true);

        } else {
          //sending email failed
          $this->settings["main"] = $this->load->view("main/register_failed", null, true);
        }
        $this->template->page($this->settings);
      }
    }

    public function activate ($token) {
      if ($token) {
        if ($this->standard_model->update([
          "customer_status" => 1
        ], "customers", [
          "customer_token" => $token
          ])) {
            //set login
            $cust = $this->standard_model->find("customer_id, customer_email_address, customer_first_name, customer_last_name",[
              "customer_status" => 1,
              "customer_token" => $token
            ], "customers");

            if ($cust) {
              $sess_array = [
                "customer_id" => $cust["customer_id"],
                "customer_email_address" => $cust["customer_email_address"],
                "customer_first_name" => $cust["customer_first_name"],
                "customer_last_name" => $cust["customer_last_name"],
                "customer_logged_in" => true
              ];

              $this->session->set_userdata('topbaja', $sess_array);
              //redirect("home");
              // $this->json->stringify();
              //set session active
              // $_SESSION['customer_id'] = $cust["customer_id"];
		          // $_SESSION['customer_first_name'] = $cust["customer_first_name"];
		          // $_SESSION['customer_last_name'] = $cust["customer_last_name"];
              // $_SESSION['customer_logged_in'] = true;
              $this->settings["main"] = $this->load->view("main/activate_success", null, true);
              $this->template->page($this->settings);
            }
        }
      }
    }

    public function mail_verification($token = null, $name = null, $email = null) {
      $this->load->library('email');
      $home_url = base_url();
      $subject = 'Verifikasi Akun TopBaja.com';
      $message = $this->load->view("email/verification", [
        "data" => [
          "activate_url" => $home_url . "register/activate/$token",
          "activate_home_url" => $home_url,
          "activate_user_name" => $name
        ]
      ], true);

      // Also, for getting full html you may use the following internal method:
      //$body = $this->email->full_html($subject, $message);

      $result = $this->email
              ->from('tb.topbaja@gmail.com')
              ->reply_to('tb.topbaja@gmail.com')
              ->to($email)
              ->subject($subject)
              ->message($message)
              ->send();

      if ($result) {
        return true;
      } return false;
      // //var_dump($result);
      // echo '<br />';
      // echo $this->email->print_debugger();
      //
      // exit;
    }
}
