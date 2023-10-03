<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->validate_token();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Siswa_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Siswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Siswa' => '',
        ];
        $data['code_js'] = 'siswa/codejs';
        $data['page'] = 'siswa/Siswa_list';
        $data['filter'] = 'template/filter';
        $data['modal'] = 'siswa/Siswa_modal';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Siswa_model->json();
    }

    public function json_get()
    {
        $id = $this->input->post("id");
        $row = $this->Siswa_model->get_by_id($id);

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
                $id = $this->input->post('idsiswa', TRUE);
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

                $update = $this->Siswa_model->update($id, $data);
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
                if (!$this->Siswa_model->is_exist($this->input->post('idsiswa'))) {
                    $insert = $this->Siswa_model->insert($data);
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
                } else {
                    $data['status'] = false;
                    $data['msg'] = 'idsiswa is exist';
                }
            }
        }
        echo json_encode($data);
    }

    public function uniqid()
    {
        $var = $this->input->post('_uniq');
        $result = _unix_id($var);
        $response = array(
            'hasil' => $result
        );
        echo json_encode($response);
    }

    function get_kelas()
    {
        $idunit = $this->input->post('idunit');
        $periode = $this->input->post('periode');
        // print_r($idunit);
        $data = $this->Siswa_model->getKelas($idunit, $periode);
        echo json_encode($data);
    }

    public function read($id)
    {
        $row = $this->Siswa_model->get_by_id($id);
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
            $data['title'] = 'Siswa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'siswa/Siswa_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('siswa/create_action'),
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
        $data['title'] = 'Siswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'siswa/Siswa_form';
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
            if (!$this->Siswa_model->is_exist($this->input->post('idsiswa'))) {
                $this->Siswa_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('siswa'));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, idsiswa is exist');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('siswa/update_action'),
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
            $data['title'] = 'Siswa';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'siswa/Siswa_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
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

            $this->Siswa_model->update($this->input->post('idsiswa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siswa'));
        }
    }

    public function delete($id)
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $this->Siswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswa'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Siswa_model->deletebulk();
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
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }
}

/* End of file Siswa.php */
