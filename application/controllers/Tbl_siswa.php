<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->validate_token();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Tbl_siswa_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Tbl Siswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Tbl Siswa' => '',
        ];
        $data['code_js'] = 'tbl_siswa/codejs';
        $data['page'] = 'tbl_siswa/Tbl_siswa_list';
        $data['modal'] = 'tbl_siswa/Tbl_siswa_modal';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Tbl_siswa_model->json();
    }

    public function json_get()
    {
        $id = $this->input->post("id");
        $row = $this->Tbl_siswa_model->get_by_id($id);

        echo json_encode($row);
    }
    public function json_update()
    {
        $this->_rules();
        if ($this->form_validation->run() === FALSE) {
            echo json_encode(array("status" => FALSE, "error" => validation_errors()));
        } else {
            $act = isset($_POST['actions']) ? $_POST['actions'] : '';
            if ($act == 'Edit') {
                $id = $this->input->post('idsiswa', TRUE);
                $data = array(
                    // 'idsiswa' => $this->input->post('idsiswa', TRUE),
                    'idperson' => $this->input->post('idperson', TRUE),
                    'idkelas' => $this->input->post('idkelas', TRUE),
                    'tgl_masuk' => $this->input->post('tgl_masuk', TRUE),
                    'info1' => $this->input->post('info1', TRUE),
                    'info2' => $this->input->post('info2', TRUE),
                    'user1' => $this->input->post('user1', TRUE),
                    'tgl_insert' => $this->input->post('tgl_insert', TRUE),
                    'tglUpdate' => $this->input->post('tglUpdate', TRUE),
                    'status' => $this->input->post('status', TRUE),
                );

                $update = $this->Tbl_siswa_model->update($id, $data);
                echo json_encode(array("status" => TRUE));
            }
            if ($update) {
                echo json_encode(array("status" => TRUE));
            } else {
                echo json_encode(array("status" => FALSE, "error" => "Failed to update data"));
            }
        }
    }


    public function read($id)
    {
        $row = $this->Tbl_siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
                'idsiswa' => $row->idsiswa,
                'idperson' => $row->idperson,
                'idkelas' => $row->idkelas,
                'tgl_masuk' => $row->tgl_masuk,
                'info1' => $row->info1,
                'info2' => $row->info2,
                'user1' => $row->user1,
                'tgl_insert' => $row->tgl_insert,
                'tglUpdate' => $row->tglUpdate,
                'status' => $row->status,
            );
            $data['title'] = 'Tbl Siswa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'tbl_siswa/Tbl_siswa_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_siswa'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_siswa/create_action'),
            'idsiswa' => set_value('idsiswa'),
            'idperson' => set_value('idperson'),
            'idkelas' => set_value('idkelas'),
            'tgl_masuk' => set_value('tgl_masuk'),
            'info1' => set_value('info1'),
            'info2' => set_value('info2'),
            'user1' => set_value('user1'),
            'tgl_insert' => set_value('tgl_insert'),
            'tglUpdate' => set_value('tglUpdate'),
            'status' => set_value('status'),
        );
        $data['title'] = 'Tbl Siswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'tbl_siswa/Tbl_siswa_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'idsiswa' => $this->input->post('idsiswa', TRUE),
                'idperson' => $this->input->post('idperson', TRUE),
                'idkelas' => $this->input->post('idkelas', TRUE),
                'tgl_masuk' => $this->input->post('tgl_masuk', TRUE),
                'info1' => $this->input->post('info1', TRUE),
                'info2' => $this->input->post('info2', TRUE),
                'user1' => $this->input->post('user1', TRUE),
                'tgl_insert' => $this->input->post('tgl_insert', TRUE),
                'tglUpdate' => $this->input->post('tglUpdate', TRUE),
                'status' => $this->input->post('status', TRUE),
            );
            if (!$this->Tbl_siswa_model->is_exist($this->input->post('idsiswa'))) {
                $this->Tbl_siswa_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('tbl_siswa'));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, idsiswa is exist');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Tbl_siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_siswa/update_action'),
                'idsiswa' => set_value('idsiswa', $row->idsiswa),
                'idperson' => set_value('idperson', $row->idperson),
                'idkelas' => set_value('idkelas', $row->idkelas),
                'tgl_masuk' => set_value('tgl_masuk', $row->tgl_masuk),
                'info1' => set_value('info1', $row->info1),
                'info2' => set_value('info2', $row->info2),
                'user1' => set_value('user1', $row->user1),
                'tgl_insert' => set_value('tgl_insert', $row->tgl_insert),
                'tglUpdate' => set_value('tglUpdate', $row->tglUpdate),
                'status' => set_value('status', $row->status),
            );
            $data['title'] = 'Tbl Siswa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'tbl_siswa/Tbl_siswa_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_siswa'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idsiswa', TRUE));
        } else {
            $data = array(
                'idsiswa' => $this->input->post('idsiswa', TRUE),
                'idperson' => $this->input->post('idperson', TRUE),
                'idkelas' => $this->input->post('idkelas', TRUE),
                'tgl_masuk' => $this->input->post('tgl_masuk', TRUE),
                'info1' => $this->input->post('info1', TRUE),
                'info2' => $this->input->post('info2', TRUE),
                'user1' => $this->input->post('user1', TRUE),
                'tgl_insert' => $this->input->post('tgl_insert', TRUE),
                'tglUpdate' => $this->input->post('tglUpdate', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->Tbl_siswa_model->update($this->input->post('idsiswa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_siswa'));
        }
    }

    public function delete($id)
    {
        $row = $this->Tbl_siswa_model->get_by_id($id);

        if ($row) {
            $this->Tbl_siswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_siswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_siswa'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Tbl_siswa_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('idsiswa', 'idsiswa', 'trim|required');
        $this->form_validation->set_rules('idperson', 'idperson', 'trim|required');
        $this->form_validation->set_rules('idkelas', 'idkelas', 'trim|required');
        $this->form_validation->set_rules('tgl_masuk', 'tgl masuk', 'trim|required');
        $this->form_validation->set_rules('info1', 'info1', 'trim|required');
        $this->form_validation->set_rules('info2', 'info2', 'trim|required');
        $this->form_validation->set_rules('user1', 'user1', 'trim|required');
        $this->form_validation->set_rules('tgl_insert', 'tgl insert', 'trim|required');
        $this->form_validation->set_rules('tglUpdate', 'tglupdate', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('idsiswa', 'idsiswa', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Tbl_siswa.php */
