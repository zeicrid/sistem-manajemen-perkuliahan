<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\MataKuliahModel;
use App\Models\RuanganModel;
use App\Models\DosenModel;

class Jadwal extends BaseController
{
    public function index()
    {
        $jadwalModel = new JadwalModel();
        $data['jadwal'] = $jadwalModel->select('
                jadwal.*, 
                mata_kuliah.nama_mata_kuliah, 
                ruangan.nama_ruangan, 
                dosen.nama AS nama_dosen
            ')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->findAll();

        return view('admin/jadwal/index', $data);
    }

    public function create()
    {
        $data['mata_kuliah'] = (new MataKuliahModel())->findAll();
        $data['ruangan'] = (new RuanganModel())->findAll();
        $data['dosen'] = (new DosenModel())->findAll();

        return view('admin/jadwal/create', $data);
    }

    public function store()
    {
        $model = new JadwalModel();

        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'id_mata_kuliah' => $this->request->getPost('id_mata_kuliah'),
            'id_ruangan' => $this->request->getPost('id_ruangan'),
            'nidn' => $this->request->getPost('nidn'),
            'hari' => $this->request->getPost('hari'),
            'jam' => $this->request->getPost('jam'),
        ];

        // === CEK BENTROK DOSEN ===
        $cekDosen = $model->where('nidn', $data['nidn'])
            ->where('hari', $data['hari'])
            ->where('jam', $data['jam'])
            ->first();

        if ($cekDosen) {
            return redirect()->back()->withInput()
                ->with('error', 'Dosen sudah memiliki jadwal pada waktu yang sama di ruangan lain.');
        }

        // === CEK BENTROK KELAS ===
        $cekKelas = $model->where('nama_kelas', $data['nama_kelas'])
            ->where('hari', $data['hari'])
            ->where('jam', $data['jam'])
            ->first();

        if ($cekKelas) {
            return redirect()->back()->withInput()
                ->with('error', 'Kelas ini sudah memiliki jadwal di waktu yang sama.');
        }

        $model->insert($data);

        return redirect()->to('/admin/jadwal')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new JadwalModel();
        $data['jadwal'] = $model->find($id);
        $data['mata_kuliah'] = (new MataKuliahModel())->findAll();
        $data['ruangan'] = (new RuanganModel())->findAll();
        $data['dosen'] = (new DosenModel())->findAll();

        return view('admin/jadwal/edit', $data);
    }

    public function update($id)
    {
        $model = new JadwalModel();

        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
            'id_mata_kuliah' => $this->request->getPost('id_mata_kuliah'),
            'id_ruangan' => $this->request->getPost('id_ruangan'),
            'nidn' => $this->request->getPost('nidn'),
            'hari' => $this->request->getPost('hari'),
            'jam' => $this->request->getPost('jam'),
        ];

        // === CEK BENTROK DOSEN (kecuali jadwal yang sedang diupdate) ===
        $cekDosen = $model->where('nidn', $data['nidn'])
            ->where('hari', $data['hari'])
            ->where('jam', $data['jam'])
            ->where('id !=', $id)
            ->first();

        if ($cekDosen) {
            return redirect()->back()->withInput()
                ->with('error', 'Dosen sudah memiliki jadwal lain pada waktu tersebut.');
        }

        // === CEK BENTROK KELAS ===
        $cekKelas = $model->where('nama_kelas', $data['nama_kelas'])
            ->where('hari', $data['hari'])
            ->where('jam', $data['jam'])
            ->where('id !=', $id)
            ->first();

        if ($cekKelas) {
            return redirect()->back()->withInput()
                ->with('error', 'Kelas ini sudah memiliki jadwal lain di waktu yang sama.');
        }

        $model->update($id, $data);

        return redirect()->to('/admin/jadwal')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new JadwalModel();
        $model->delete($id);
        return redirect()->to('/admin/jadwal')->with('success', 'Jadwal berhasil dihapus.');
    }
}
