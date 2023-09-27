<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->validate_token();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kelas_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Kelas';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kelas' => '',
        ];
        $data['code_js'] = 'kelas/codejs';
        $data['page'] = 'kelas/Kelas_list';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Kelas_model->json();
    }

    public function read($id)
    {
        $row = $this->Kelas_model->get_by_id($id);
        if ($row) {
            $data = array(
                'idkelas' => $row->idkelas,
                'idsemester' => $row->idsemester,
                'idunit' => $row->idunit,
                'idpeg' => $row->idpeg,
                'idtingkat' => $row->idtingkat,
                'idjurusan' => $row->idjurusan,
                'idrombel' => $row->idrombel,
                'kapasitas' => $row->kapasitas,
                'keterangan' => $row->keterangan,
                'aktif' => $row->aktif,
            );
            $data['title'] = 'Kelas';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kelas/Kelas_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelas/create_action'),
            'idkelas' => _unix_id('KLS'),
            'idsemester' => set_value('idsemester'),
            'idunit' => set_value('idunit'),
            'idpeg' => set_value('idpeg'),
            'idtingkat' => set_value('idtingkat'),
            'idjurusan' => set_value('idjurusan'),
            'idrombel' => set_value('idrombel'),
            'kapasitas' => set_value('kapasitas'),
            'keterangan' => set_value('keterangan'),
            'aktif' => set_value('aktif'),
        );
        $data['title'] = 'Kelas';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kelas/Kelas_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'idkelas' => $this->input->post('idkelas', TRUE),
                'idsemester' => $this->input->post('idsemester', TRUE),
                'idunit' => $this->input->post('idunit', TRUE),
                'idpeg' => $this->input->post('idpeg', TRUE),
                'idtingkat' => $this->input->post('idtingkat', TRUE),
                'idjurusan' => $this->input->post('idjurusan', TRUE),
                'idrombel' => $this->input->post('idrombel', TRUE),
                'kapasitas' => $this->input->post('kapasitas', TRUE),
                'keterangan' => $this->input->post('idtingkat', TRUE) . ' ' . $this->input->post('idjurusan', TRUE) . ' ' . $this->input->post('idrombel', TRUE),
                'aktif' => $this->input->post('aktif', TRUE),
            );
            if (!$this->Kelas_model->is_exist($this->input->post('idkelas'))) {
                $this->Kelas_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('kelas'));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, idkelas is exist');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelas/update_action'),
                'idkelas' => set_value('idkelas', $row->idkelas),
                'idsemester' => set_value('idsemester', $row->idsemester),
                'idunit' => set_value('idunit', $row->idunit),
                'idpeg' => set_value('idpeg', $row->idpeg),
                'idtingkat' => set_value('idtingkat', $row->idtingkat),
                'idjurusan' => set_value('idjurusan', $row->idjurusan),
                'idrombel' => set_value('idrombel', $row->idrombel),
                'kapasitas' => set_value('kapasitas', $row->kapasitas),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'aktif' => set_value('aktif', $row->aktif),
            );
            $data['title'] = 'Kelas';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kelas/Kelas_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idkelas', TRUE));
        } else {
            $data = array(
                'idkelas' => $this->input->post('idkelas', TRUE),
                'idsemester' => $this->input->post('idsemester', TRUE),
                'idunit' => $this->input->post('idunit', TRUE),
                'idpeg' => $this->input->post('idpeg', TRUE),
                'idtingkat' => $this->input->post('idtingkat', TRUE),
                'idjurusan' => $this->input->post('idjurusan', TRUE),
                'idrombel' => $this->input->post('idrombel', TRUE),
                'kapasitas' => $this->input->post('kapasitas', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'aktif' => $this->input->post('aktif', TRUE),
            );

            $this->Kelas_model->update($this->input->post('idkelas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelas'));
        }
    }

    public function delete($id)
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $this->Kelas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Kelas_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('idkelas', 'idkelas', 'trim|required');
        $this->form_validation->set_rules('idsemester', 'idsemester', 'trim|required');
        $this->form_validation->set_rules('idunit', 'idunit', 'trim|required');
        $this->form_validation->set_rules('idpeg', 'idpeg', 'trim|required');
        $this->form_validation->set_rules('idtingkat', 'idtingkat', 'trim|required');
        $this->form_validation->set_rules('idjurusan', 'idjurusan', 'trim|required');
        $this->form_validation->set_rules('idrombel', 'idrombel', 'trim|required');
        $this->form_validation->set_rules('kapasitas', 'kapasitas', 'trim|required|numeric');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('aktif', 'aktif', 'trim|required');

        $this->form_validation->set_rules('idkelas', 'idkelas', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Kelas.php */
