<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MataKuliahModel;

class MataKuliah extends BaseController
{
    protected $mataKuliahModel;

    public function __construct()
    {
        $this->mataKuliahModel = new MataKuliahModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            $data['mata_kuliah'] = $this->mataKuliahModel
                ->like('kode_mata_kuliah', $keyword)
                ->orLike('nama_mata_kuliah', $keyword)
                ->findAll();
        } else {
            $data['mata_kuliah'] = $this->mataKuliahModel->findAll();
        }

        return view('admin/mata_kuliah/index', $data);
    }

    public function create()
    {
        return view('admin/mata_kuliah/create');
    }

    public function store()
    {
        $data = [
            'kode_mata_kuliah' => $this->request->getPost('kode_mata_kuliah'),
            'nama_mata_kuliah' => $this->request->getPost('nama_mata_kuliah'),
            'sks' => $this->request->getPost('sks')
        ];

        $this->mataKuliahModel->insert($data);
        return redirect()->to(base_url('admin/mata-kuliah'))->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['mata_kuliah'] = $this->mataKuliahModel->find($id);

        if (!$data['mata_kuliah']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }

        return view('admin/mata_kuliah/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'kode_mata_kuliah' => $this->request->getPost('kode_mata_kuliah'),
            'nama_mata_kuliah' => $this->request->getPost('nama_mata_kuliah'),
            'sks' => $this->request->getPost('sks')
        ];

        $this->mataKuliahModel->update($id, $data);
        return redirect()->to(base_url('admin/mata-kuliah'))->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->mataKuliahModel->delete($id);
        return redirect()->to(base_url('admin/mata-kuliah'))->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
