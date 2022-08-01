<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KeranjangItem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_keranjang_item'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_keranjang'       => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'kuantitas' => [
                'type'           => 'varchar',
                'constraint'     => 20,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        // set Primary Key
        $this->forge->addKey('id_keranjang_item', TRUE);

        $this->forge->createTable('keranjang_item', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('keranjang_item');
    }
}
