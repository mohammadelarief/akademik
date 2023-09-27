<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $c_url = $this->router->fetch_class();
        // $this->layout->auth();
        // $this->layout->validate_token();
        // $this->layout->auth_privilege($c_url);
        $this->load->library('migration');
    }

    public function index()
    {
        $data['title'] = 'Migration';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Migration' => '',
        ];
        // Mendapatkan daftar semua file migrasi yang ada
        $migrations = $this->migration->find_migrations();

        // Menampilkan daftar file migrasi dan formulir pemilihan
        $data['migrations'] = $migrations;
        $data['page'] = 'migration_list';
        $this->load->view('template/backend', $data);
    }

    public function run_migration()
    {
        $version = $this->input->post('migration_version');
        // Melakukan migrasi ke versi tertentu
        if ($this->migration->version($version) === FALSE) {
            show_error('Error: ' . $this->migration->error_string());
        } else {
            redirect('dashboard');
            // echo 'Migration berhasil dijalankan.';
        }
    }

    public function migrate($versi)
    {

        if ($this->migration->version($versi) === FALSE) {
            show_error($this->migration->error_string());
        } else {
            redirect('dashboard');
        }
    }
}
