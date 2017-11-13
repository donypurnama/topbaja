<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

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

        //untuk beli sekarang
        if (!$this->session->userdata("antglobal") || $this->session->userdata("antglobal")["customer_logged_in"] === false) {
          $this->session->set_flashdata('front_login_cart', 'Maaf, Anda harus melakukan login terlebih dahulu sebelum Anda melakukan pembelian.');
          redirect("login");
        }

        //untuk isi cart
        if (($this->session->userdata("antglobal")) && $this->session->userdata("antglobal")["customer_logged_in"] === true) {
          //do this for the rest header except login and register
          $cart = $this->standard_model->find_join("sum(carts.product_qty) as count_item, products.product_courier as courier, products.product_free_courier_id as arr_free_courier",
                                                    "carts",
                                                    "products",
                                                    "carts.product_id = products.product_id", [
            "products.product_status" => 1,
            "carts.customer_id" => $this->session->userdata("antglobal")["customer_id"]
          ]);

          $exp_product_free_courier_id = explode(',', $cart['arr_free_courier']);

          if ($cart["count_item"] != null) $count_item = $cart["count_item"];
          $customer = $this->standard_model->find("customer_first_name, customer_point", [
            "customer_id" => $this->session->userdata("antglobal")["customer_id"]
          ], "customers");
        }

        $this->settings["header"] = $this->load->view("header/header", [
          "header_categories" => $categories,
          "active"            => "home",
          "customer"          => $customer,
          "cart"              => $count_item, //to display items in cart
          "cart_product_courier" => $cart['courier'],
          "exp_product_free_courier_id" => $exp_product_free_courier_id,
        ], true);
        $this->settings["footer"] = $this->load->view("footer/footer", [
          "footer_categories" => $categories
        ], true);


        $this->settings["title"] = "TOP BAJA: Besi & Baja Specialist";

        // print_r($cart['courier']);
        // die();
    }

    public function index () {

      $order_total = 0;
      $count_item = 0;
      $total_with_discount = 0;
      $cart = [];

      $cart_count = $this->standard_model->find_join("sum(carts.product_qty) as count_item", "carts", "products", "carts.product_id = products.product_id", [
        "products.product_status" => 1,
        "carts.customer_id" => $this->session->userdata("antglobal")["customer_id"]
      ]);

      if ($cart_count["count_item"] != null) $count_item = $cart_count["count_item"];

      //jika cart lebih dari 0
      if ($count_item > 0) {
        $cart = $this->standard_model->get_join("carts.product_id, carts.product_qty, products.product_primary_image, products.product_name,
        products.product_price, products.product_discount, products.product_url", "carts", "products", "carts.product_id = products.product_id", [
          "products.product_status" => 1,
          "carts.customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ], "carts.cart_id");

        if ($cart) {
            //foreach to get the order subtotal & total
            foreach ($cart as $key=>&$value) {
              $value["subtotal"] = $value["product_qty"] * ($value["product_price"] - ($value["product_price"] * $value["product_discount"] / 100));
              $order_total += $value["subtotal"];
            }
            //code goes here..
        }
      }
      $customer = $this->standard_model->find("customer_point", [
        "customer_id" => $this->session->userdata("antglobal")["customer_id"]
      ], "customers");

      //if customer using Point
      $used_point = 0;

      if ($this->input->post("used_point")) {
        //jika used_point lebih besar dari point yang ada, redirect cart
        if ($this->input->post("used_point") > $customer["customer_point"]) {
          $this->session->set_flashdata("front_add_cart_failed","Poin yang Anda masukkan tidak sesuai");
          redirect("cart");
        }

        $used_point = $this->input->post("used_point");
        $total_with_discount = $order_total - $used_point;
        $cashback_point = $total_with_discount * 0.01;
      } else {
        $cashback_point = $order_total * 0.01;
      }

      $customer_point = $customer["customer_point"] - $used_point;

      //checkout session
      $checkout = [
        "order_ref" => "",
        "customer_id" => $this->session->userdata("antglobal")["customer_id"],
        "order_total" => $total_with_discount,
        "order_ship_receiver_name" => "",
        "order_ship_receiver_phone" => "",
        "order_ship_province" => "",
        "order_ship_city" => "",
        "order_ship_district" => "",
        "order_ship_address" => "",
        "order_ship_postal_code" => "",
        "order_ship_note" => "",
        "order_ship_vendor" => "",
        "order_ship_package" => "",
        "order_ship_etd" => "",
        "order_ship_cost" => "",
        "order_grand_total" => "",
        "order_points" => $cashback_point,
        "customer_point" => $customer_point,
        "order_used_point" => $used_point,
      ];

      $weight_count = $this->standard_model->find_join("sum(products.product_weight) as grams", "carts", "products", "carts.product_id = products.product_id", [
        "products.product_status" => 1,
        "carts.customer_id" => $this->session->userdata("antglobal")["customer_id"]
      ]);


      $ant_cart  = [
        "step" => 0,
        "order_weight" => $weight_count["grams"],
        "checkout_detail" => $checkout
      ];

      $this->session->set_userdata("antglobal_cart", $ant_cart);

      //end checkout session
      if ($count_item <= 0){
        $this->settings["title"] = "There is no Item in Shopping Cart" ." - TOP BAJA";
      } else {
        $this->settings["title"] = "Add Item to Shopping Cart" ." - TOP BAJA";
      }

      $this->settings["main"] = $this->load->view("main/cart", [
        "cart" => $cart,
        "cart_count" => $cart_count,
        "total" => $order_total,
        "customer_point" => $customer_point,
        "used_point" => $used_point,
        "total_with_discount" => $total_with_discount,
        "cashback_point" => $cashback_point
      ], true);

      $this->template->page($this->settings);
    }

    public function checkout() {
      if (!$this->session->userdata("antglobal_cart")) redirect("cart");
      $province = $this->get_province();
      if (!$province) {
        $this->session->set_flashdata("front_add_cart_failed","Mohon maaf, pengecekan ongkos kirim saat ini sedang dalam masalah. Silahkan kembali lagi.");
        redirect("cart");
      }

      $this->settings["main"] = $this->load->view("main/checkout_delivery", [
        "province" => $province
      ], true);

      $this->template->page($this->settings);
    }

    public function review() {

      // echo 'reeiie';
      // die();

      //review order
      $this->form_validation->set_rules("order_ship_receiver_name", "Nama Penerima", "trim|required");
      $this->form_validation->set_rules("order_ship_receiver_phone", "Nomor HP Penerima", "trim|required");

      // $this->form_validation->set_rules("order_ship_province", "Provinsi", "trim|required");
      // $this->form_validation->set_rules("order_ship_city", "Kab/Kota", "trim|required");
      // $this->form_validation->set_rules("order_ship_district", "Kecamatan", "trim|required");
      // $this->form_validation->set_rules("order_ship_vendor", "Kurir", "trim|required");
      // $this->form_validation->set_rules("order_ship_package", "Paket Pengiriman", "trim|required");
      // $this->form_validation->set_rules("order_ship_etd", "Lama Pengiriman", "trim|required");
      // $this->form_validation->set_rules("order_ship_cost", "Biaya Pengiriman", "trim|required");

      $this->form_validation->set_rules("order_ship_address", "Alamat Pengiriman", "trim|required");
      $this->form_validation->set_rules("order_ship_postal_code", "Kode Pos", "trim|required");
      $this->form_validation->set_rules("order_ship_note", "Catatan Pengiriman", "trim");

      if ($this->form_validation->run() != FALSE)
      {
        $sess = $this->session->userdata("antglobal_cart");
        if (!$sess) redirect("cart/checkout");
        $sess["checkout_detail"]["order_ship_receiver_name"] = $this->input->post("order_ship_receiver_name");
        $sess["checkout_detail"]["order_ship_receiver_phone"] = $this->input->post("order_ship_receiver_phone");
        $sess["checkout_detail"]["order_ship_province"] = $this->input->post("order_ship_province");
        $sess["checkout_detail"]["order_ship_city"] = $this->input->post("order_ship_city");
        $sess["checkout_detail"]["order_ship_district"] = $this->input->post("order_ship_district");
        $sess["checkout_detail"]["order_ship_vendor"] = $this->input->post("order_ship_vendor");
        $sess["checkout_detail"]["order_ship_package"] = $this->input->post("order_ship_package");
        $sess["checkout_detail"]["order_ship_etd"] = $this->input->post("order_ship_etd");
        $sess["checkout_detail"]["order_ship_cost"] = $this->input->post("order_ship_cost");
        $sess["checkout_detail"]["order_ship_address"] = $this->input->post("order_ship_address");
        $sess["checkout_detail"]["order_ship_postal_code"] = $this->input->post("order_ship_postal_code");
        $sess["checkout_detail"]["order_ship_note"] = $this->input->post("order_ship_note");
        $sess["step"] = 1;

        $cart = $this->standard_model->get_join("carts.product_id, carts.product_qty,
                                                  products.product_primary_image, products.product_name,
                                                  products.product_price, products.product_courier, products.product_free_courier_id,
                                                  products.product_discount, products.product_url",
        "carts", "products",
        "carts.product_id = products.product_id", [
          "products.product_status" => 1,
          "carts.customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ], "carts.cart_id");

        $order_total = 0;

        
        if ($cart) {
            //foreach to get the order subtotal & total
            foreach ($cart as $key=>&$value) {
              $value["subtotal"] = $value["product_qty"] * ($value["product_price"] - ($value["product_price"] * $value["product_discount"] / 100));
              $order_total += $value["subtotal"];
            }
        }
        $sess["checkout_detail"]["order_total"] = $order_total;
        $sess["checkout_detail"]["order_grand_total"] = $order_total - $sess["checkout_detail"]["order_used_point"] + $sess["checkout_detail"]["order_ship_cost"];
        $this->session->unset_userdata("antglobal_cart");
        $this->session->set_userdata("antglobal_cart", $sess);
        //  $this->json->stringify($this->session->userdata("antglobal_cart"));
        $total_with_discount = $order_total - $this->session->userdata("antglobal_cart")["checkout_detail"]["order_used_point"];

        $this->settings["main"] = $this->load->view("main/checkout_review", [
          "data" => $this->session->userdata("antglobal_cart"),
          "cart" => $cart,
          "total" => $order_total,
          "used_point" => $this->session->userdata("antglobal_cart")["checkout_detail"]["order_used_point"],
          "total_with_discount" => $total_with_discount,
          "cashback_point" => $total_with_discount * 0.01,
          "bank" => $this->standard_model->get("bank_id, bank_name, bank_image, bank_account, bank_account_number", null, "banks")
        ], true);

        $this->template->page($this->settings);
      } else {
        redirect("cart/checkout");
      }
    }

    public function test() {
      $this->load->library("rajaongkir");
      $param = $this->rajaongkir->test();
      $param = json_decode($param, true);

      $this->json->stringify($param);

    }

    public function process() {
      $s = $this->session->userdata("antglobal_cart");
      $param = [];
      if (!empty($s) && $this->input->post("bank")) {
        $sess = $this->session->userdata("antglobal_cart")["checkout_detail"];

        $sess["order_ship_weight"] = $this->session->userdata("antglobal_cart")["order_weight"];
        $sess["bank_id"] = $this->input->post("bank");
        $insert_key = [
          "customer_id" => "",
          "bank_id" => "",
          "order_total" => "",
          "order_ship_receiver_name" => "",
          "order_ship_receiver_phone" => "",
          "order_ship_province" => "",
          "order_ship_city" => "",
          "order_ship_district" => "",
          "order_ship_address" => "",
          "order_ship_postal_code" => "",
          "order_ship_note" => "",
          "order_ship_vendor" => "",
          "order_ship_package" => "",
          "order_ship_weight" => "",
          "order_ship_etd" => "",
          "order_ship_cost" => "",
          "order_grand_total" => "",
          "order_points" => "",
          "order_used_point" => ""
        ];

         $result = array_intersect_key($sess, $insert_key);

        //insert the order header and get its ID
        $id = $this->standard_model->insert($result, "orders");

        if ($id) {
          $num_str = sprintf("%04d", mt_rand(1, 999));
          $order_ref = "ANT-" . $this->roman_number(date("y")) . "-" . $this->roman_number(date("n")) . "-" . $num_str . $id;

          //generate order reference
          if ($this->standard_model->update([
            "order_ref" => $order_ref
          ], "orders", [
            "order_id" => $id
          ]) == false) {
            $this->session->set_flashdata("front_add_cart_failed","Mohon maaf, terjadi kesalahan. Silahkan mengulang kembali proses transaksi Anda.");
            redirect("cart", "refresh");
          }

          $cart = $this->standard_model->get_join("carts.product_id, carts.product_qty,
          products.product_price, products.product_discount", "carts", "products", "carts.product_id = products.product_id", [
            "products.product_status" => 1,
            "carts.customer_id" => $this->session->userdata("antglobal")["customer_id"]
          ], "carts.cart_id");

          // $this->json->stringify($cart);
          foreach ($cart as $key=>&$value) {
            $param[] = $value["product_id"];
            $value["order_id"] = $id;
            $value["order_subtotal"] = $value["product_price"] - ($value["product_price"] * $value["product_discount"] / 100);
          }

          //move cart to order_details
          if ($this->standard_model->insert_batch($cart, "order_details")) {
            $customer = $this->standard_model->find("customer_point", [
              "customer_id" => $this->session->userdata("antglobal")["customer_id"]
            ], "customers");
            if($customer) {
              $new_point = $customer["customer_point"] - $sess["order_used_point"];
              //update point
              if($this->standard_model->update([
                "customer_point" => $new_point
              ], "customers", [
                "customer_id" => $this->session->userdata("antglobal")["customer_id"]
              ])){

                //delete after success MASIH PROBLEM
                if ($this->standard_model->delete_multiple("product_id", [
                  "customer_id" => $this->session->userdata("antglobal")["customer_id"]
                ], $param, "carts")) {
                  redirect("cart/success/".$order_ref, "refresh");
                } else {
                  redirect("cart", "refresh");
                }
              } else {
                $this->session->set_flashdata("front_add_cart_failed","Mohon maaf, terjadi kesalahan. Silahkan mengulang kembali proses transaksi Anda.");
                redirect("cart", "refresh");
              }
            } else {
              $this->session->set_flashdata("front_add_cart_failed","Mohon maaf, terjadi kesalahan. Silahkan mengulang kembali proses transaksi Anda.");
              redirect("cart", "refresh");
            }
          }

          $this->session->set_flashdata("front_add_cart_failed","Mohon maaf, terjadi kesalahan. Silahkan mengulang kembali proses transaksi Anda.");
          redirect("cart", "refresh");
        }
      }
      redirect("cart", "refresh");
    }

    public function success($order_ref = null) {
      if ($this->session->userdata("antglobal")) {
        $this->load->library('email');

        $order = $this->standard_model->find_double_join("orders.order_id, orders.order_ref, orders.customer_id, orders.order_total, orders.order_grand_total, orders.order_created_time, orders.order_ship_cost, orders.order_ship_receiver_name,
        orders.order_ship_receiver_phone, orders.order_ship_address, orders.order_ship_province, orders.order_ship_district, orders.order_ship_city, orders.order_ship_postal_code,
        orders.order_ship_vendor, orders.order_ship_package, orders.order_verification_sender_name, banks.bank_id, banks.bank_name, banks.bank_account, banks.bank_account_number, banks.bank_image, customers.customer_email_address",
        "orders", "banks", "customers", "orders.bank_id = banks.bank_id", "orders.customer_id = customers.customer_id", [
            "orders.order_ref" => $order_ref,
            "orders.customer_id" => $this->session->userdata("antglobal")["customer_id"],
            "orders.order_status" => 0
        ]);

        if (!$order) redirect("cart", "refresh");

        $products = $this->standard_model->get_join("order_details.order_id, order_details.product_id, order_details.product_qty, order_details.product_price, order_details.product_discount,
        products.product_id, products.product_name",
        "order_details", "products", "order_details.product_id = products.product_id", [
          "order_details.order_id" => $order["order_id"]
        ]);

        //$this->json->stringify($products);
        $subject = 'Pembelian dari TOP BAJA';
        $message = $this->load->view("email/order", [
          "order" => $order,
          "products" => $products
        ], true);

        // Also, for getting full html you may use the following internal method:
        //$body = $this->email->full_html($subject, $message);

        $email = $order["customer_email_address"];
        $result = $this->email
                ->from('support@topbaja.com')
                ->reply_to('support@integreate.id')
                ->to($email)
                ->subject($subject)
                ->message($message)
                ->send();

        if ($result) {
          if ($this->session->userdata("antglobal_cart")) $this->session->unset_userdata("antglobal_cart");
          $this->settings["main"] = $this->load->view("main/checkout_success", [
            "order" => $order
          ], true);
          $this->template->page($this->settings);
        } else {
          $this->session->set_flashdata("front_add_cart_failed","Maaf, terjadi kesalahan silahkan ulangi proses pembelian.");
          redirect("cart", "refresh");
        }
      } else echo "aaa";
    }

    public function add ($product_url) {
      //cek kalo user tsb udah login dan ga mungkin ga ada customer_id nya
      $qty = null;
      if ($this->session->userdata("antglobal")["customer_logged_in"] === true && $this->session->userdata("antglobal")["customer_id"]) {
        if ($this->input->post("product_qty")) {
          $qty = $this->input->post("product_qty");
        }
        //cari produk dari produk url, dan status nya aktif, dan di cart milik customer id
        $exist = $this->standard_model->find_join("carts.product_id, products.product_name", "carts", "products", "carts.product_id = products.product_id", [
          "products.product_status" => 1,
          "products.product_url" => $product_url,
          "carts.customer_id" => $this->session->userdata("antglobal")["customer_id"]
        ]);

        //jika produk sudah tersedia di cart, maka tambahkan qty
        if ($exist) {
          if ($this->standard_model->update_count("product_qty", "carts", [
            "customer_id" => $this->session->userdata("antglobal")["customer_id"],
            "product_id" => $exist["product_id"]
          ], $qty)) {
            //jika qty berhasil ditambahkan
            $this->session->set_flashdata("front_add_cart_success","{$exist['product_name']} berhasil ditambahkan ke keranjang");
            if ($qty) $this->session->set_flashdata("front_add_cart_success","Jumlah {$exist['product_name']} berhasil diubah");
          } else {
            //jika qty tidak berhasil ditambahkan
            $this->session->set_flashdata("front_add_cart_failed","Gagal menambahkan {$exist['product_name']} ke keranjang");
          }
        } else { //jika produk belum ada di cart

          //dapetin ID produk
          $product = $this->standard_model->find("product_id, product_name", [
            "product_status" => 1,
            "product_url" => $product_url
          ], "products");
          if ($product) {
              //setelah dapat produk id, insert ke cart
              if ($this->standard_model->insert([
                "product_id" => $product["product_id"],
                "customer_id" => $this->session->userdata("antglobal")["customer_id"],
                "product_qty" => 1
              ], "carts")) {
                //jika insert berhasil
                $this->session->set_flashdata("front_add_cart_success","{$product['product_name']} berhasil dimasukkan ke keranjang");
              } else {
                //jika insert gagal
                $this->session->set_flashdata("front_add_cart_failed","{$product['product_name']} gagal dimasukkan ke keranjang");
              }
          } else {
            //jika produk tidak ditemukan di keranjang, dan tidak terdapat
            $this->session->set_flashdata("front_add_cart_failed","{$product['product_name']} gagal dimasukkan ke keranjang");
          }
        }
        //in the end semuanya redirect ke cart
        redirect("cart");
      } else {
        //jika tidak login tapi maksa add to cart
        $this->session->set_flashdata("front_login_cart", "Maaf, Anda harus login untuk menambahkan barang ke keranjang belanja.");
        redirect("login");
      }
    }

    public function delete ($product_url) {

      $product = $this->standard_model->find("product_id, product_name", [
        "product_url" => $product_url
      ], "products");

      $where = [
        "product_id" => $product["product_id"]
      ];

      if ($this->standard_model->delete($where, "carts")) {
        $this->session->set_flashdata("front_add_cart_success","{$product['product_name']} berhasil dihapus dari keranjang");
      } else {
        $this->session->set_flashdata("front_add_cart_failed","{$product['product_name']} gagal dihapus dari keranjang");
      }

      redirect("cart");
    }

    public function get_province(){
      $this->load->library("rajaongkir");
      $result = $this->rajaongkir->getProvince();
      $json = json_decode($result, true);

      if (isset($json["rajaongkir"]["results"])) {
        return $json["rajaongkir"]["results"];
      }
      return false;
//      echo ($province);
    }

    public function get_city($province = null) {
      if ($province) {
        $this->load->library("rajaongkir");
        $result = $this->rajaongkir->getCity((int)$province);
        $json = json_decode($result, true);

        $this->json->stringify($json);
      }
    }

    public function get_subdistrict($city = null) {
      if ($city) {
        $this->load->library("rajaongkir");
        $result = $this->rajaongkir->getSubDistrict((int)$city);
        $json = json_decode($result, true);

        $this->json->stringify($json);
      }
    }

    public function get_ongkir($destinationCode = null){
      if ($destinationCode) {
        if ($this->session->userdata("antglobal_cart")){
          $this->load->library("rajaongkir");
          $result = $this->rajaongkir->getOngkir($destinationCode, "city", (int)$this->session->userdata("antglobal_cart")["order_weight"]);
          $json = json_decode($result, true);
          if ($json) {
            foreach ($json["rajaongkir"]["results"] as $key=>&$value) {
              foreach ($value["costs"] as $key2=>&$value2) {
                $value2["cost"][0]["cost_value"] = number_format($value2["cost"][0]["value"],0,',','.');
              }
            }
          }
          $this->json->stringify($json);
        }
      }
    }

    function roman_number($decimalInteger) {
      $n = intval($decimalInteger);
      $res = '';

      $roman_numerals = [
        'M'  => 1000,
        'CM' => 900,
        'D'  => 500,
        'CD' => 400,
        'C'  => 100,
        'XC' => 90,
        'L'  => 50,
        'XL' => 40,
        'X'  => 10,
        'IX' => 9,
        'V'  => 5,
        'IV' => 4,
        'I'  => 1
      ];
      foreach ($roman_numerals as $roman => $numeral) {
        $matches = intval($n / $numeral);
        $res .= str_repeat($roman, $matches);
        $n = $n % $numeral;
      }

      return $res;
    }


}
