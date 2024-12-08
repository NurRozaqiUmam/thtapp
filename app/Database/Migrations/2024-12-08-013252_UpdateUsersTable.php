<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        $fields = [
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE 
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE 
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => TRUE
            ],
        ];
        $this->dbforge->add_column('users', $fields);

        // Update data default untuk email dan password
        $this->db->set('email', 'default@example.com')
                 ->where('email IS NULL')
                 ->update('users');

        $this->db->set('password', 'default_password')
                 ->where('password IS NULL')
                 ->update('users');

        // Mengubah kolom email dan password menjadi NOT NULL
        $modify_fields = [
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ],
        ];
        $this->dbforge->modify_column('users', $modify_fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('users', 'email');
        $this->dbforge->drop_column('users', 'password');
        $this->dbforge->drop_column('users', 'token');
    }
}
