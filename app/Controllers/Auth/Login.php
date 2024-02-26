<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LevelModel;
use App\Models\AksesModel;
use App\Models\PasienModel;

class Login extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->pasienModel = new PasienModel();
        $this->levelModel = new LevelModel();
        $this->aksesModel = new AksesModel();
        $this->validation = \Config\Services::validation();
        $this->errors = $this->validation->getErrors();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        return view('auth/login');
    }
    public function ceklogin()
    {
        $this->session;
        $dataLogin = $this->request->getPost();
        // cek data user 
        $user = $this->userModel->getUser($dataLogin['username'])->getResult();
        if (count($user) > 0) {
            $user = $user[0];
        }
        // jika akun tdk ditemukan 
        if (!$user) {
            $_SESSION['color'] = 'danger';
            $this->session->setFlashdata('notif', 'Akun tidak ditemukan');
            return redirect()->back();
        }
        // jika password salah  
        if (!password_verify($dataLogin['pss'], $user->password)) {
            $_SESSION['color'] = 'danger';
            $this->session->setFlashdata('notif', 'Username atau password salah');
            return redirect()->back();
        }
        // jika akun blm aktif 
        if ($user->status !== '1') {
            $_SESSION['color'] = 'danger';
            $this->session->setFlashdata('notif', 'Akun belum aktif');
            return redirect()->back();
        }
        // jika user sesuai
        $dtuser = [
            'nama'        => $user->nama,
            'username'    => $user->username,
            'level'       => $user->level,
            'nama_level'  => $user->nama_level,
            'sdh_login'   => true
        ];
        $this->session->set($dtuser);
        $_SESSION['color'] = 'success';
        $this->session->setFlashdata('notif', 'Login Berhasil');
        if ($this->session->level == 1) {
            return redirect()->to('/dashboard');
        } else if ($this->session->level == 2) {
            return redirect()->to('/profile');
        } else if ($this->session->level == 3) {
            return redirect()->to('/guest/jadwal_pelayanan');
        } else if ($this->session->level == 6) {
            return redirect()->to('/apoteker');
        }
    }
    public function register()
    {
        return view('auth/register');
    }
    public function simpan()
    {
        $dataInput = $this->request->getPost();
        $pss1 = $dataInput['pss1'];
        $pss2 = $dataInput['pss2'];

        if ($pss1 != $pss2) {
            $_SESSION['color'] = 'danger';
            $this->session->setFlashdata('notif', 'Password dan konfirmasinya tidak sama');
            return redirect()->back()->withInput();
        }

        // menyimpan ke tabel user 
        $this->userModel->save([
            'id' => service('uuid')->uuid4()->toString(),
            'nama' => $dataInput['nama'],
            'username' => $dataInput['username'],
            'password' => password_hash($dataInput['pss1'], PASSWORD_BCRYPT),
            'level' => 3,
            'status' => 1
        ]);
        // menyimpan ke tabel pasien 
        $berhasil = $this->pasienModel->save([
            'id' => service('uuid')->uuid4()->toString(),
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
        $_SESSION['color'] = 'success';
        $this->session->setFlashdata('notif', 'Registrsi Berhasil , Silahkan Login');
        return redirect()->to('/login')->withInput();
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
