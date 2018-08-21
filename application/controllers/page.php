<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/7/18
 * Time: 1:28 AM
 */
require_once APPPATH.'core/Punch_model.php';

class page extends Frontend_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('page_m');
    }

    public function index()
    {


    }


}