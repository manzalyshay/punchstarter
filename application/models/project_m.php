<?php
/**
 * Created by IntelliJ IDEA.
 * project: shaym
 * Date: 8/7/18
 * Time: 1:25 AM
 */

class Project_m extends Punch_model
{
    protected $_table_name = 'projects';
    protected $_order_by = 'pubdate desc, id desc';
    protected $_timestamps = TRUE;

    public $rules = array(
        'pubdate' => array('field' => 'pubdate', 'label' => 'Publish Date', 'rules' => 'trim|required|exact_length[10]'),
        'deadline' => array('field' => 'deadline', 'label' => 'Deadline', 'rules' => 'trim|required|exact_length[10]'),
        'backers' => array('field' => 'backers', 'label' => 'Backers', 'rules' => 'trim|is_natural'),
        'pledged' => array('field' => 'pledged', 'label' => 'Pledged', 'rules' => 'trim|is_natural'),
        'goal' => array('field' => 'goal', 'label' => 'Goal', 'rules' => 'trim|is_natural|max_length[100]'),

        'title' => array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_length[100]'),
        'creator' => array('field' => 'creator', 'label' => 'Creator', 'rules' => 'trim|is_natural'),

        'category' => array('field' => 'category', 'label' => 'Category', 'rules' => 'trim|required|max_length[100]'),

        'posterurl' => array('field' => 'posterurl', 'label' => 'Poster URL', 'rules' => 'trim|required|max_length[400]'),

        'slug' => array('field' => 'slug', 'label' => 'Slug', 'rules' => 'trim|required|url_title|max_length[100]'),
        'body' => array('field' => 'body', 'label' => 'Body', 'rules' => 'trim|required'),

    );

    public function __construct()
    {
        parent::__construct();
    }

    public function get_new()
    {
        $project = new stdClass();
        $project->title = '';
        $project->creator_id = (string)$this->session->userdata('id');
        $project->slug = '';
        $project->body = '';
        $project->pubdate = date('Y-m-d');
        $project->posterurl = '';
        $project->goal = 0;
        $project->pledged = 0;
        $project->backers = 0;

        return $project;
    }

    public function getby_id($id){
        $projects = $this->get_by(array(
            'creator_id' => (int)$id));

        console_log($id);
        console_log($projects);

        return $projects;


    }





}