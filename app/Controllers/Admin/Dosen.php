<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;

class Dosen extends BaseController
{
    public function index()
    {
        $model = new DosenModel();
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['dosen'] = $model->like('nidn', $keyword)
                                   ->orLike('nama', $keyword)
                                   ->orLike('email', $keyword)
                                   ->orLike('no_telp', $keyword)
                                   ->findAll();
        } else {
            $data['dosen'] = $model->findAll();
        }

        return view('admin/dosen/index', $data);
    }

    public function create()
    {
        return view('admin/dosen/create');
    }

    public function store()
    {
        $model = new DosenModel();

        $rules = [
            'nidn' => 'required|numeric|max_length[10]|is_unique[dosen.nidn]',
            'nama' => 'required',
            'email' => 'required|valid_email',
            'no_telp' => 'required|numeric|max_length[15]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan semua kolom diisi dengan benar.');
        }

        $model->insert([
            'nidn' => $this->request->getPost('nidn'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp')
        ]);

        return redirect()->to('/admin/dosen')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit($nidn)
    {
        $model = new DosenModel();
        $data['dosen'] = $model->find($nidn);

        if (!$data['dosen']) {
            return redirect()->to('/admin/dosen')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/dosen/edit', $data);
    }

    public function update($nidn)
    {
        $model = new DosenModel();
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email',
            'no_telp' => 'required|numeric|max_length[15]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal.');
        }

        $model->update($nidn, [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp')
        ]);

        return redirect()->to('/admin/dosen')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function delete($nidn)
    {
        $model = new DosenModel();
        $model->delete($nidn);
        return redirect()->to('/admin/dosen')->with('success', 'Dosen berhasil dihapus.');
    }
}
