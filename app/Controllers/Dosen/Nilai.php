<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\RencanaStudiModel;
use App\Models\MahasiswaModel;
use App\Models\NilaiMutuModel;

class Nilai extends BaseController
{
    protected $jadwalModel;
    protected $rencanaModel;
    protected $mahasiswaModel;
    protected $nilaiMutuModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->rencanaModel = new RencanaStudiModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->nilaiMutuModel = new NilaiMutuModel();
    }

    // 📄 Tampilkan semua jadwal milik dosen
    public function index()
    {
        $nidn = session()->get('kode_peran');

        $data['jadwal'] = $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, ruangan.nama_ruangan')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->where('jadwal.nidn', $nidn)
            ->findAll();

        return view('dosen/nilai/nilai', $data);
    }

    // 👨‍🏫 Daftar mahasiswa dalam satu jadwal
    public function daftar($id_jadwal)
    {
        $data['jadwal'] = $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->find($id_jadwal);

        $data['mahasiswa'] = $this->rencanaModel
            ->select('rencana_studi.*, mahasiswa.nama, mahasiswa.nim')
            ->join('mahasiswa', 'mahasiswa.nim = rencana_studi.nim', 'left')
            ->where('rencana_studi.id_jadwal', $id_jadwal)
            ->findAll();

        $data['nilaiMutu'] = $this->nilaiMutuModel->findAll();

        return view('dosen/nilai/daftar', $data);
    }

    // 💾 Simpan nilai huruf
    public function simpan()
    {
        $nilai = $this->request->getPost('nilai');
        
        if (!$nilai) {
            return redirect()->back()->with('error', 'Tidak ada nilai yang disimpan.');
        }

        foreach ($nilai as $id_rencana => $nilai_huruf) {
            $this->rencanaModel->update($id_rencana, [
                'nilai_huruf' => $nilai_huruf
            ]);
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }
}
