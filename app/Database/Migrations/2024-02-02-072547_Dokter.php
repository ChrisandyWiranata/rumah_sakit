<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dokter extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'spesialisasi' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id_dokter', true);
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dokter');
    }

    public function down()
    {
        $this->forge->dropTable('dokter');
    }
}
