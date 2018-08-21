<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/6/18
 * Time: 10:48 PM
 */
require_once APPPATH.'core/PunchstarterController.php';

class Admin_Controller extends PunchstarterController{
    var $login = 'admin/user/login';
    var $logout = 'admin/user/logout';

    function __construct()
    {
        parent::__construct();
        $this->data['meta_title'] = 'PunchStarter';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('user_m');

        //LoginCheck
        $exc_uris = array($this->login, $this->logout);
        if (in_array(uri_string(), $exc_uris) == FALSE){
        if ($this->user_m->loggedin() == FALSE){
            redirect($this->login);
        }
        }


    }
}