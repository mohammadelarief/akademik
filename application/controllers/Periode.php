<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Periode extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Periode_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Periode';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Periode' => '',
        ];
        $data['code_js'] = 'periode/codejs';
        $data['page'] = 'periode/Periode_list';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Periode_model->json();
    }

    public function read($id)
    {
        $row = $this->Periode_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'idperiode' => $row->idperiode,
                'parent' => $row->parent,
                'kalender' => $row->kalender,
                'kode' => $row->kode,
                'tglmulai' => $row->tglmulai,
                'tglakhir' => $row->tglakhir,
                'keterangan' => $row->keterangan,
                'aktif' => $row->aktif,
            );
            $data['title'] = 'Periode';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'periode/Periode_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('periode'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('periode/create_action'),
            'id' => set_value('id'),
            'idperiode' => set_value('idperiode'),
            'parent' => set_value('parent'),
            'kalender' => set_value('kalender'),
            'kode' => set_value('kode'),
            'tglmulai' => set_value('tglmulai'),
            'tglakhir' => set_value('tglakhir'),
            'keterangan' => set_value('keterangan'),
            'aktif' => set_value('aktif'),
        );
        $data['title'] = 'Periode';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'periode/Periode_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'idperiode' => $this->input->post('idperiode', TRUE),
                'parent' => $this->input->post('parent', TRUE),
                'kalender' => $this->input->post('kalender', TRUE),
                'kode' => $this->input->post('kode', TRUE),
                'tglmulai' => $this->input->post('tglmulai', TRUE),
                'tglakhir' => $this->input->post('tglakhir', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'aktif' => $this->input->post('aktif', TRUE),
            );
            $this->Periode_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('periode'));
        }
    }

    public function update($id)
    {
        $row = $this->Periode_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('periode/update_action'),
                'id' => set_value('id', $row->id),
                'idperiode' => set_value('idperiode', $row->idperiode),
                'parent' => set_value('parent', $row->parent),
                'kalender' => set_value('kalender', $row->kalender),
                'kode' => set_value('kode', $row->kode),
                'tglmulai' => set_value('tglmulai', $row->tglmulai),
                'tglakhir' => set_value('tglakhir', $row->tglakhir),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'aktif' => set_value('aktif', $row->aktif),
            );
            $data['title'] = 'Periode';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'periode/Periode_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('periode'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'idperiode' => $this->input->post('idperiode', TRUE),
                'parent' => $this->input->post('parent', TRUE),
                'kalender' => $this->input->post('kalender', TRUE),
                'kode' => $this->input->post('kode', TRUE),
                'tglmulai' => $this->input->post('tglmulai', TRUE),
                'tglakhir' => $this->input->post('tglakhir', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'aktif' => $this->input->post('aktif', TRUE),
            );

            $this->Periode_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('periode'));
        }
    }

    public function delete($id)
    {
        $row = $this->Periode_model->get_by_id($id);

        if ($row) {
            $this->Periode_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('periode'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('periode'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Periode_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('idperiode', 'idperiode', 'trim|required');
        $this->form_validation->set_rules('parent', 'parent', 'trim|required');
        $this->form_validation->set_rules('kalender', 'kalender', 'trim|required');
        $this->form_validation->set_rules('kode', 'kode', 'trim|required');
        $this->form_validation->set_rules('tglmulai', 'tglmulai', 'trim|required');
        $this->form_validation->set_rules('tglakhir', 'tglakhir', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('aktif', 'aktif', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Periode.php */
