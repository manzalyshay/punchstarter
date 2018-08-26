<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/7/18
 * Time: 1:28 AM
 */
require_once APPPATH.'models/punch_model.php';

class Page extends Frontend_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('page_m');
    }
    function Filter($array){

        if ($array->deadline >= date(Y-m-d) && $array->category == $this->uri->segment(1)) {
            return TRUE;
        }
        else
            return FALSE;

    }
    public function index()
    {

        //Fetch the page template
        $this->data['page'] = $this->page_m->get_by(array('slug' => (string) $this->uri->segment(1)), TRUE);
        console_log($this->data['page']);
        count($this->data['page']) || show_404(current_url());


        //Fetch the page data
        $method = '_' . $this->data['page']->template;
        if (method_exists($this, $method)){
            $this->$method();
        }
        else{
            log_message('error', 'could not load template' . $method . 'in file' . __FILE__ . 'at line ' . __LINE__);
            show_error('could not load template' . $method );
        }

        $this->data['subview'] = $this -> data['page'] -> template;
        $this->load->view('_main_layout', $this->data);
    }


    private function _page(){
    }

    private function _homepage(){
        $this->load->model('project_m');
        $this->db->where('deadline >=', date(Y-m-d));
        $this->db->limit(6);
        $this->data['projects'] = filter_alive($this->project_m->get());

    }


    private function _projects_list(){
        $this->load->model('project_m');
        //count all project
        $count = $this->db->count_all_results('projects');
        //set up pegination
        $perpage = 100;
        if ($count > $perpage ){

            $this->load->library('pagination');

            $config['base_url'] = site_url($this->uri->segment(1) . '/');
            $config['total_rows'] = $count;
            $config['per_page'] = $perpage;
            $config['uri_segment'] = 2;

            $this->pagination->initialize($config);

            $this->data['pageination'] = $this->pagination->create_links();
            $offset = $this->uri->segment(2);
        }
        else{
            $this->data['pageination'] = '';
            $offset = 0;
        }

        //fetch projects
        $where = array('category', $this->uri->segment(1), 'deadline >=', date(Y-m-d));
//
//        $this->db->where($where);
        $this->db->limit($perpage, $offset);
        $this->data['projects'] = $this->project_m->get();
        $projects = $this->data['projects'];
        $projects = filter_alive($projects);
        $projects = filter_category($projects);

        $this->data['projects'] = $projects;
    }




}