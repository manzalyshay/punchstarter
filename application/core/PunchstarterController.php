<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/6/18
 * Time: 7:51 PM
 */
class PunchstarterController extends CI_Controller
{
    public $data = array();

    function __construct()
    {
        parent::__construct();
        $this->data['errors'] = array();
        $this->data['site_name'] = config_item('site_name');
    }
}
