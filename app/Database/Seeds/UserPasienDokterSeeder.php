<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserPasienDokterSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => password_hash('admin', PASSWORD_BCRYPT),
            'role' => 'admin',
        ];
        $this->db->table('users')->insert($data);

        // Dokter Seed
        for ($i = 2; $i < 7; $i++) {
            $username = 'Dr. '. $faker->unique()->name;
            $data = [
                'username' => $username,
                'email' => $faker->unique()->email,
                'password' => password_hash('123', PASSWORD_BCRYPT),
                'role' => 'dokter',
            ];

            $this->db->table('users')->insert($data);

            $dataDokter = [
                'id_user' => $i,
                'spesialisasi' => $faker->unique()->randomElement(['Umum', 'Bedah', 'Anak', 'Kandungan', 'Mata']),
            ];

            $this->db->table('dokter')->insert($dataDokter);
        }

        // Pasien Seed
        for ($i = 7; $i < 71; $i++) {
            $username = $faker->unique()->name;
            $data = [
                'username' => $username,
                'email' => $faker->unique()->email,
                'password' => password_hash('123', PASSWORD_BCRYPT),
                'role' => 'pasien',
            ];

            $this->db->table('users')->insert($data);

            $dataPasien = [
                'id_user' => $i,
                'alamat' => $faker->address,
                'tanggal_lahir' => $faker->date,
            ];

            $this->db->table('pasien')->insert($dataPasien);
        }
    }
}
