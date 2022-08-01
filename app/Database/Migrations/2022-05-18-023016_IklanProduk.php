<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IklanProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_iklan'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_produk'       => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'id_paket' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'expired DATETIME',
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        // set Primary Key
        $this->forge->addKey('id_iklan', TRUE);

        $this->forge->createTable('iklan_produk', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('iklan_produk');
    }
}
