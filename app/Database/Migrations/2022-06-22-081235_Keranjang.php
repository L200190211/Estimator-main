<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keranjang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_keranjang'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_pembeli'       => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'id_promo'       => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'status' => [
                'type'           => 'ENUM',
				'constraint'     => ['belum checkout', 'sudah checkout'],
				'default'        => 'belum checkout',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        // set Primary Key
        $this->forge->addKey('id_keranjang', TRUE);

        $this->forge->createTable('keranjang', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('keranjang');
    }
}
