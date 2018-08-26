<?php
/**
 * Created by IntelliJ IDEA.
 * project: shaym
 * Date: 8/7/18
 * Time: 4:37 PM
 */

class Project extends Admin_Controller{
    var $dashboard;
    var $loginproject;
    var $projectlisting;

    public function __construct()
    {
        parent::__construct();
        $this->dashboard = 'admin/dashboard';
        $this->projectlisting = 'admin/project';
        $this->loginproject = 'admin/user/login';
        $this->load->model('project_m');
    }

    public function index(){
        // Fetch all projects
        $this->data['projects'] = $this->project_m->get();

        //Load view
        $this->data['subview'] = 'admin/project/index';
        $this->load->view('admin/_layout_main', $this->data
        );

    }



    public function edit($id = NULL)
    {
        // Fetch a project or set a new one
        if ($id) {
            $this->data['project'] = $this->project_m->get($id);
            count($this->data['project']) || $this->data['errors'] = 'project could not be found';
        } else {
            $this->data['project'] = $this->project_m->get_new();
        }

        // Set up the form
        $rules = $this->project_m->rules;
        $this->form_validation->set_rules($rules);

        //Process the form
        if ($this->form_validation->run() == TRUE) {


                $data = $this->project_m->array_from_post(array('title', 'slug', 'body', 'pubdate', 'category', 'deadline', 'goal', 'posterurl'));
                $this->project_m->save($data, $id);

                redirect($this->projectlisting);
            }

            // Load view
            $this->data['subview'] = 'admin/project/edit';
            $this->load->view('admin/_layout_main', $this->data);
        }

    public function delete($id = NULL){
        $this->project_m->delete($id);
        redirect($this->projectlisting);

    }






}