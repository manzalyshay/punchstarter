<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/7/18
 * Time: 12:58 AM
 */

require_once APPPATH.'/core/Punch_model.php';

class user_m extends Punch_model
{
    protected $_table_name = 'users';
    protected $_order_by = 'name';
    public $rules = array(
        'email' => array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
        'password' => array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'),

    );
    public $rules_admin = array(
        'name' => array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
        'email' => array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|callback__unique_email'),
        'type' => array('field' => 'type', 'label' => 'Type', 'rules' => 'trim'),
        'password' => array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|matches[password_confirm]'),
        'password_confirm' => array('field' => 'password_confirm', 'label' => 'Confirm password', 'rules' => 'trim|matches[password]'),

    );

    function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $user = $this->get_by(array(
            'email' => $this->input->post('email'),
            'password' => $this->hash($this->input->post('password')),), TRUE);
//        'password' => $this->input->post('password'),), TRUE);

        if (count($user)){
            // log in user
            $data = array(
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'type' => $user->type,
                'loggedin' => TRUE
            );
            $this->session->set_userdata($data);
        }

    }
    public function logout(){
        $this->session->sess_destroy();
    }
    public function loggedin(){
        return (bool)$this->session->userdata('loggedin');

    }

    public function get_new(){
        $user = new stdClass();
        $user -> name = '';
        $user -> email = '';
        $user -> type = '';
        $user -> password = '';
        return $user;

    }
    public function hash($string){
        return hash('sha512', $string .config_item('encryption_key'));
    }


}