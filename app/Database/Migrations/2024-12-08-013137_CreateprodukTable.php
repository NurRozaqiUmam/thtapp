<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateprodukTable extends Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'nama_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ],
            'kategori_produk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ],
            'harga_beli' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            ],
            'harga_jual' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => FALSE
            ],
            'stok_produk' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
                'on_update' => 'CURRENT_TIMESTAMP'
            ],
        ]);

        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('produk');
    }

    public function down()
    {
        $this->dbforge->dropTable('produk');
    }
}
