<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->validate_token();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Unit_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Unit' => '',
        ];
        $data['code_js'] = 'unit/codejs';
        $data['page'] = 'unit/Unit_list';
	$data['modal'] = 'unit/Unit_modal';
	$this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Unit_model->json();
    }

    public function json_get() 
        {
            $id = $this->input->post("id");
            $row = $this->Unit_model->get_by_id($id);
            
echo json_encode($row);
            
}

            public function json_form()
        {
            $this->_rules();
            $data = array('status' => false, 'messages' => array(), 'msg' => '');
            if ($this->form_validation->run() === FALSE) {
                foreach ($_POST as $key => $value) {
                    $data['messages'][$key] = form_error($key);
                }
                $data['status'] = false;
                $data['msg'] = 'Error';
            } else {
            $act = isset($_POST['actions']) ? $_POST['actions'] : '';
            if ($act == 'Edit') {
                $id = $this->input->post('idunit', TRUE);
                $data = array(
		'idunit' => $this->input->post('idunit',TRUE),
		'nama_unit' => $this->input->post('nama_unit',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'telepon' => $this->input->post('telepon',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );
                
                            $update = $this->Unit_model->update($id, $data);
                            if ($update) {
                                $data['status'] = true;
                    $data['msg'] = 'Success to update data';
                            } else {
                                $data['status'] = false;
                    $data['msg'] = 'Failed to update data';
                    foreach ($_POST as $key => $value) {
                        $data['messages'][$key] = form_error($key);
                    }
                            }
        } else {
           $data = array(
		'idunit' => $this->input->post('idunit',TRUE),
		'nama_unit' => $this->input->post('nama_unit',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'telepon' => $this->input->post('telepon',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );
if(! $this->Unit_model->is_exist($this->input->post('idunit'))){
                 
$insert =$this->Unit_model->insert($data);
                 if ($insert) {
                    $data['status'] = true;
                    $data['msg'] = 'Success to insert data';
                            } else {
                                $data['status'] = false;
                        $data['msg'] = 'Failed to insert data';
                        foreach ($_POST as $key => $value) {
                            $data['messages'][$key] = form_error($key);
                        }
                            }
            }else{
                $data['status'] = false;
                $data['msg'] = 'idsiswa is exist';
            } }
}
echo json_encode($data);
}

    public function read($id) 
    {
        $row = $this->Unit_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idunit' => $row->idunit,
		'nama_unit' => $row->nama_unit,
		'alamat' => $row->alamat,
		'telepon' => $row->telepon,
		'status' => $row->status,
	    );
        $data['title'] = 'Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'unit/Unit_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('unit/create_action'),
	    'idunit' => set_value('idunit'),
	    'nama_unit' => set_value('nama_unit'),
	    'alamat' => set_value('alamat'),
	    'telepon' => set_value('telepon'),
	    'status' => set_value('status'),
	);
        $data['title'] = 'Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'unit/Unit_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idunit' => $this->input->post('idunit',TRUE),
		'nama_unit' => $this->input->post('nama_unit',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'telepon' => $this->input->post('telepon',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );
if(! $this->Unit_model->is_exist($this->input->post('idunit'))){
                $this->Unit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('unit'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, idunit is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Unit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('unit/update_action'),
		'idunit' => set_value('idunit', $row->idunit),
		'nama_unit' => set_value('nama_unit', $row->nama_unit),
		'alamat' => set_value('alamat', $row->alamat),
		'telepon' => set_value('telepon', $row->telepon),
		'status' => set_value('status', $row->status),
	    );
            $data['title'] = 'Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'unit/Unit_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idunit', TRUE));
        } else {
            $data = array(
		'idunit' => $this->input->post('idunit',TRUE),
		'nama_unit' => $this->input->post('nama_unit',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'telepon' => $this->input->post('telepon',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Unit_model->update($this->input->post('idunit', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('unit'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Unit_model->get_by_id($id);

        if ($row) {
            $this->Unit_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('unit'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }

    public function deletebulk(){
        $delete = $this->Unit_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('idunit', 'idunit', 'trim|required');
	$this->form_validation->set_rules('nama_unit', 'nama unit', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('telepon', 'telepon', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('idunit', 'idunit', 'trim');
	$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
}

}

/* End of file Unit.php */
