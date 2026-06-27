<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RuanganModel;

class Ruangan extends BaseController
{
    public function index()
    {
        $model = new RuanganModel();
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['ruangan'] = $model->like('nama_ruangan', $keyword)->findAll();
        } else {
            $data['ruangan'] = $model->findAll();
        }

        return view('admin/ruangan/index', $data);
    }

    public function create()
    {
        return view('admin/ruangan/create');
    }

    public function store()
    {
        $model = new RuanganModel();
        $rules = ['nama_ruangan' => 'required|max_length[100]'];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Nama ruangan wajib diisi.');
        }

        $model->insert(['nama_ruangan' => $this->request->getPost('nama_ruangan')]);
        return redirect()->to('/admin/ruangan')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new RuanganModel();
        $data['ruangan'] = $model->find($id);

        if (!$data['ruangan']) {
            return redirect()->to('/admin/ruangan')->with('error', 'Data tidak ditemukan.');
        }

        return view('admin/ruangan/edit', $data);
    }

    public function update($id)
    {
        $model = new RuanganModel();
        $model->update($id, ['nama_ruangan' => $this->request->getPost('nama_ruangan')]);
        return redirect()->to('/admin/ruangan')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new RuanganModel();
        $model->delete($id);
        return redirect()->to('/admin/ruangan')->with('success', 'Ruangan berhasil dihapus.');
    }
}
