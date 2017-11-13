<?php
class MY_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function is_logged_in()
    {
        $user = $this->session->userdata('user_data');
        return isset($user);
    }
}
?>