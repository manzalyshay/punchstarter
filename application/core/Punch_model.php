<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/7/18
 * Time: 12:58 AM
 */
require_once SYSDIR.'/core/Model.php';

class Punch_model extends CI_Model
{
    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    public function get($id = NULL, $single = FALSE)
    {
        if ($id != NULL){
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        }
        else if($single == TRUE){
            $method = 'row';
        }
        else{
            $method = 'result';
        }
        $arr = $this->db->order_by($this->_order_by);

        if(is_array($arr) && !count($arr)) {
            $arr;
        }

        return $this->db->get($this->_table_name)->$method();
    }

    public function get_by($where, $single = FALSE)
    {
        $this->db->where($where);
        return $this->get(NULL, $single);

    }
    //If an id we'll passed than this will be an update, otherwise - insert
    public function save($data, $id = NULL)
    {
        if ($this->_timestamps == TRUE){
            $now = date('Y-m-d H:i:s');
            //Check if that's an updated or else add the current timestamp
            $id || $data['created'] = $now;
            $data['modified'] = $now;

        }
        //Insert
        if ($id === NULL){
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);

            $id = $this->db->insert_id();
        }
        //UPDATE
        else{
            $filter = $this ->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);

        }

        return $id;

    }
    public function delete($id)
    {
        $filter = $this ->_primary_filter;
        $id = $filter($id);
        if (!$id){
            return FALSE;
        }
        else{
            $this->db->where($this->_primary_key, $id);
            $this->db->limit(1);
            $this->db->delete($this->_table_name);


        }
    }

    public function array_from_post($fields){
        $data = array();
        foreach ($fields as $field){
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

}