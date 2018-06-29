<?php
error_reporting(0);
//ini_set("display_errors",1);
/**
 *
 * @package    Common_model
 * @author     Vinil Lakkavatri (vinil.lakkavatri@icloud.com)
 * @copyright  2017 Vinil Lakkavatri
 * @ci_version 3.1.9 echo CI_VERSION;
 * @deprecated File deprecated in Release 2.0.0
 *
 **/
Class Common_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    // crud operation queries

    function insert_into_table($table_name,$data){
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }

    function update_into_table_with_multiple_condition($table_name,$where_in_condition,$data){
        $this->db->where($where_in_condition);
        $this->db->update($table_name, $data);
    }

    function delete_into_table_with_multiple_condition($table_name,$where_in_condition){
        $this->db->where($where_in_condition);
        $this->db->delete($table_name);
    }

    function fetch_all_table_data($table_name,$sort_field,$sort_by){
        if (!empty($sort_by) && !empty($sort_field)) {
            $this->db->order_by($sort_field, $sort_by);
        }
        $query = $this->db->select("*")
                ->get($table_name);
        return $query->result_array();
    }

    function fetch_all_table_data_multiple_condition($table_name,$where_in_condition='',$sort_field='',$sort_by=''){
        if (!empty($sort_by) && !empty($sort_field)) {
            $this->db->order_by($sort_field, $sort_by);
        }
        if (!empty($where_in_condition)) {
            $this->db->where($where_in_condition);
        }
        $query = $this->db->select("*")
                ->get($table_name);
        return $query->result_array();
    }

    function fetch_all_table_data_with_mentioned_fields($table_name,$fields,$sort_field,$sort_by){
        if (!empty($sort_by) && !empty($sort_field)) {
            $this->db->order_by($sort_field, $sort_by);
        }
        $query = $this->db->select($fields)
                ->get($table_name);
        return $query->result_array();
    }

    function fetch_row_count_table($table_name,$field_name,$field_id,$count_id){
        $sql = "select count($count_id) as records from ".$table_name." where ".$field_name."='".$field_id."'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }




}
