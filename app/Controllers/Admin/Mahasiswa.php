<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            $data['mahasiswa'] = $this->mahasiswaModel
                ->like('nim', $keyword)
                ->orLike('nama', $keyword)
                ->findAll();
        } else {
            $data['mahasiswa'] = $this->mahasiswaModel->findAll();
        }

        return view('admin/mahasiswa/index', $data);
    }

    public function create()
    {
        return view('admin/mahasiswa/create');
    }

    public function store()
    {
        $nim = $this->request->getPost('nim');

        // Validasi NIM unik
        if ($this->mahasiswaModel->find($nim)) {
            return redirect()->back()->with('error', 'NIM sudah terdaftar!');
        }

        $data = [
            'nim' => $nim,
            'nama' => $this->request->getPost('nama'),
        ];

        $this->mahasiswaModel->insert($data);
        return redirect()->to(base_url('admin/mahasiswa'))->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit($nim)
    {
        $data['mahasiswa'] = $this->mahasiswaModel->find($nim);

        if (!$data['mahasiswa']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Mahasiswa tidak ditemukan');
        }

        return view('admin/mahasiswa/edit', $data);
    }

    public function update($nim)
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
        ];

        $this->mahasiswaModel->update($nim, $data);
        return redirect()->to(base_url('admin/mahasiswa'))->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function delete($nim)
    {
        $this->mahasiswaModel->delete($nim);
        return redirect()->to(base_url('admin/mahasiswa'))->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
