<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rekam extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rekam_medis' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_antrian' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'nama_pasien' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_dokter' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'keluhan' => [
                'type' => 'TEXT',
            ],
            'tindakan' => [
                'type' => 'TEXT'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id_rekam_medis', true);
        $this->forge->addForeignKey('id_antrian', 'antrian', 'id_antrian', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rekam_medis');
    }

    public function down()
    {
        $this->forge->dropTable('rekam_medis');
    }
}
