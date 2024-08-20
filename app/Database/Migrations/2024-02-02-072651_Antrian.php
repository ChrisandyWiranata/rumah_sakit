<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Antrian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_antrian' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'keluhan' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['menunggu', 'panggilan', 'selesai'],
                'default' => 'menunggu'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id_antrian', true);
        $this->forge->createTable('antrian');
    }

    public function down()
    {
        $this->forge->dropTable('antrian');
    }
}
