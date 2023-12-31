<?php

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $m . " extends CI_Model
{

    public \$table = '$table_name';
    public \$id = '$pk';
    public \$order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }";

if ($jenis_tabel <> 'reguler_table') {

    $column_all = array();
    foreach ($all as $row) {
        $column_all[] = $row['column_name'];
    }
    $columnall = implode(',', $column_all);

    $string .=
    "\n\n    // datatables
    function json() {
        \$this->datatables->select('" . $columnall . "');
        \$this->datatables->from('" . $table_name .
    "');
        //add this line for join
        //\$this->datatables->join('table2', '" . $table_name . ".field = table2.field');";
    if ($cruds == 'ajax_modal') {
        $string .= "\n\$this->datatables->add_column('action', '<button onclick=\"return edit_data(\'$1\')\" class=\"btn btn-xs btn-warning item_edit\" data-id=\"$1\"><i class=\"fa fa-edit\"></i></button>'.\"  \".anchor(site_url('" . $c_url . "/delete/\$1'),'<i class=\"fa fa-trash\"></i>', 'class=\"btn btn-xs btn-danger\" onclick=\"return confirmdelete(\'" . $c_url . "/delete/\$1\')\" data-toggle=\"tooltip\" title=\"Delete\"'), '$pk');";
    } else {
        $string .= "\n\$this->datatables->add_column('action', anchor(site_url('" . $c_url . "/read/\$1'),'<i class=\"fa fa-search\"></i>', 'class=\"btn btn-xs btn-primary\"  data-toggle=\"tooltip\" title=\"Detail\"').\"  \".anchor(site_url('" . $c_url . "/update/\$1'),'<i class=\"fa fa-edit\"></i>', 'class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" title=\"Edit\"').\"  \".anchor(site_url('" . $c_url . "/delete/\$1'),'<i class=\"fa fa-trash\"></i>', 'class=\"btn btn-xs btn-danger\" onclick=\"return confirmdelete(\'" . $c_url . "/delete/\$1\')\" data-toggle=\"tooltip\" title=\"Delete\"'), '$pk');";
    }
    $string .= "return \$this->datatables->generate();
    }";
}

$string .= "\n\n    // get all
    function get_all()
    {
        \$this->db->order_by(\$this->id, \$this->order);
        return \$this->db->get(\$this->table)->result();
    }

    // get data by id
    function get_by_id(\$id)
    {
        \$this->db->where(\$this->id, \$id);
        return \$this->db->get(\$this->table)->row();
    }
    
    // get total rows
    function total_rows(\$q = NULL) {
        \$this->db->like('$pk', \$q);";

foreach ($non_pk as $row) {
    $string .= "\n\t\$this->db->or_like('" . $row['column_name'] . "', \$q);";
}

$string .= "\n\t\$this->db->from(\$this->table);
        return \$this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data(\$limit, \$start = 0, \$q = NULL) {
        \$this->db->order_by(\$this->id, \$this->order);
        \$this->db->like('$pk', \$q);";

foreach ($non_pk as $row) {
    $string .= "\n\t\$this->db->or_like('" . $row['column_name'] . "', \$q);";
}

$string .= "\n\t\$this->db->limit(\$limit, \$start);
        return \$this->db->get(\$this->table)->result();
    }

    // insert data
    function insert(\$data)
    {
        \$this->db->insert(\$this->table, \$data);";
if ($cruds == 'ajax_modal') {
    $string .= "\nreturn \$this->db->affected_rows() > 0;";
}
$string .= "\n}

    // update data
    function update(\$id, \$data)
    {
        \$this->db->where(\$this->id, \$id);
        \$this->db->update(\$this->table, \$data);";
if ($cruds == 'ajax_modal') {
    $string .= "\nreturn \$this->db->affected_rows() > 0;";
}
$string .= "\n}

    // delete data
    function delete(\$id)
    {
        \$this->db->where(\$this->id, \$id);
        \$this->db->delete(\$this->table);
    }

    // delete bulkdata
    function deletebulk(){
        \$data = \$this->input->post('msg_', TRUE);
        \$arr_id = explode(\",\", \$data); 
        \$this->db->where_in(\$this->id, \$arr_id);
        return \$this->db->delete(\$this->table);
    }";

if (!$isai) {

    $string .= "\n//check pk data is exists \n
        function is_exist(\$id){
         \$query = \$this->db->get_where(\$this->table, array(\$this->id => \$id));
         \$count = \$query->num_rows();
         if(\$count > 0){
            return true;
         }else{
            return false;
         }
        }";
}
$string .=
    "

}";

$hasil_model = createFile($string, $target . "models/" . $m_file);
?>