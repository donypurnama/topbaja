<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public $settings;

    function __construct () {
        parent::__construct();
        //if there's no active antglobal user session, redirect to home
        $customer = [];
        if (!$this->session->userdata("antglobal") || !$this->session->userdata("antglobal")["customer_id"]) redirect("home");

        $this->load->model("standard_model");
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
          "active" => "home",
          "customer" => $customer,
          "cart" => $count_item //to display items in cart
        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);
    }

    public function profile () {
      $this->settings["title"] = "Profil Pengguna - TOP BAJA";
      $customer = $this->standard_model->find("customer_first_name, customer_last_name, customer_email_address, customer_phone, customer_company_name, customer_passcode", [
        "customer_id" => $this->session->userdata("antglobal")["customer_id"],
        "customer_status" => 1
      ], "customers");

      $this->settings["main"] = $this->load->view("main/account_profile", [
        "menu" => [
          "order" => "",
          "wishlist" => "",
          "account" => "active"
        ],
        "err" => [
          "update_bio_error" => null,
          "update_password_error" => null
        ],
        "customer" => $customer
      ], true);

      $this->template->page($this->settings);
    }

    public function wishlist () {
      $this->settings["title"] = "Wishlist - TOP BAJA";
      $this->settings["main"] = $this->load->view("main/wishlist", [], true);

      $this->template->page($this->settings);
    }

    public function order ($order_ref = null) {
      if ($order_ref) {
        $this->settings["title"] = "Detail {$order_ref} - TOP BAJA";

        $order = $this->standard_model->find("*", [
          "order_ref" => $order_ref,
          "customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ], "orders");

        if (!$order) redirect("account/order");
        $order["order_status_text"] = "";
        if ($order["order_status"] == 0) {
          $order["order_status_text"] = "Menunggu pembayaran";
        } else if ($order["order_status"] == 1) {
          $order["order_status_text"] = "Verifikasi Pembayaran";
        } else if ($order["order_status"] == 2) {
          $order["order_status_text"] = "Dalam proses";
        } else if ($order["order_status"] == 3) {
          $order["order_status_text"] = "Sudah dikirim";
        } else if ($order["order_status"] == 4) {
          $order["order_status_text"] = "Dibatalkan";
        }

        if (!$order) redirect("account/order", "refresh");
        $orders = $this->standard_model->get_join("order_details.product_qty, order_details.product_price, order_details.product_discount, order_details.order_subtotal, products.product_primary_image, products.product_name,
        products.product_url", "order_details", "products", "order_details.product_id = products.product_id", [
          "order_details.order_id" => $order["order_id"]
        ], "order_details.order_detail_id");

        $bank = $this->standard_model->find("bank_name, bank_account, bank_account_number, bank_image", [
          "bank_id" => $order["bank_id"]
        ], "banks");

        $this->settings["main"] = $this->load->view("main/order_detail", [
          "order" => $order,
          "order_detail" => $orders,
          "bank" => $bank
        ], true);
      }
      else {
        $this->settings["title"] = "Pembelian - TOP BAJA";
        $orders = $this->standard_model->get("order_ref, order_created_time, order_grand_total, order_status", [
          "customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ], "orders", "order_created_time", "DESC");

        foreach ($orders as $key=>&$value) {
          $value["order_status_text"] = "";
          $value["order_status_class"] = "";
          if ($value["order_status"] == 0) {
            $value["order_status_text"] = "Menunggu pembayaran";
            $value["order_status_class"] = "label-info";
          } else if ($value["order_status"] == 1) {
            $value["order_status_text"] = "Verifikasi Pembayaran";
            $value["order_status_class"] = "label-primary";
          } else if ($value["order_status"] == 2) {
            $value["order_status_text"] = "Dalam proses";
            $value["order_status_class"] = "label-warning";
          } else if ($value["order_status"] == 3) {
            $value["order_status_text"] = "Sudah dikirim";
            $value["order_status_class"] = "label-success";
          } else if ($value["order_status"] == 4) {
            $value["order_status_text"] = "Dibatalkan";
            $value["order_status_class"] = "label-danger";
          }
        }

        $this->settings["main"] = $this->load->view("main/order", [
          "orders" => $orders
        ], true);
      }

      $this->template->page($this->settings);
    }

    public function cancelOrder($order_ref = null) {
      if ($order_ref && $this->session->userdata("antglobal")) {
        if ($this->standard_model->update([
          "order_status" => 4
        ], "orders", [
          "order_status" => 0,
          "customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ])) {

          $order = $this->standard_model->find("order_used_point", [
            "customer_id" => $this->session->userdata("antglobal")["customer_id"],
            "order_status" => 4,
            "order_ref" => $order_ref
          ], "orders");

          $cust = $this->standard_model->find("customer_point", [
            "customer_id" => $this->session->userdata("antglobal")["customer_id"]
          ], "customers");

          if ($order && $cust) {
            if($this->standard_model->update([
              "customer_point" => $order["order_used_point"] + $cust["customer_point"]
            ], "customers", [
              "customer_id" => $this->session->userdata("antglobal")["customer_id"]
            ])) {
              $this->session->set_flashdata("order_remove", "Pemesanan berhasil dibatalkan");
            } else {
                $this->session->set_flashdata("order_remove", "Pemesanan gagal dibatalkan, silahkan coba kembali");
            }
          } else {
            $this->session->set_flashdata("order_remove", "Pemesanan gagal dibatalkan, silahkan coba kembali");
          }
        } else $this->session->set_flashdata("order_remove", "Pemesanan gagal dibatalkan, silahkan coba kembali");
      } else $this->session->set_flashdata("order_remove", "Pemesanan gagal dibatalkan, silahkan coba kembali");

      redirect("account/order", "refresh");
    }

    public function verification($order_ref = null) {
      $this->settings["title"] = "Verifikasi Pembayaran {$order_ref} - TOP BAJA";

      $order = $this->standard_model->find("*", [
        "order_ref" => $order_ref,
        "order_status <=" => 1,
        "customer_id" => $this->session->userdata("antglobal")["customer_id"]
      ], "orders");

      if (!$order) redirect("account/order");
      $bank = $this->standard_model->find("bank_name, bank_account, bank_account_number, bank_image", [
        "bank_id" => $order["bank_id"]
      ], "banks");

      $order["order_status_text"] = "";
      if ($order["order_status"] == 0) {
        $order["order_status_text"] = "Menunggu pembayaran";
      } else if ($order["order_status"] == 1) {
        $order["order_status_text"] = "Verifikasi Pembayaran";
      } else if ($order["order_status"] == 2) {
        $order["order_status_text"] = "Dalam proses";
      } else if ($order["order_status"] == 3) {
        $order["order_status_text"] = "Sudah dikirim";
      } else if ($order["order_status"] == 4) {
        $order["order_status_text"] = "Dibatalkan";
      }

      if (!$order) redirect("account/order", "refresh");

      $this->settings["main"] = $this->load->view("main/order_verification", [
        "order" => $order,
        "bank" => $bank
      ], true);

      $this->template->page($this->settings);
    }

    public function insert_verification() {
      $this->form_validation->set_rules("order_ref", "Transaction Code", "required");
      $this->form_validation->set_rules('order_verification_sender_bank', 'Bank', 'required');
      $this->form_validation->set_rules('order_verification_sender_name', 'Nama Pemilik Rekening', 'required');
      $this->form_validation->set_rules('order_verification_sender_bank_account', 'Nomor Rekening', 'required');
      $this->form_validation->set_rules('order_verification_total', 'Total Transfer', 'required');

      $this->form_validation->set_message('required', '%s harus diisi');

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata("verification_error", validation_errors());
        if ($this->input->post("order_ref")) {
          redirect("account/verification/".$this->input->post("order_ref"));
        } else redirect("account/order");
      } else {
        if ($this->standard_model->find("order_ref", [
          "order_ref" => $this->input->post("order_ref"),
          "order_status <=" => 1,
          "customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ], "orders")) {
          $data = [
            "order_verification_sender_bank" => $this->input->post("order_verification_sender_bank"),
            "order_verification_sender_name" => $this->input->post("order_verification_sender_name"),
            "order_verification_sender_bank_account" => $this->input->post("order_verification_sender_bank_account"),
            "order_verification_total" => $this->input->post("order_verification_total"),
            "order_status" => 1
          ];
          if($this->standard_model->update($data, "orders", [
            "order_ref" => $this->input->post("order_ref")
          ])) {
            //success
            $this->session->set_flashdata("verification_success", "Update verifikasi pembayaran berhasil. Silahkan tunggu proses pengecekan oleh team kami.");
            redirect("account/verification/".$this->input->post("order_ref"));
          } else {
            //failed
            $this->session->set_flashdata("verification_error", "Maaf terjadi kesalahan, silahkan ulangi kembali.");
            redirect("account/verification/".$this->input->post("order_ref"));
          }
        } else {
          redirect("account/verification/".$this->input->post("order_ref"));
        }
      }
    }

    public function logout () {
      $this->session->unset_userdata("antglobal");
      $this->session->unset_userdata("antglobal_cart");
      $this->session->sess_destroy();
      redirect("home", "refresh");
    }

    public function checkPassword () {
      $pass = $this->input->post("customer_old_passcode");
      $cust = $this->standard_model->find("customer_id, customer_passcode", [
        "customer_id" => $this->session->userdata("antglobal")["customer_id"],
        "customer_status" => 1
      ], "customers");

      if ($cust) {
        if ($this->encryption->decrypt($cust["customer_passcode"]) === $pass) {
          return true;
        }
      }

      $this->form_validation->set_message('checkPassword', 'Password salah');
      return false;
    }

    public function update_password() {
      $data = [
        "customer_old_passcode" => ($this->input->post("customer_old_passcode")) ? $this->input->post("customer_old_passcode", true) : "",
        "customer_passcode" => ($this->input->post("customer_passcode")) ? $this->input->post("customer_passcode", true) : "",
        "customer_passconf" => ($this->input->post("customer_passconf")) ? $this->input->post("customer_passconf", true) : ""
      ];

      $this->form_validation->set_rules('customer_old_passcode', 'Password', 'required|callback_checkPassword');
      $this->form_validation->set_rules('customer_passcode', 'Password baru', 'required');
      $this->form_validation->set_rules('customer_passconf', 'Verifikasi Password baru', 'required|matches[customer_passcode]');
      $this->form_validation->set_message('matches', 'Verifikasi Password baru tidak sesuai');
      $this->form_validation->set_message('required', '%s harus diisi');

      $pass_err = null;

      if ($this->form_validation->run() == FALSE) {
        $pass_err = validation_errors();
      } else {
        //if true
        if($this->standard_model->update([
          "customer_passcode" => $this->encryption->encrypt($data["customer_passcode"])
        ], "customers", [
          "customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ])) {
          //when update success
          $bio_err = null;
          $this->session->set_flashdata("update_pass", "Password berhasil dirubah");
          redirect("account/profile");
        } else {
          //when update fails
          $bio_err = null;
          $this->session->set_flashdata("update_pass", "Terjadi kesalahan, password gagal dirubah");
        }
      }

      //to fill the biodata section
      $customer = $this->standard_model->find("customer_first_name, customer_last_name, customer_email_address, customer_phone, customer_company_name, customer_passcode", [
        "customer_id" => $this->session->userdata("antglobal")["customer_id"],
        "customer_status" => 1
      ], "customers");

      $this->settings["main"] = $this->load->view("main/account_profile", [
        "data" => $data,
        "customer" => $customer,
        "err" => [
          "update_bio_error" => null,
          "update_password_error" => $pass_err
        ],
        "menu" => [
          "order" => "",
          "wishlist" => "",
          "account" => "active"
        ]
      ], true);
      $this->template->page($this->settings);
    }

    public function update_bio() {
      $data = [
        "customer_first_name" => ($this->input->post("customer_first_name")) ? $this->input->post("customer_first_name") : "",
        "customer_last_name" => ($this->input->post("customer_last_name")) ? $this->input->post("customer_last_name") : "",
        "customer_phone" => ($this->input->post("customer_phone")) ? $this->input->post("customer_phone") : "",
        "customer_company_name" => ($this->input->post("customer_company_name")) ? $this->input->post("customer_company_name") : ""
      ];

      $this->form_validation->set_rules('customer_first_name', 'Nama Depan', 'trim|required');
      $this->form_validation->set_rules('customer_last_name', 'Nama Belakang', 'trim|required');
      $this->form_validation->set_rules('customer_phone', 'Nomor Hp', 'trim|required|numeric');
      $this->form_validation->set_rules('customer_company_name', 'Nama Perusahaan', 'trim');
      $this->form_validation->set_message('numeric', '%s hanya boleh terdiri dari kombinasi angka');
      $this->form_validation->set_message('required', '%s harus diisi');

      $bio_err = null;

      if ($this->form_validation->run() == FALSE) {
        $bio_err = validation_errors();
      } else {
        //if true
        if($this->standard_model->update($data, "customers", [
          "customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ])) {
          //when update success
          $bio_err = null;
          $this->session->set_flashdata("update_bio", "Biodata berhasil disimpan");
          redirect("account/profile");
        } else {
          //when update fails
          $bio_err = null;
          $this->session->set_flashdata("update_bio", "Terjadi kesalahan, gagal menyimpan.");
        }
      }
      $data["customer_email_address"] = ($this->input->post("customer_email_address")) ? $this->input->post("customer_email_address") : "";
      $this->settings["main"] = $this->load->view("main/account_profile", [
        "customer" => $data,
        "err" => [
          "update_bio_error" => $bio_err,
          "update_password_error" => null
        ],
        "menu" => [
          "order" => "",
          "wishlist" => "",
          "account" => "active"
        ]
      ], true);
      $this->template->page($this->settings);
    }

    public function verification_upload($order_ref = null) {
      //upload file
      if ($this->session->userdata("antglobal")["customer_id"] && $order_ref) {
        $file_name = "";
        $config['upload_path'] = realpath(APPPATH . "../file_assets/verification");
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
        $config['max_size'] = '3072'; //3 MB
        $file_name = $config['file_name'] = md5(microtime()).".png";
        $config["remove_spaces"] = TRUE;

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Terjadi kesalahan saat proses upload';
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'Gambar telah tersedia';
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                      //success upload
                      $prev = $this->standard_model->find("order_verification_photo", [
                        "order_ref" => urldecode($order_ref),
                        "customer_id" => $this->session->userdata("antglobal")["customer_id"]
                      ], "orders");

                      if ($this->standard_model->update([
                        "order_verification_photo" => $file_name
                      ], "orders", [
                        "order_ref" => urldecode($order_ref),
                        "customer_id" => $this->session->userdata("antglobal")["customer_id"]
                      ])) {
                        //success insert
                        //delete image
                        if ($prev["order_verification_photo"]) {
                          if (file_exists("file_assets/verification/".$prev["order_verification_photo"])) {
                            unlink("file_assets/verification/".$prev["order_verification_photo"]);
                          }
                        }

                        echo "success";
                      } else {
                        echo "Data tidak dapat di update";
                      }
                    }
                }
            }
        } else {
            echo 'Pilih file yang akan di upload';
        }
      }
    }
}
