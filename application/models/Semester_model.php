<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Semester_model extends CI_Model
{

    public $table = 'tbl_semester';
    public $id = 'idsemester';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('idsemester,nama_semester,idperiode,keterangan,tanggal_awal,tanggal_akhir,status');
        $this->datatables->from('tbl_semester');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_semester.field = table2.field');
        $this->datatables->add_column(
            'action',
            anchor(site_url('semester/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"') . "  " . anchor(site_url('semester/update/$1'), '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')
            . "  " . '<button onclick="return updateAktif(\'$1\',\'$2\')" class="btn btn-xs btn-info update-aktif" data-id="$1"><i class="fas fa-check-circle"></i></button>'
            ,
            'idsemester,idperiode'
        );
        return $this->datatables->generate();
    }

    public function updateAktif($id)
    {
        // Update semua baris menjadi 0 kecuali yang dipilih
        $this->db->update('tbl_semester', array('status' => 0));

        // Update baris dengan ID yang sesuai menjadi 1
        $this->db->where('idsemester', $id);
        $success = $this->db->update('tbl_semester', array('status' => 1));

        return $success;
    }
    public function check_periode($prd)
    {
        // $this->db->select('status');
        $this->db->from('tbl_periode');
        $this->db->where('idperiode', $prd); // Ganti 'variable_column_name' sesuai kolom yang sesuai di tabel
        $this->db->where('aktif', 1); // Ganti 'variable_column_name' sesuai kolom yang sesuai di tabel

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
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
        $this->db->like('idsemester', $q);
        $this->db->or_like('idsemester', $q);
        $this->db->or_like('nama_semester', $q);
        $this->db->or_like('idperiode', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('tanggal_awal', $q);
        $this->db->or_like('tanggal_akhir', $q);
        $this->db->or_like('status', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idsemester', $q);
        $this->db->or_like('idsemester', $q);
        $this->db->or_like('nama_semester', $q);
        $this->db->or_like('idperiode', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('tanggal_awal', $q);
        $this->db->or_like('tanggal_akhir', $q);
        $this->db->or_like('status', $q);
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
