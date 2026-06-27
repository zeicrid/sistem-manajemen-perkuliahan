<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->session = session();
        $this->userModel = new UserModel();
    }

    // Halaman login
    public function index()
    {
        return view('auth/login');
    }

    // Proses login
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan.');
        }

        // cek password (bcrypt atau md5)
        if (password_verify($password, $user['password']) || md5($password) === $user['password']) {

            // jika role mahasiswa, coba ambil nim dari tabel mahasiswa berdasarkan kode_peran
            $nim = null;
            if ($user['role'] === 'mahasiswa') {
                $db = \Config\Database::connect();
                $mahasiswa = $db->table('mahasiswa')
                    ->where('nim', $user['kode_peran'])
                    ->get()
                    ->getRow();

                if (!$mahasiswa) {
                    $mahasiswa = $db->table('mahasiswa')
                        ->where('nama', $user['nama_user'])
                        ->get()
                        ->getRow();
                }

                if ($mahasiswa) {
                    $nim = $mahasiswa->nim;
                }
            }

            $this->session->set([
                'isLoggedIn' => true,
                'id_user'    => $user['id_user'],
                'nama_user'  => $user['nama_user'],
                'role'       => $user['role'],
                'kode_peran' => $user['kode_peran'],
                'nim'        => $nim,
            ]);

            // redirect ke dashboard sesuai role
            switch ($user['role']) {
                case 'admin':
                    return redirect()->to('/admin');
                case 'mahasiswa':
                    return redirect()->to('/mahasiswa');
                case 'dosen':
                    return redirect()->to('/dosen');
                default:
                    return redirect()->to('/');
            }
        }

        return redirect()->back()->with('error', 'Password salah.');
    }

    public function logout()
    {
        // Pastikan session ada
        $this->session->destroy();
        return redirect()->to('/')->with('success', 'Berhasil logout.');
    }
}
