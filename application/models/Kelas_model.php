<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas_model extends CI_Model
{

    public $table = 'tbl_kelas';
    public $id = 'idkelas';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('idkelas,idsemester,idunit,idpeg,idtingkat,idjurusan,idrombel,kapasitas,keterangan,aktif');
        $this->datatables->from('tbl_kelas');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_kelas.field = table2.field');
        $this->datatables->add_column(
            'action',
            anchor(site_url('kelas/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"') . "  " . anchor(site_url('kelas/update/$1'), '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')
            //  . "  " . anchor(site_url('kelas/delete/$1'), '<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'kelas/delete/$1\')" data-toggle="tooltip" title="Delete"')
            ,
            'idkelas'
        );
        return $this->datatables->generate();
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
        $this->db->like('idkelas', $q);
        $this->db->or_like('idkelas', $q);
        $this->db->or_like('idsemester', $q);
        $this->db->or_like('idunit', $q);
        $this->db->or_like('idpeg', $q);
        $this->db->or_like('idtingkat', $q);
        $this->db->or_like('idjurusan', $q);
        $this->db->or_like('idrombel', $q);
        $this->db->or_like('kapasitas', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('aktif', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idkelas', $q);
        $this->db->or_like('idkelas', $q);
        $this->db->or_like('idsemester', $q);
        $this->db->or_like('idunit', $q);
        $this->db->or_like('idpeg', $q);
        $this->db->or_like('idtingkat', $q);
        $this->db->or_like('idjurusan', $q);
        $this->db->or_like('idrombel', $q);
        $this->db->or_like('kapasitas', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('aktif', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
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
