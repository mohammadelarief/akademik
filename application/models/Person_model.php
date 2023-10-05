<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Person_model extends CI_Model
{

    public $table = 'tbl_person';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,idperson,nama,gender,imageId,status,tipe,info1,info2,user1,password,tgl_insert,tgl_update');
        $this->datatables->from('tbl_person');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_person.field = table2.field');
$this->datatables->add_column('action', '<button onclick="return edit_data(\'$1\')" class="btn btn-xs btn-warning item_edit" data-id="$1"><i class="fa fa-edit"></i></button>'."  ".anchor(site_url('person/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'person/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'id');return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('idperson', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('gender', $q);
	$this->db->or_like('imageId', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('tipe', $q);
	$this->db->or_like('info1', $q);
	$this->db->or_like('info2', $q);
	$this->db->or_like('user1', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('tgl_insert', $q);
	$this->db->or_like('tgl_update', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('idperson', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('gender', $q);
	$this->db->or_like('imageId', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('tipe', $q);
	$this->db->or_like('info1', $q);
	$this->db->or_like('info2', $q);
	$this->db->or_like('user1', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('tgl_insert', $q);
	$this->db->or_like('tgl_update', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
return $this->db->affected_rows() > 0;
}

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
return $this->db->affected_rows() > 0;
}

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete bulkdata
    function deletebulk(){
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data); 
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }

}