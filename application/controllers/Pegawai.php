<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->validate_token();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Pegawai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Pegawai' => '',
        ];
        $data['code_js'] = 'pegawai/codejs';
        $data['page'] = 'pegawai/Pegawai_list';
        $data['filter'] = 'template/filter';
        $data['modal'] = 'pegawai/Pegawai_modal';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Pegawai_model->json();
    }

    public function json_get()
    {
        $id = $this->input->post("id");
        $row = $this->Pegawai_model->get_by_id($id);

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
                $id = $this->input->post('idpeg', TRUE);
                $data = array(
                    'idpeg' => $this->input->post('idpeg', TRUE),
                    'idperson' => $this->input->post('idperson', TRUE),
                    'idsemester' => $this->input->post('idsemester', TRUE),
                    'idunit' => $this->input->post('idunit', TRUE),
                );

                $update = $this->Pegawai_model->update($id, $data);
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
                    'idpeg' => $this->input->post('idpeg', TRUE),
                    'idperson' => $this->input->post('idperson', TRUE),
                    'idsemester' => $this->input->post('idsemester', TRUE),
                    'idunit' => $this->input->post('idunit', TRUE),
                );
                if (!$this->Pegawai_model->is_exist($this->input->post('idpeg'))) {

                    $insert = $this->Pegawai_model->insert($data);
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
        $smsaktif = get_aktif_table('tbl_semester', 'idsemester', 'status', 1);
        $response = array(
            'hasil' => $result,
            'smsaktif' => $smsaktif
        );
        echo json_encode($response);
    }

    function get_autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->Pegawai_model->search_idperson($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'value' => $row->idperson,
                        'label'    => $row->nama,
                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function read($id)
    {
        $row = $this->Pegawai_model->get_by_id($id);
        if ($row) {
            $data = array(
                'idpeg' => $row->idpeg,
                'idperson' => $row->idperson,
                'idsemester' => $row->idsemester,
                'idunit' => $row->idunit,
            );
            $data['title'] = 'Pegawai';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'pegawai/Pegawai_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pegawai/create_action'),
            'idpeg' => set_value('idpeg'),
            'idperson' => set_value('idperson'),
            'idsemester' => set_value('idsemester'),
            'idunit' => set_value('idunit'),
        );
        $data['title'] = 'Pegawai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pegawai/Pegawai_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'idpeg' => $this->input->post('idpeg', TRUE),
                'idperson' => $this->input->post('idperson', TRUE),
                'idsemester' => $this->input->post('idsemester', TRUE),
                'idunit' => $this->input->post('idunit', TRUE),
            );
            if (!$this->Pegawai_model->is_exist($this->input->post('idpeg'))) {
                $this->Pegawai_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('pegawai'));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, idpeg is exist');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pegawai/update_action'),
                'idpeg' => set_value('idpeg', $row->idpeg),
                'idperson' => set_value('idperson', $row->idperson),
                'idsemester' => set_value('idsemester', $row->idsemester),
                'idunit' => set_value('idunit', $row->idunit),
            );
            $data['title'] = 'Pegawai';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'pegawai/Pegawai_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idpeg', TRUE));
        } else {
            $data = array(
                'idpeg' => $this->input->post('idpeg', TRUE),
                'idperson' => $this->input->post('idperson', TRUE),
                'idsemester' => $this->input->post('idsemester', TRUE),
                'idunit' => $this->input->post('idunit', TRUE),
            );

            $this->Pegawai_model->update($this->input->post('idpeg', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pegawai'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pegawai_model->get_by_id($id);

        if ($row) {
            $this->Pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Pegawai_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('idpeg', 'idpeg', 'trim|required');
        $this->form_validation->set_rules('idperson', 'idperson', 'trim|required');
        $this->form_validation->set_rules('idsemester', 'idsemester', 'trim|required');
        $this->form_validation->set_rules('idunit', 'idunit', 'trim|required');

        $this->form_validation->set_rules('idpeg', 'idpeg', 'trim');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }
}

/* End of file Pegawai.php */
