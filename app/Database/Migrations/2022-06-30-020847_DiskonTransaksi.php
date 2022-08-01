<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DiskonTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                 => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_user'       => [
                'type'           => 'int',
                'constraint'     => 11
            ],
            'id_promo' => [
                'type'           => 'int',
                'constraint'     => 11,
            ],
            'id_transaksi' => [
                'type'           => 'int',
                'constraint'     => 11,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        $this->forge->createTable('diskon_transaksi', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('diskon_transaksi');
    }
}
