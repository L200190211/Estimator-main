<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Promo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_promo'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'kode_promo'       => [
                'type'           => 'varchar',
                'constraint'     => 30
            ],
            'diskon' => [
                'type'           => 'varchar',
                'constraint'     => 30,
            ],
            'id_supplier' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'tgl_mulai DATETIME',
            'tgl_akhir DATETIME',
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        // set Primary Key
        $this->forge->addKey('id_promo', TRUE);

        $this->forge->createTable('promo', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('promo');
    }
}
