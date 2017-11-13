<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public $config = [];

    function __construct () {
        parent::__construct();
        if (!$this->session->userdata("antglobal_backend") && $this->session->userdata("antglobal_backend")["user_logged_in"] === false){
          redirect("Login");
        }

        $this->load->model("standard_model");
    }

    function create_slug($string){
        $replace = '-';
        $string = strtolower($string);

        //replace / and . with white space
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);

        //remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        //convert whitespaces and underscore to $replace
        $string = preg_replace("/[\s_]/", $replace, $string);

        //limit the slug size
        $string = substr($string, 0, 100);

        //slug is generated
        return ($ext) ? $string.$ext : $string;
    }

      public function index () {
          $per_page = 10; //article displayed per page
          $total_rows = 0;
          $current_page = 1;

          if ($this->input->get("page") !== null) {
            $current_page = $this->input->get("page");
          }

          $limit = $per_page;
          $offset = ($current_page - 1) * $per_page;

          $products = $this->standard_model->get("`product_id`, `product_sku`, `category_id`, `type_id`, `brand_id`, `product_name`, `product_url`, `product_meta_description`, `product_primary_image`, `product_description`, `product_price`, `product_status`, `product_discount`, `product_length`, `product_width`, `product_height`, `product_weight`, `product_created_time`, `product_last_changed_time`",[], "products", "product_id", "DESC", $per_page, $offset);

           //$this->json->stringify($blogs);

           $total_rows = count($this->standard_model->get("product_id", [
                "product_status" => 1
            ], "products"));

           //pagination total page & current page calculation
           $pagination = [
             "total_page" => ceil($total_rows / $per_page),
             "current_page" => $current_page
           ];

           if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

           $this->settings["main"] = $this->load->view("main/product_view", [
               "data" => $products,
               "pagination" => $pagination
           ], true);

           $this->settings["header"] = $this->load->view("header/header", [
               "menu" => "produk",
               "menu_url" => "product"
           ], true);

           $this->settings['sidebar'] = $this->load->view("sidebar/sidebar", [
               "menu" => "produk"
           ], true);
        $this->template->page($this->settings);
  	}

    public function edit ($product_url = null) {

        $data = $this->standard_model->find("`product_id`, `product_sku`, `category_id`, `type_id`, `brand_id`,
                                            `product_name`, `product_url`, `product_meta_description`, `product_primary_image`,
                                            `product_description`, `product_price`, `product_courier`, `product_free_courier_id`,
                                            `product_status`, `product_discount`, `product_length`,
                                            `product_width`, `product_height`, `product_weight`, `product_created_time`,
                                            `product_last_changed_time`", [
            "product_url" => $product_url
        ],  "products");
        $where = [
          "category_id" => $data['category_id']
        ];
        $exp_product_free_courier_id = explode(',', $data['product_free_courier_id']);

        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "produk"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "produk",
                "menu_url" => "product"
            ], true),
            "main" => $this->load->view("main/product_edit", [
                "data" => $data,
                "categories"  => $this->standard_model->get("category_id, category_name", [],"categories", "category_name", "ASC"),
                "types"       => $this->standard_model->get("type_id, type_name", $where,"types", "type_name", "ASC"),
                "brands"      => $this->standard_model->get("brand_id, brand_name", [],"brands", "brand_name", "ASC"),
                "exp_product_free_courier_id" => $exp_product_free_courier_id,
                // "freecourier" => $this->standard_model->get("free_courier_id, free_courier_name, free_courier_desc", [],"free_courier", "free_courier_id", "ASC"),
            ], true)
        ];

        $this->template->page($config);
    }

    public function insert () {

        $imp_product_free_courier_id = implode(',', $this->input->post('product_free_courier_id'));

        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/products");

        $title =  $this->input->post("product_name");
        $product_price = preg_replace("/[\/\.]/", "",$this->input->post("product_price"));
        $product_price = preg_replace("/[^a-z0-9_\s-]/", "", $product_price);
        $data = [
            "product_name"          => $title,
            "product_url"           => $this->create_slug($this->input->post("product_name")),
            "product_sku"           => $this->input->post("product_sku"),
            "category_id"           => $this->input->post("category_id"),
            "type_id"               => $this->input->post("type_id"),
            "brand_id"              => $this->input->post("brand_id"),
            "product_meta_description" => $this->input->post("product_meta_description"),
            "product_description"   => $this->input->post("product_description"),
            "product_price"         => $product_price,
            "product_courier"       => $this->input->post("product_courier"),
            "product_free_courier_id"  => $imp_product_free_courier_id,
            "product_status"        => $this->input->post("product_status"),
            "product_discount"      => $this->input->post("product_discount"),
            "product_length"        => $this->input->post("product_length"),
            "product_width"         => $this->input->post("product_width"),
            "product_height"        => $this->input->post("product_height"),
            "product_weight"        => $this->input->post("product_weight")
        ];
        //$this->json->stringify($data);
        $file_name="";
        $config["file_name"] = $title;
        $config['allowed_types'] = '*';
        $config["upload_path"] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
        $config['max_size'] = '3072'; //3 MB
        $config["remove_spaces"] = TRUE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload("product_image")) {
            $err = $this->upload->display_errors();
            $this->session->set_flashdata("error_upload", $err);
            redirect("product/add");
        } else {
            $upload_data = $this->upload->data();
            $data["product_primary_image"] = $upload_data["file_name"];

            if ($this->standard_model->insert($data, "products") !== false) {
                redirect("product/");
            } else redirect("fail/");
        }
    }

    public function add () {
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "produk"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "produk",
                "menu_url" => "product"
            ], true),
            "main" => $this->load->view("main/product_add", [
              "categories"=>$this->standard_model->get("category_id, category_name", [],"categories", "category_name", "ASC"),
              "brands"=>$this->standard_model->get("brand_id, brand_name", [],"brands", "brand_name", "ASC")
            ], true)
        ];

        $this->template->page($config);
    }

    public function update () {

        $imp_product_free_courier_id = implode(',', $this->input->post('product_free_courier_id'));

        $this->load->library("upload");
        $upload_path = realpath(APPPATH . "../../file_assets/products");

        $title =  $this->input->post("product_name");
        $product_price = preg_replace("/[\/\.]/", "",$this->input->post("product_price"));
        $product_price = preg_replace("/[^a-z0-9_\s-]/", "", $product_price);
        $data = [
            "product_name"            => $title,
            "product_url"             => $this->create_slug($this->input->post("product_name")),
            "product_sku"             => $this->input->post("product_sku"),
            "category_id"             => $this->input->post("category_id"),
            "type_id"                 => $this->input->post("type_id"),
            "brand_id"                => $this->input->post("brand_id"),
            "product_meta_description" => $this->input->post("product_meta_description"),
            "product_description"     => $this->input->post("product_description"),
            "product_price"           => $product_price,
            "product_courier"         => $this->input->post("product_courier"),
            "product_free_courier_id"  => $imp_product_free_courier_id,
            "product_status"          => $this->input->post("product_status"),
            "product_discount"        => $this->input->post("product_discount"),
            "product_length"          => $this->input->post("product_length"),
            "product_width"           => $this->input->post("product_width"),
            "product_height"          => $this->input->post("product_height"),
            "product_weight"          => $this->input->post("product_weight"),
            "product_last_changed_time" => date("Y-m-d H:i:s")
        ];
        //$this->json->stringify($data);
        $where = [
            "product_id" => $this->input->post("product_id")
        ];

        if ($_FILES["product_image"]["name"] !== "") {
            $file_name="";
            $config["file_name"] = $title;
            $config['allowed_types'] = '*';
            $config["upload_path"] = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp';
            $config['max_size'] = '3072'; //3 MB
            $config["remove_spaces"] = TRUE;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload("product_image")) {
                $err = $this->upload->display_errors();
                $this->session->set_flashdata("error_upload", $err);
                redirect("product/edit/".$data['product_url']);
            } else {
                $upload_data = $this->upload->data();
                $data["product_primary_image"] = $upload_data["file_name"];

                $prev_data = $this->standard_model->find("product_primary_image",$where,"products");
                //delete image
                unlink ($upload_path."/".$prev_data["product_primary_image"]);
                //echo $upload_path."/".$prev_data["product_image"];
            }
        }

        if ($this->standard_model->update($data, "products",$where) !== false) {
            redirect("product/");
        } else redirect("fail/");
    }

    public function delete ($id = null) {
        $image_path = realpath(APPPATH . "../../file_assets/products/");
        $where = [
            "product_id" => $id
        ];

        $data = $this->standard_model->find("product_primary_image",$where,"products");

        //Check is the product have order

        if ($this->standard_model->delete($where, "products") !== false) {
            //delete image
            unlink ($image_path."/".$data["product_primary_image"]);
            redirect("product/");
        } else redirect("fail/");
    }

    public function get_type(){
      $where =  ["category_id" => $this->input->post("category_id")];
      $data = $this->standard_model->get("type_id,type_name",$where,"types","type_name");

      if ($data) {
        $type = array(""=>"--Pilih Tipe--");
        foreach ($data as $key => $value) {
          //$type_id = $value['type_id'];
          //$type_name = $value['type_name'];

          $type += array($value['type_id']=>$value['type_name']);
        }
      } else {
        $type = array(""=>"--Tidak ada data--");
      }
      print form_dropdown('type_id',$type);
    }

    //Product Images
    public function image($product_url = null){
        $data = $this->standard_model->find("`product_id`, `product_sku`, `product_name`, `product_url`, `product_primary_image`", [
            "product_url" => $product_url
        ], "products");
        $config = [
            "sidebar" => $this->load->view("sidebar/sidebar", [
                "menu" => "produk"
            ], true),
            "header" => $this->load->view("header/header", [
                "menu" => "produk",
                "menu_url" => "product"
            ], true),
            "main" => $this->load->view("main/product_image", [
                "data" => $data,
                "galeri" => $this->standard_model->find("product_id,product_image,product_image_description",[
                    "product_id" => $data['product_id']
                ],"product_images")
            ], true)
        ];
        $this->template->page($config);
    }

    public function upload ($product_url = null) {
        $data = $this->standard_model->find("`product_id`, `product_url`,product_name", [
              "product_url" => $product_url
          ], "products");
        //$this->json->stringify($data);
        $product_id = $data['product_id'];
        $product_name = $data['product_name'];

        if (!empty($_FILES)) {
          $this->load->library("upload");
          $upload_path = realpath(APPPATH . "../../file_assets/products");

          $file_name="";

          $config['allowed_types'] = '*';
          $config["upload_path"] = $upload_path;
          $config['allowed_types'] = '*';
          $config['max_size'] = '3072'; //3 MB
          $config["remove_spaces"] = TRUE;

    			$files = $_FILES;
    			$number_of_files = count($_FILES['file']['name']);
    			$errors = 0;

          $data = [];
          $data["product_id"] = $product_id;
    			for ($i = 0; $i < $number_of_files; $i++) {
            $file_name =$config['file_name'] = md5(microtime()).".png";
            $data['product_image'] = $file_name;
    				$_FILES['file']['type'] = $files['file']['type'][$i];
    				$_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
    				$_FILES['file']['error'] = $files['file']['error'][$i];
    				$_FILES['file']['size'] = $files['file']['size'][$i];


    				// we have to initialize before upload
    				$this->upload->initialize($config);

    				if ($this->upload->do_upload("file")) {
                $data["product_image_description"] = "Tidak ada keterangan";
                //$this->json->stringify($data);
      					$this->standard_model->insert($data, "product_images");
    				} else {
                // $err = $this->upload->display_errors();
                // die($err);
                echo $this->upload->display_errors();
                $errors++;
            }
    			}

    			if ($errors > 0) {
    				echo $errors . "File(s) cannot be uploaded";
    			}
    		} elseif ($this->input->post('file_to_remove')) {
    			$file_to_remove = $this->input->post('file_to_remove');
    			$this->standard_model->delete([
                    "product_image_id" => $file_to_remove
                ], "product_images");
    		} else {
    			$this->listFiles($product_id);
    		}

    }
    public function update_description () {
      if ($this->input->post("product_image_id")) {
          echo json_encode($this->standard_model->update([
                "product_image_description" => $this->input->post("product_image_description")
            ], "product_images", [
               "product_image_id" => $this->input->post("product_image_id")
            ]));
      }
    }
    public function listFiles ($product_id = null) {
      if ($product_id) {

          $files = $this->standard_model->get("product_image_id,product_id,product_image,product_image_description",[
              "product_id" => $product_id
          ], "product_images");

          //$this->json->stringify($files);

          echo json_encode($files);
      }
    }

    public function search (){
      $keyword = $this->input->get("search");

      $per_page = 10; //article displayed per page
      $total_rows = 0;
      $current_page = 1;

      if ($this->input->get("page") !== null) {
        $current_page = $this->input->get("page");
      }

      $limit = $per_page;
      $offset = ($current_page - 1) * $per_page;
      $products = $this->standard_model->search_products($keyword,$limit,$offset);

       //$this->json->stringify($blogs);

       $total_rows = count($this->standard_model->search_products($keyword));

       //pagination total page & current page calculation
       $pagination = [
         "total_page" => ceil($total_rows / $per_page),
         "current_page" => $current_page
       ];

       if ($pagination["total_page"] == 0) $pagination["total_page"] = 1;

       $this->settings["main"] = $this->load->view("main/product_view", [
           "data" => $products,
           "pagination" => $pagination
       ], true);

       $this->settings["header"] = $this->load->view("header/header", [
           "menu" => "produk",
           "menu_url" => "product"
       ], true);

       $this->settings['sidebar'] = $this->load->view("sidebar/sidebar", [
           "menu" => "produk"
       ], true);

    $this->template->page($this->settings);
    }
}
