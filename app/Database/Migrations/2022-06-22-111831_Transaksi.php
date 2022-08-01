<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_keranjang'       => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'status' => [
                'type'           => 'ENUM',
				'constraint'     => ['0', '1', '2', '3'],
				'default'        => '0',
            ],
            'total_harga' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'resi' => [
                'type'           => 'varchar',
                'constraint'     => 30,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        // set Primary Key
        $this->forge->addKey('id_transaksi', TRUE);

        $this->forge->createTable('transaksi', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
