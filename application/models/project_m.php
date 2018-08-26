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

    public function save_order($pages){
        if (count($pages)){
            foreach ($pages as $order => $page){
                if ($page['item_id'] != ''){
                    $data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
                }
            }
        }
    }

    public function get_nested(){
        $pages = $this ->db->get('pages')->result_array();

        $arr = array();

        foreach ($pages as $page){
            if(!$page['parent_id']){
                $arr[$page['id']] = $page;
            }
            else{
                $arr[$page['parent_id']]['children'][] = $page;
            }
        }

        return $arr;
    }
    public function delete($id)
    {
        //delete a page
        return parent::delete($id); // TODO: Change the autogenerated stub

        // reset parent id
        $this->db->set(array('parent_id' => 0)) ->where('parent_id', $id)->update($this->_table_name);


    }

    public function get_with_parent($id = NULL, $single = FALSE){
        $this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
        $this->db->join('pages as p', 'pages.parent_id = p.id', 'left');
        return parent::get($id, $single);
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


