<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DiskonProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_diskon'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_produk'       => [
                'type'           => 'varchar',
                'constraint'     => 30
            ],
            'diskon' => [
                'type'           => 'varchar',
                'constraint'     => 30,
            ],
            'tgl_mulai DATETIME',
            'tgl_akhir DATETIME',
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        // set Primary Key
        $this->forge->addKey('id_diskon', TRUE);

        $this->forge->createTable('diskon_produk', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('diskon_produk');
    }
}
