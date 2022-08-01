<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembeli extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembeli'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'username'       => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        // set Primary Key
        $this->forge->addKey('id_pembeli', TRUE);

        $this->forge->createTable('pembeli', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('keranjang');
    }
}
