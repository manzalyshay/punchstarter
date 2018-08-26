<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/6/18
 * Time: 7:49 PM
 */

class Dashboard extends Admin_Controller{


    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->data['subview'] = 'admin_creator/dashboard/index';
        $this->load->view('admin_creator/_layout_main', $this ->data);
    }

    public function modal(){
        $this->load->view('admin_creator/_layout_modal', $this ->data);
    }
}