<?php

namespace App\Controllers;

class Pasien extends BaseController
{
    public function index()
    {
        $query1 = $this->db->query("SELECT * FROM rekam_medis");
        $data['total'] = $query1->getNumRows();

        $query2 = $this->db->query("SELECT * FROM users");
        $data['totalUsers'] = $query2->getNumRows();

        $nama_pasien = session('id')->username;
        $query3 = $this->db->query("SELECT * FROM rekam_medis WHERE nama_pasien = '$nama_pasien'");
        $data['pasien'] = $query3->getResult();
        $data['total_rekam_medis'] = $query3->getNumRows();

        return view('pasien/pasienHome', $data);
    }
}
