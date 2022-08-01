<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PromoProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_promo_produk'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_promo'       => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        // set Primary Key
        $this->forge->addKey('id_promo_produk', TRUE);

        $this->forge->createTable('promo_produk', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('promo_produk');
    }
}
