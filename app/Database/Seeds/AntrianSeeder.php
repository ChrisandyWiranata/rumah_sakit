<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AntrianSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        $query = $this->db->query("SELECT * FROM users WHERE role = 'pasien'");
        $rowCountAntrian = $query->getNumRows();
        
        $pasienIds = $this->db->table('users')->where('role', 'pasien')->select('id_user')->get()->getResultArray();
        $dokterIds = $this->db->table('users')->where('role', 'dokter')->select('id_user')->get()->getResultArray();

        for ($i = 0; $i < $rowCountAntrian; $i++) { 
            $data = [
                'id_pasien' => $pasienIds[array_rand($pasienIds)]['id_user'],
                'id_dokter' => $dokterIds[array_rand($dokterIds)]['id_user'],
                'tanggal' => date('Y-m-d'),
                'tanggal' => $faker->dateTimeBetween('-10 years', 'now')->format('Y-m-d'),
                'keluhan' => $faker->sentence(),
                'status' => 'selesai',
                'created_at' => $faker->dateTimeBetween('-4 years', 'now')->format('Y-m-d H:i:s'),
            ];
            
            $this->db->table('antrian')->insert($data);
        };
    }
}