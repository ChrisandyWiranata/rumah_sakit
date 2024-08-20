<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RekamMedisSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $antrianData = $this->db->table('antrian')
            ->join('users as pasien', 'pasien.id_user = antrian.id_pasien')
            ->join('users as dokter', 'dokter.id_user = antrian.id_dokter')
            ->join('dokter as dokter_details', 'dokter_details.id_user = dokter.id_user')
            ->select('antrian.*, pasien.username as nama_pasien, dokter.username as nama_dokter, dokter_details.spesialisasi')
            ->get()
            ->getResultArray();

        foreach ($antrianData as $data) {
            $rekamMedis = [
                'id_antrian' => $data['id_antrian'],
                'nama_pasien' => $data['nama_pasien'],
                'nama_dokter' => $data['nama_dokter'],
                'kategori' => $data['spesialisasi'],
                'keluhan' => $data['keluhan'],
                'tindakan' => $faker->sentence(),
                'created_at' => $data['created_at'],
            ];

            $this->db->table('rekam_medis')->insert($rekamMedis);
        }
    }
}
