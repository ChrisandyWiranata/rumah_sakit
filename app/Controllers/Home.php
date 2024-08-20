<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $query = $this->db->query("SELECT * FROM rekam_medis");
        $data['total'] = $query->getNumRows();
        $query = $this->db->query("SELECT * FROM users");
        $data['totalUsers'] = $query->getNumRows();

        if (!session('id')) {
            return view('auth/login');
        }

        if (session('id')->role == 'pasien') {
            return redirect()->to('pasien');
        } elseif (session('id')->role == 'admin') {
            return redirect()->to('admin');
        } elseif (session('id')->role == 'dokter') {
            return redirect()->to('dokter');
        }
    }
}
