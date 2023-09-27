<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Table_Sessions extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'id_users' => array(
                    'type' => 'INT',
                    'constraint' => '11'
                ),
                'username' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'tanggal' => array(
                    'type' => 'DATETIME'
                ),
                'last_login' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ),
                'token' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255'
                ),
            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_sessions');
    }
    public function down()
    {
        $this->dbforge->drop_table('tbl_sessions');
    }
}
