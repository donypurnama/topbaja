<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public $config = [];

    function __construct () {
      parent::__construct();

      if (!$this->session->userdata("antglobal_backend")) redirect("login");

    }

    public function index () {
      $this->session->unset_userdata("antglobal_backend");
      $this->session->sess_destroy();

      redirect("login", "refresh");
    }

}
