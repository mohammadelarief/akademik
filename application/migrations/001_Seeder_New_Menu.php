<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Seeder_New_Menu extends CI_Migration
{

    public function up()
    {
        // Data yang ingin Anda tambahkan ke tabel
        $data = array(
            'sort' => 1,
            'level' => 2,
            'parent_id' => 40,
            'icon' => 'fas fa-database',
            'label' => 'Migration',
            'link' => 'migration',
            'id' => '#',
            'id_menu_type' => 1
        );

        // Menambahkan data ke tabel 'nama_tabel'
        $this->db->insert('menu', $data);
        $primary_key = $this->db->insert_id();

        $datas = array(
            'id_groups' => 1,
            'id_menu' => $primary_key,
        );
        $this->db->insert('groups_menu', $datas);
        // Jika Anda ingin menambahkan beberapa data sekaligus, Anda dapat menggunakan insert_batch
        // $data_batch = array(
        //     array('nama' => 'Nama1', 'email' => 'email1@example.com', 'telepon' => '123-456-7891'),
        //     array('nama' => 'Nama2', 'email' => 'email2@example.com', 'telepon' => '123-456-7892'),
        //     // ... tambahkan data lainnya
        // );
        // $this->db->insert_batch('nama_tabel', $data_batch);
    }

    public function down()
    {
        // Jika Anda ingin menghapus data yang telah ditambahkan saat migrasi dirollback,
        // Anda dapat menggunakan $this->db->delete()
        // Contoh:
        // $this->db->where('nama', 'John Doe');
        // $this->db->delete('nama_tabel');

        // Atau Anda dapat membuat skrip rollback yang sesuai dengan kebutuhan Anda.
    }
}
