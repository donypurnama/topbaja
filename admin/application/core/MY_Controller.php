<?php
class MY_Controller extends CI_Controller
{
   function __construct(){
       parent::__construct();
       
       if (!$this->is_logged_in()) {
           redirect("login");
       }
   }

    public function is_logged_in()
    {
        if ($this->session->userdata('logged_in')) return true;
        return false;
        
    }

    function sessdestroy() {
        $this->session->sess_destroy();
    }
    
}
?>