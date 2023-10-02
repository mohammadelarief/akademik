<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa_model extends CI_Model
{

    public $table = 'tbl_siswa';
    public $id = 'idsiswa';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('idsiswa,idperson,idkelas,tgl_masuk,info1,info2,user1,tgl_insert,tglUpdate,status');
        $this->datatables->from('tbl_siswa');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_siswa.field = table2.field');
$this->datatables->add_column('action', '<button onclick="return edit_data(\'$1\')" class="btn btn-xs btn-warning item_edit" data-id="$1"><i class="fa fa-edit"></i></button>'."  ".anchor(site_url('siswa/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'siswa/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'idsiswa');return $this->datatables->generate();
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
        $this->db->like('idsiswa', $q);
	$this->db->or_like('idsiswa', $q);
	$this->db->or_like('idperson', $q);
	$this->db->or_like('idkelas', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('info1', $q);
	$this->db->or_like('info2', $q);
	$this->db->or_like('user1', $q);
	$this->db->or_like('tgl_insert', $q);
	$this->db->or_like('tglUpdate', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idsiswa', $q);
	$this->db->or_like('idsiswa', $q);
	$this->db->or_like('idperson', $q);
	$this->db->or_like('idkelas', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('info1', $q);
	$this->db->or_like('info2', $q);
	$this->db->or_like('user1', $q);
	$this->db->or_like('tgl_insert', $q);
	$this->db->or_like('tglUpdate', $q);
	$this->db->or_like('status', $q);
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
//check pk data is exists 

        function is_exist($id){
         $query = $this->db->get_where($this->table, array($this->id => $id));
         $count = $query->num_rows();
         if($count > 0){
            return true;
         }else{
            return false;
         }
        }

}