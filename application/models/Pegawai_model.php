<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

    public $table = 'tbl_pegawai';
    public $id = 'idpeg';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('idpeg,idperson,idsemester,idunit');
        $this->datatables->from('tbl_pegawai');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_pegawai.field = table2.field');
        $this->datatables->add_column('action', '<button onclick="return edit_data(\'$1\')" class="btn btn-xs btn-warning item_edit" data-id="$1"><i class="fa fa-edit"></i></button>' . "  " . anchor(site_url('pegawai/delete/$1'), '<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'pegawai/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'idpeg');
        return $this->datatables->generate();
    }

    function search_idperson($title)
    {
        $this->db->from('tbl_person p');
        $this->db->like('p.idperson', $title, 'both');
        $this->db->order_by('p.idperson', 'ASC');
        $this->db->where('p.tipe =', 'P');
        $this->db->limit(10);
        return $this->db->get()->result();
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
    function total_rows($q = NULL)
    {
        $this->db->like('idpeg', $q);
        $this->db->or_like('idpeg', $q);
        $this->db->or_like('idperson', $q);
        $this->db->or_like('idsemester', $q);
        $this->db->or_like('idunit', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idpeg', $q);
        $this->db->or_like('idpeg', $q);
        $this->db->or_like('idperson', $q);
        $this->db->or_like('idsemester', $q);
        $this->db->or_like('idunit', $q);
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
    function deletebulk()
    {
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data);
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }
    //check pk data is exists 

    function is_exist($id)
    {
        $query = $this->db->get_where($this->table, array($this->id => $id));
        $count = $query->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
