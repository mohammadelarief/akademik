<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Person extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Person_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Person';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Person' => '',
        ];
        $data['code_js'] = 'person/codejs';
        $data['page'] = 'person/Person_list';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Person_model->json();
    }

    public function read($id)
    {
        $row = $this->Person_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'idperson' => $row->idperson,
                'nama' => $row->nama,
                'gender' => $row->gender,
                'imageId' => $row->imageId,
                'status' => $row->status,
                'tipe' => $row->tipe,
                'info1' => $row->info1,
                'info2' => $row->info2,
                'user1' => $row->user1,
                'password' => $row->password,
                'tgl_insert' => $row->tgl_insert,
                'tgl_update' => $row->tgl_update,
            );
            $data['title'] = 'Person';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'person/Person_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('person'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('person/create_action'),
            'id' => set_value('id'),
            'idperson' => set_value('idperson'),
            'nama' => set_value('nama'),
            'gender' => set_value('gender'),
            'imageId' => set_value('imageId'),
            'status' => set_value('status'),
            'tipe' => set_value('tipe'),
            'info1' => set_value('info1'),
            'info2' => set_value('info2'),
            'user1' => set_value('user1'),
            'password' => set_value('password'),
            'tgl_insert' => set_value('tgl_insert'),
            'tgl_update' => set_value('tgl_update'),
        );
        $data['title'] = 'Person';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'person/Person_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'idperson' => $this->input->post('idperson', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'gender' => $this->input->post('gender', TRUE),
                'imageId' => $this->input->post('imageId', TRUE),
                'status' => $this->input->post('status', TRUE),
                'tipe' => $this->input->post('tipe', TRUE),
                'info1' => $this->input->post('info1', TRUE),
                'info2' => $this->input->post('info2', TRUE),
                'user1' => $this->input->post('user1', TRUE),
                'password' => $this->input->post('password', TRUE),
                'tgl_insert' => $this->input->post('tgl_insert', TRUE),
                'tgl_update' => $this->input->post('tgl_update', TRUE),
            );
            $this->Person_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('person'));
        }
    }

    public function update($id)
    {
        $row = $this->Person_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('person/update_action'),
                'id' => set_value('id', $row->id),
                'idperson' => set_value('idperson', $row->idperson),
                'nama' => set_value('nama', $row->nama),
                'gender' => set_value('gender', $row->gender),
                'imageId' => set_value('imageId', $row->imageId),
                'status' => set_value('status', $row->status),
                'tipe' => set_value('tipe', $row->tipe),
                'info1' => set_value('info1', $row->info1),
                'info2' => set_value('info2', $row->info2),
                'user1' => set_value('user1', $row->user1),
                'password' => set_value('password', $row->password),
                'tgl_insert' => set_value('tgl_insert', $row->tgl_insert),
                'tgl_update' => set_value('tgl_update', $row->tgl_update),
            );
            $data['title'] = 'Person';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'person/Person_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('person'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'idperson' => $this->input->post('idperson', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'gender' => $this->input->post('gender', TRUE),
                'imageId' => $this->input->post('imageId', TRUE),
                'status' => $this->input->post('status', TRUE),
                'tipe' => $this->input->post('tipe', TRUE),
                'info1' => $this->input->post('info1', TRUE),
                'info2' => $this->input->post('info2', TRUE),
                'user1' => $this->input->post('user1', TRUE),
                'password' => $this->input->post('password', TRUE),
                'tgl_insert' => $this->input->post('tgl_insert', TRUE),
                'tgl_update' => $this->input->post('tgl_update', TRUE),
            );

            $this->Person_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('person'));
        }
    }

    public function delete($id)
    {
        $row = $this->Person_model->get_by_id($id);

        if ($row) {
            $this->Person_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('person'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('person'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Person_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('idperson', 'idperson', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('gender', 'gender', 'trim|required');
        $this->form_validation->set_rules('imageId', 'imageid', 'trim');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('tipe', 'tipe', 'trim|required');
        $this->form_validation->set_rules('info1', 'info1', 'trim');
        $this->form_validation->set_rules('info2', 'info2', 'trim');
        $this->form_validation->set_rules('user1', 'user1', 'trim');
        $this->form_validation->set_rules('password', 'password', 'trim');
        $this->form_validation->set_rules('tgl_insert', 'tgl insert', 'trim');
        $this->form_validation->set_rules('tgl_update', 'tgl update', 'trim');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Person.php */
