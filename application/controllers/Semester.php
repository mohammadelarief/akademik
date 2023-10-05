<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Semester extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->validate_token();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Semester_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Semester';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Semester' => '',
        ];
        $data['code_js'] = 'semester/codejs';
        $data['page'] = 'semester/Semester_list';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Semester_model->json();
    }

    public function updateAktifAjax()
    {
        $id = $this->input->post('id');
        $prd = $this->input->post('prd');
        $cek_prd =  $this->Semester_model->check_periode($prd);
        if ($cek_prd) {
            $this->Semester_model->updateAktif($id);
            echo json_encode(array("status" => TRUE));
        } else {
            echo json_encode(array("status" => FALSE));
        }
        // if ($success) {
        //     $this->session->set_flashdata('message', 'Aktivasi Record Success');
        // } else {
        //     $this->session->set_flashdata('message_error', 'Aktivasi Record failed');
        // }
        // if ($success) {
        //     $response['success'] = true;
        //     $response['newAktif'] = 1;
        // } else {
        //     $response['success'] = false;
        // }

        // echo json_encode($response);
    }

    public function read($id)
    {
        $row = $this->Semester_model->get_by_id($id);
        if ($row) {
            $data = array(
                'idsemester' => $row->idsemester,
                'nama_semester' => $row->nama_semester,
                'idperiode' => $row->idperiode,
                'keterangan' => $row->keterangan,
                'tanggal_awal' => $row->tanggal_awal,
                'tanggal_akhir' => $row->tanggal_akhir,
                'status' => $row->status,
            );
            $data['title'] = 'Semester';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'semester/Semester_read';
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
            'action' => site_url('semester/create_action'),
            'idsemester' => _unix_id('SMS'),
            'nama_semester' => set_value('nama_semester'),
            'idperiode' => set_value('idperiode'),
            'keterangan' => set_value('keterangan'),
            'tanggal_awal' => set_value('tanggal_awal'),
            'tanggal_akhir' => set_value('tanggal_akhir'),
            'status' => set_value('status'),
        );
        $data['title'] = 'Semester';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['code_js'] = 'semester/js';
        $data['page'] = 'semester/Semester_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'idsemester' => $this->input->post('idsemester', TRUE),
                'nama_semester' => $this->input->post('nama_semester', TRUE),
                'idperiode' => $this->input->post('idperiode', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'tanggal_awal' => date('Y-m-d', strtotime($this->input->post('tanggal_awal', TRUE))),
                'tanggal_akhir' => date('Y-m-d', strtotime($this->input->post('tanggal_akhir', TRUE))),
                'status' => $this->input->post('status', TRUE),
            );
            if (!$this->Semester_model->is_exist($this->input->post('idsemester'))) {
                $this->Semester_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('periode'));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, idsemester is exist');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Semester_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('semester/update_action'),
                'idsemester' => set_value('idsemester', $row->idsemester),
                'nama_semester' => set_value('nama_semester', $row->nama_semester),
                'idperiode' => set_value('idperiode', $row->idperiode),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'tanggal_awal' => set_value('tanggal_awal', $row->tanggal_awal),
                'tanggal_akhir' => set_value('tanggal_akhir', $row->tanggal_akhir),
                'status' => set_value('status', $row->status),
            );
            $data['title'] = 'Semester';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'semester/Semester_form';
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
            $this->update($this->input->post('idsemester', TRUE));
        } else {
            $data = array(
                'idsemester' => $this->input->post('idsemester', TRUE),
                'nama_semester' => $this->input->post('nama_semester', TRUE),
                'idperiode' => $this->input->post('idperiode', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'tanggal_awal' => date('Y-m-d', strtotime($this->input->post('tanggal_awal', TRUE))),
                'tanggal_akhir' => date('Y-m-d', strtotime($this->input->post('tanggal_akhir', TRUE))),
                'status' => $this->input->post('status', TRUE),
            );

            $this->Semester_model->update($this->input->post('idsemester', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('periode'));
        }
    }

    public function delete($id)
    {
        $row = $this->Semester_model->get_by_id($id);

        if ($row) {
            $this->Semester_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('semester'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('semester'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Semester_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('idsemester', 'idsemester', 'trim|required');
        $this->form_validation->set_rules('nama_semester', 'nama semester', 'trim|required');
        $this->form_validation->set_rules('idperiode', 'idperiode', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
        $this->form_validation->set_rules('tanggal_awal', 'tanggal awal', 'trim|required');
        $this->form_validation->set_rules('tanggal_akhir', 'tanggal akhir', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('idsemester', 'idsemester', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Semester.php */
