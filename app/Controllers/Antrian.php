<?php

namespace App\Controllers;

class Antrian extends BaseController
{
    public function index()
    {
        $specializations = ['Umum', 'Bedah', 'Anak', 'Kandungan', 'Mata'];
        $data['antrian'] = [];

        foreach ($specializations as $specialization) {
            $query = $this->db->query("
                SELECT antrian.*, user_pasien.username AS nama_pasien, user_dokter.username AS nama_dokter, dokter.spesialisasi AS spesialisasi
                FROM antrian
                LEFT JOIN pasien ON antrian.id_pasien = pasien.id_user
                LEFT JOIN dokter ON antrian.id_dokter = dokter.id_user
                LEFT JOIN users AS user_pasien ON user_pasien.id_user = pasien.id_user
                LEFT JOIN users AS user_dokter ON user_dokter.id_user = dokter.id_user
                WHERE dokter.spesialisasi = '$specialization'
                ORDER BY id_antrian ASC
            ");
            
            $data['antrian'][$specialization] = $query->getResultArray();
        }
        return view('antrian/get', $data);
    }
    
    public function create()
    {
        $query = $this->db->query('SELECT dokter.*, users.username AS nama FROM dokter JOIN users ON dokter.id_user = users.id_user');
        $data['dokter'] = $query->getResult();
        return view('antrian/add', $data);
    }

    public function store()
    {
        $data = [
            'id_pasien' => session('id')->id_user,
            'id_dokter' => $this->request->getVar('dokter'),
            'keluhan' => $this->request->getVar('keluhan'),
            'tanggal' => date('Y-m-d H:i:s'),
        ];
        $query = $this->db->table('antrian')->where('id_pasien', $data['id_pasien'])->where('id_dokter', $data['id_dokter'])->get()->getResult();
        
        if (!empty($query)) {
            return redirect()->back()->with('error', 'Sudah memiliki antrian dengan dokter tersebut');
        } else {
            $this->db->table('antrian')->insert($data);
            if ($this->db->affectedRows() > 0){
                return redirect()->to(site_url('antrian'))->with('success', 'Data Berhasil Disimpan');
            }
        }        
    }

    public function destroy($id) 
    {
        $this->db->table('antrian')->where(['id_antrian' => $id])->delete();
        return redirect()->to(site_url('antrian'))->with('success', 'Data Berhasil Dihapus');
    }   
}