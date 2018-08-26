<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/6/18
 * Time: 10:48 PM
 */
require_once APPPATH.'core/PunchstarterController.php';

class Frontend_Controller extends PunchstarterController{

    function __construct()
    {
        parent::__construct();

        //load stuff
        $this->load->model('page_m');

        //fetch navigation
        $this->data['menu'] = $this->page_m->get_nested();
        $this->data['projects_list_link'] = $this->page_m->get_list_link();
    }
}