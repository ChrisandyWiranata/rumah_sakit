<?php

namespace App\Controllers;

class Dokter extends BaseController
{
    public function index()
    {
        $id_user = session('id')->id_user;
        $query = $this->db->query("
            SELECT antrian.*, 
            users.username AS nama_pasien 
            FROM antrian 
            LEFT JOIN pasien ON antrian.id_pasien = pasien.id_user
            LEFT JOIN users ON pasien.id_user = users.id_user
            WHERE id_dokter = $id_user");  
        
        $data['antrian'] = $query->getResultArray();

        $query = $this->db->query("SELECT * FROM rekam_medis");
        $data['total'] = $query->getNumRows();
        $query = $this->db->query("SELECT * FROM users");
        $data['totalUsers'] = $query->getNumRows();
        
        return view('dokter/dokterHome', $data);
    }

    public function call() 
    {
        $id_user = session('id')->id_user;
        $query = $this->db->query("SELECT * FROM antrian WHERE id_dokter = $id_user AND status = 'menunggu' ORDER BY id_antrian ASC LIMIT 1");
        $data = $query->getRow();
        
        if ($data) {
            $this->db->table('antrian')
                     ->where('id_pasien', $data->id_pasien)
                     ->where('id_dokter', $id_user)
                     ->update(['status' => 'panggilan']);
    
            $query3 = $this->db->query("
                SELECT antrian.*, user_pasien.username AS nama_pasien, user_dokter.username AS nama_dokter, dokter.spesialisasi AS spesialisasi
                FROM antrian 
                LEFT JOIN pasien ON antrian.id_pasien = pasien.id_user
                LEFT JOIN dokter ON antrian.id_dokter = dokter.id_user
                LEFT JOIN users AS user_pasien ON user_pasien.id_user = pasien.id_user
                LEFT JOIN users AS user_dokter ON user_dokter.id_user = dokter.id_user
                WHERE antrian.id_pasien = $data->id_pasien AND antrian.id_dokter = $id_user
            ");
            
            $data2['rekam'] = $query3->getRow();
            return view('dokter/call', $data2);
        } else {
            return redirect()->to(site_url('dokter'))->with('error', 'Tidak ada antrian pasien');
        }
    } 
}
