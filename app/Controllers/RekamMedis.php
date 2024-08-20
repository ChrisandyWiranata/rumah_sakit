<?php

namespace App\Controllers;

class RekamMedis extends BaseController
{
    public function index()
    {
        //
    }

    public function make()
    {
        $id_user = session('id')->id_user;
        $query = $this->db->query("
            SELECT * FROM antrian 
            WHERE id_dokter = $id_user AND status = 'panggilan' 
            ORDER BY id_antrian ASC LIMIT 1
            ");
        $data = $query->getRow();

        $que = $this->db->query("SELECT * FROM antrian WHERE id_dokter = $id_user AND status = 'panggilan' ORDER BY id_antrian ASC LIMIT 1");
        $data1 = $que->getRow();

        $query2 = $this->db->query("
            SELECT antrian.* , user_pasien.username AS nama_pasien, user_dokter.username AS nama_dokter, dokter.spesialisasi AS spesialisasi
            FROM antrian
            LEFT JOIN pasien ON antrian.id_pasien = pasien.id_user
            LEFT JOIN dokter ON antrian.id_dokter = dokter.id_user
            LEFT JOIN users AS user_pasien ON user_pasien.id_user = pasien.id_user
            LEFT JOIN users AS user_dokter ON user_dokter.id_user = dokter.id_user
            WHERE antrian.id_pasien = $data1->id_pasien AND antrian.id_dokter = $data1->id_dokter
        ");
        $data2 = $query2->getRow();
        print_r($data2);

        $data3 = [
            'id_antrian' => $data2->id_antrian,
            'nama_pasien' => $data2->nama_pasien,
            'nama_dokter' => $data2->nama_dokter,
            'kategori' => $data2->spesialisasi,
            'keluhan' => $data2->keluhan,
            'tindakan' => $this->request->getVar('tindakan'),
        ];
        $this->db->table('antrian')->where('id_pasien', $data->id_pasien)->where('id_dokter', $id_user)->update(['status' => 'selesai']);
        $this->db->table('rekam_medis')->insert($data3);

        return redirect()->to(site_url('home'))->with('success', 'Rekam Medis sudah tercatat');
    }
}
