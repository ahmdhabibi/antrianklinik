<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PasienModel;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->pasien = new PasienModel();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        if ($this->session->level == 3) {
            $dtPasien = $this->pasien->getPasien($this->session->nama)->getResult()[0];
        } else {
            $dtPasien = [];
        }
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Profile',
            'nama_submenu' => '',
            'heading' => 'Profile',
            'tittle' => 'Halaman Profile',
            'pasien' => $dtPasien
        ];
        return view('shared_pages/profile', $data);
    }
    public function ubahpassword()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Ubah Password',
            'nama_submenu' => '',
            'heading' => 'Form Ubah Password',
            'tittle' => 'Halaman Ubah Password'
        ];
        return view('shared_pages/ubah_password', $data);
    }
    public function update_password()
    {
        $data = $this->request->getPost();
        if ($data['pss1'] != $data['pss2']) {
            $_SESSION['color'] = 'danger';
            session()->setFlashdata('notif', 'Password dan konfirmasinya tidak sama');
            return redirect()->back();
        }
        $user = $this->user->getUser($this->session->username)->getResult();
        if (count($user) > 0) {
            $id = $user[0]->id;
        }
        $pssbaru = password_hash($data['pss1'], PASSWORD_BCRYPT);
        $user = $this->user->find($id);
        unset($user->password);
        if (!isset($user->password)) {
            $user->password = $pssbaru;
        }
        $this->user->save($user);
        $_SESSION['color'] = 'success';
        session()->setFlashdata('notif', 'Password berhasil diupdate');
        return redirect()->to('/profile');
    }
    public function editprofile()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Profile',
            'nama_submenu' => '',
            'heading' => 'Form Edit Profile',
            'tittle' => 'Halaman Ubah Profile',
            'pasien' => $this->pasien->getPasien($this->session->nama)->getResult()[0]
        ];
        return view('shared_pages/edit_profile', $data);
    }
    public function update()
    {
        $dataInput = $this->request->getPost();
        $berhasil = $this->pasien->update($dataInput['id'], [
            'nik' => $dataInput['nik'],
            'nama' => $dataInput['nama'],
            'tgl_lahir' => $dataInput['tgl_lahir'],
            'umur' => $dataInput['umur'],
            'gender' => $dataInput['gender'],
            'telp' => $dataInput['telp'],
            'alamat' => $dataInput['alamat'],
            'status_pasien' => $dataInput['status_pasien'],
            'nomor_bpjs' => $dataInput['nomor_bpjs'],
        ]);
        if ($berhasil) {
            // mengupdate ke tabel user 
            $user = $this->user->getUser($this->session->username)->getResult();
            if (count($user) > 0) {
                $user = $user[0];
            }
            $this->user->update($user->id, [
                'nama' => $dataInput['nama'],
                // uncomment jika usernamenya ingin menggunakan NIK pasien 
                // 'username' => $dataInput['nik']
            ]);
            // set session baru
            $dtuser = [
                'nama'        => $dataInput['nama'],
                'username'    => $this->session->username, // jika username berubah hrs disesuaikan
                'level'       => $this->session->username,
                'nama_level'  => $this->session->nama_level,
                'sdh_login'   => true
            ];
            $this->session->set($dtuser);
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data pasien berhasil diupdate, Silahkan logout dan login ulang');
            return redirect()->to('/profile');
        }
    }
}
