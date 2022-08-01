<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tags extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tags'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'tags'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
            ],
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        // set Primary Key
        $this->forge->addKey('id_tags', TRUE);

        $this->forge->createTable('tags_produk', TRUE);
    }

        public function down()
        {
            $this->forge->dropTable('tags_produk');
        }
}
