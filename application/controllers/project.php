<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/25/18
 * Time: 11:56 PM
 */

class Project extends Frontend_Controller{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_m');
    }

    public function index($id, $slug)
    {
        //Fetch the project
        $this->data['project'] = $this->project_m->get($id);
        //return 404 if project is not found
        count($this->data['project']) || show_404(uri_string());
        //redirect if slug was incorrect
        //load view
        $this->data['subview'] = 'project';
        $this->load->view('_main_layout', $this->data);
    }
}