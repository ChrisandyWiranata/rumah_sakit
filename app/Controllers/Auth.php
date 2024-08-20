<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        return redirect()->to(site_url('login'));
    }

    public function register()
    {
        if (session('id')) {
            return redirect()->to(site_url('/'));
        }
        return view('auth/register');
    }
    
    public function registerProcess()
    {
        $role = $this->request->getVar('role');
        $username = $this->request->getVar('nama');
        if ($role == "dokter") {
            $username = 'Dr. '.$this->request->getVar('nama');
        }

        $data = [
            'username' => $username,
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'role' => $role,
        ];
        
        $query = $this->db->table('users')->getWhere(['email' => $data['email']]);
        
        if ($query->getNumRows() <= 0) {
            $this->db->table('users')->insert($data);

            $dataUser = $this->db->table('users')->orderBy('id_user', 'DESC')->get()->getRow();

            if ($role == 'pasien') {
                $dataPasien = [
                    'id_user' => $dataUser->id_user,
                    'alamat' => $this->request->getVar('alamat'),
                    'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                ];
                $this->db->table('pasien')->insert($dataPasien);
            } elseif ($role == 'dokter') {
                $dataDokter = [
                    'id_user' => $dataUser->id_user,
                    'spesialisasi' => $this->request->getVar('spesialisasi'),
                ];
                $this->db->table('dokter')->insert($dataDokter);
            }

            return redirect()->to(site_url('login'))->with('success', 'Pendaftaran berhasil! Silakan login.');
        } else {
            return redirect()->back()->with('error', 'Email sudah digunakan');
        }
    }
    
    public function login()
    {
        if (session('id')) {
            return redirect()->to(site_url('/'));
        }
        return view('auth/login');
    }
    
    public function loginProcess()
    {
        $data = $this->request->getPost();
        $query = $this->db->table('users')->getWhere(['email' => $data['email']]);
        $user = $query->getRow();
        if ($user) {
            if (password_verify($data['password'], $user->password)) {
                $params = ['id' => $user];
                session()->set($params);

                return redirect()->to(site_url('/'));
            } else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }
    }

    public function logout()
    {
        session()->remove('id');
        return redirect()->to(site_url('login'));
    }
}
