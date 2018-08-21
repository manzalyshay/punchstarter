<?php
/**
 * Created by IntelliJ IDEA.
 * page: shaym
 * Date: 8/7/18
 * Time: 1:25 AM
 */

class page_m extends Punch_model{
    protected $_table_name = 'pages';
    protected $_order_by = 'order';
    public $rules = array(
        'parent_id' => array('field' => 'parent_id', 'label' => 'Parent', 'rules' => 'trim|intval'),
        'title' => array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_length[100]'),
        'slug' => array('field' => 'slug', 'label' => 'Slug', 'rules' => 'trim|required|url_title|callback__unique_slug|max_length[100]'),
//        'order' => array('field' => 'order', 'label' => 'Order', 'rules' => 'trim|is_natural'),
        'body' => array('field' => 'body', 'label' => 'Body', 'rules' => 'trim|required'),

    );

    public function get_new(){
        $page = new stdClass();
        $page -> title = '';
        $page -> slug = '';
        $page -> body = '';
        $page -> parent_id = 0;
//        $page -> order = '';
        return $page;

    }

    public function get_no_parents(){
        //Fetch pages without parents

        $this->db->select('id, title');
        $this->db->where('parent_id', 0);
        $pages = parent::get();

        // return k,v pair array
        $arr = array(0 => 'No parent');
        if (count($pages)){
            foreach ($pages as $page) {
                $arr[$page -> id] = $page ->title;
            }
        }
        return $arr;
    }





}



