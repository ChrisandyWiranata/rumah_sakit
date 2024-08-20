<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected function executeQuery($query)
    {
        return $this->db->query($query);
    }

    public function index()
    {
        $data['total'] = $this->executeQuery("SELECT * FROM rekam_medis")->getNumRows();
        $data['totalUsers'] = $this->executeQuery("SELECT * FROM users")->getNumRows();

        $kategori = $this->request->getVar('categorySelect');
        $data['total_rekam_medis_category'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE kategori = '$kategori'")->getNumRows();

        $data['kategori'] = $this->executeQuery("SELECT kategori FROM rekam_medis WHERE kategori = '$kategori'")->getRow();

        $namaPasien = $this->request->getVar('nama');
        $data['total_rekam_medis_pasien'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE nama_pasien = '$namaPasien'")->getNumRows();

        // Chart
        $query = "SELECT YEAR(created_at) AS year, COUNT(*) AS total_records FROM rekam_medis GROUP BY YEAR(created_at)";
        $result = $this->executeQuery($query)->getResult();
    
        $years = [];
        $totals = [];
        foreach ($result as $row) {
            $years[] = $row->year;
            $totals[] = $row->total_records;
        }
    
        $data['chart_years'] = json_encode($years);
        $data['chart_totals'] = json_encode($totals);

        return view('admin/adminHome', $data);
    }

    public function find_category()
    {
        $data['total'] = $this->executeQuery("SELECT * FROM rekam_medis")->getNumRows();
        $data['totalUsers'] = $this->executeQuery("SELECT * FROM users")->getNumRows();

        $kategori = $this->request->getVar('categorySelect');
        $data['total_rekam_medis_category'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE kategori = '$kategori'")->getNumRows();

        $data['kategori'] = $this->executeQuery("SELECT kategori FROM rekam_medis WHERE kategori = '$kategori'")->getRow();

        $namaPasien = $this->request->getVar('nama');
        $data['total_rekam_medis_pasien'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE nama_pasien = '$namaPasien'")->getNumRows();

        // Chart
        $query = "SELECT YEAR(created_at) AS year, COUNT(*) AS total_records FROM rekam_medis GROUP BY YEAR(created_at)";
        $result = $this->executeQuery($query)->getResult();
    
        $years = [];
        $totals = [];
        foreach ($result as $row) {
            $years[] = $row->year;
            $totals[] = $row->total_records;
        }
    
        $data['chart_years'] = json_encode($years);
        $data['chart_totals'] = json_encode($totals);

        $kategori = $this->request->getVar('categorySelect');
        $data['total_rekam_medis_category'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE kategori = '$kategori'")->getNumRows();
        $data['kategori'] = $this->executeQuery("SELECT kategori FROM rekam_medis WHERE kategori = '$kategori'")->getRow();

        // Rekam Medis
        $data['rekam_medis_kategori'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE kategori = '$kategori'")->getResult();
        
        return view('admin/adminHome', $data);
    }

    public function find_pasien()
    {
        $data['total'] = $this->executeQuery("SELECT * FROM rekam_medis")->getNumRows();
        $data['totalUsers'] = $this->executeQuery("SELECT * FROM users")->getNumRows();

        $kategori = $this->request->getVar('categorySelect');
        $data['total_rekam_medis_category'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE kategori = '$kategori'")->getNumRows();

        $data['kategori'] = $this->executeQuery("SELECT kategori FROM rekam_medis WHERE kategori = '$kategori'")->getRow();

        $namaPasien = $this->request->getVar('nama');
        $data['total_rekam_medis_pasien'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE nama_pasien = '$namaPasien'")->getNumRows();

        // Chart
        $query = "SELECT YEAR(created_at) AS year, COUNT(*) AS total_records FROM rekam_medis GROUP BY YEAR(created_at)";
        $result = $this->executeQuery($query)->getResult();
    
        $years = [];
        $totals = [];
        foreach ($result as $row) {
            $years[] = $row->year;
            $totals[] = $row->total_records;
        }
    
        $data['chart_years'] = json_encode($years);
        $data['chart_totals'] = json_encode($totals);

        $namaPasien = $this->request->getVar('nama');
        $data['total_rekam_medis_pasien'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE nama_pasien = '$namaPasien'")->getNumRows();
        $data['nama_pasien'] = $this->executeQuery("SELECT nama_pasien FROM rekam_medis WHERE nama_pasien = '$namaPasien'")->getRow();

        $data['rekam_medis_pasien'] = $this->executeQuery("SELECT * FROM rekam_medis WHERE nama_pasien = '$namaPasien'")->getResult();

        if (empty($data['nama_pasien'])) {
            return redirect()->to(site_url('admin'))->with('error', 'Nama pasien tidak ditemukan');
        } else {
            return view('admin/adminHome', $data);
        }
    }
}
