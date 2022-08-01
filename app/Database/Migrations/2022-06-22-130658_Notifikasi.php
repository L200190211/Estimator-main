<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notifikasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_notifikasi'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_pengguna'       => [
                'type'           => 'int',
                'constraint'     => 11
            ],
            'title' => [
                'type'           => 'varchar',
                'constraint'     => 255,
            ],
            'content' => [
                'type'           => 'text'
            ],
            'isRead' => [
                'type'           => 'varchar',
                'constraint'     => 255,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT NULL'
        ]);

        // set Primary Key
        $this->forge->addKey('id_notifikasi', TRUE);

        $this->forge->createTable('notifikasi', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('notifikasi');
    }
}
