<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template_model extends CI_model{

    private $_table;
    private $_database;

    function __construct(){
      parent::__construct();
      $this->_database = $this->load->database('default', TRUE);
    }

    // Unique to models with multiple tables
    function set_table($table) {
      $this->_table = $table;
    }
    
    // Get table from table property
    function get_table() {
      $table = $this->_table;
      return $table;
    }

    // Retrieve all data from database and order by column return query
    function get($order_by) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->order_by($order_by);
      $query=$db->get($table);
      return $query;
    }

    // Limit results, then offset and order by column return query
    function get_with_limit($limit, $offset, $order_by) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->limit($limit, $offset);
      $db->order_by($order_by);
      $query=$db->get($table);
      return $query;
    }    

    // Get where custom column is .... return query
    function get_where($col, $value) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->where($col, $value);
      $query=$db->get($table);
      return $query;
    }

    // Get where custom column is .... and sort by return query
    function get_where_custom_sort($col, $value, $order_by) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->where($col, $value);
      $db->order_by($order_by);
      $query=$db->get($table);
      return $query;
    }
    
    // Get where with multiple where conditions $data contains conditions as associative
    // array column=>condition
    function get_multiple_where($data) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->where($data);
      $query=$db->get($table);
      return $query;
    }
    
    // Get where column like %match% for single where condition
    function get_where_like($column, $match) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->like($column, $match);
      $query=$db->get($table);
      return $query;
    }
    
    // Get where column like %match% for each $data. $data is associative array column=>match
    function get_where_like_multiple($data) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->like($data);
      $query=$db->get($table);
      return $query;
    }
    
    // Get where column not like %match% for single where condition
    function get_where_not_like($column, $match) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->not_like($column, $match);
      $query=$db->get($table);
      return $query;
    }

    // Insert data into table $data is an associative array column=>value
    function _insert($data) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->insert($table, $data);
    }
    
    // Insert data into table $data is an associative array column=>value
    function insert_batch($data) {
      $db = $this->database;
      $table = $this->get_table();
      $db->insert_batch($table, $data);
    }

    // Update existing row where $key = $id and data is an associative array column=>value
    function _update($key, $id, $data) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->where($key, $id);
      $db->update($table, $data);
    }

    // Delete a row where id = $id
    function _delete($id) {
      $db = $this->database;
      $table = $this->get_table();
      $db->where('username', $id);
      $db->delete($table);
    }

    // Delete a row where $column = $value
    function delete_where($column, $value) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->where($column, $value);
      $db->delete($table);
    }
    
    // Count results where column = value and return integer
    function count_where($column, $value) {
      $db = $this->_database;
      $table = $this->get_table();
      $db->where($column, $value);
      $query=$db->get($table);
      $num_rows = $query->num_rows();
      return $num_rows;
    }

    // Count all the rows in a table and return integer
    function count_all() {
      $db = $this->_database;
      $table = $this->get_table();
      $query=$db->get($table);
      $num_rows = $query->num_rows();
      return $num_rows;
    }

    // Find the highest value in username then return username
    function get_max() {
      $db = $this->database;
      $table = $this->get_table();
      $db->select_max('username');
      $query = $db->get($table);
      $row=$query->row();
      $id=$row->id;
      return $id;
    }

    // Specify a custom query then return query
    function _custom_query($mysql_query) {
      $db = $this->database;
      $query = $db->query($mysql_query);
      return $query;
    }

}