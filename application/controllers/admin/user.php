<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/7/18
 * Time: 4:37 PM
 */

class User extends Admin_Controller{
    var $dashboard;
    var $loginpage;
    var $userlisting;

    public function __construct()
    {
        parent::__construct();
        $this->dashboard = 'admin/dashboard';
        $this->userlisting = 'admin/user';
        $this->loginpage = 'admin/user/login';
    }

    public function index(){
        // Fetch all users
        $this->data['users'] = $this->user_m->get();

        //Load view
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main', $this->data
        );

    }
    public function edit($id = NULL){
        // Fetch a user or set a new one
        if ($id){
            $this->data['user'] = $this -> user_m -> get($id);
            count($this->data['user']) || $this->data['errors'] = 'User could not be found';
        }
        else{
            $this->data['user'] = $this->user_m->get_new();
        }

        // Set up the form
        $rules = $this->user_m->rules_admin;
        $id || $rules['password']['rules'] .= '|required';
        $this->form_validation->set_rules($rules);

        //Process the form
        if ($this -> form_validation -> run() == TRUE){
            $data = $this->user_m->array_from_post(array('name', 'email', 'type', 'password'));
            $data['password'] = $this->user_m->hash($data['password']);
            $this->user_m->save($data, $id);
            redirect($this->userlisting);
        }

        // Load view
        $this->data['subview'] = 'admin/user/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }
    public function delete($id = NULL){
        $this->user_m->delete($id);
        redirect($this->userlisting);

    }
    public function login(){

        // Redirect a connected user
        $this->user_m->loggedin() == false || redirect($this->dashboard) ;

        //Set Form
        $rules = $this->user_m->rules;
        $this->form_validation->set_rules($rules);
        $this->load->helper('security');

        //Process Form
        if ($this -> form_validation -> run() == TRUE){
            //We can login and redirect
            if ($this->user_m->login() == true){
                redirect($this->dashboard);
            }
            else{
                $this->session->set_flashdata('error', 'That email/password combination does not exist.');
                redirect($this->loginpage, 'refresh');
            }
        }

        //Load view
        $this->data['subview'] = 'admin/user/login';
        $this->load->view('admin/_layout_modal', $this ->data);
    }

    public function logout(){
        $this->user_m->logout();
        redirect($this->loginpage);
    }

    public function _unique_email($str){
        //Do not validate if email already exists
        //Unless it's the email of the current user

        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !($id) || $this->db->where('id != ', $id);
        $user = $this->user_m->get();

        if (count($user)){
            $this->form_validation->set_message('_unique_email', '%s should be unique.');
            return FALSE;
        }
        return TRUE;
    }
}