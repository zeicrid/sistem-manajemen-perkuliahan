<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\RencanaStudiModel;
use App\Models\MahasiswaModel;

class RencanaStudi extends BaseController
{
    protected $jadwalModel;
    protected $rencanaModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->jadwalModel    = new JadwalModel();
        $this->rencanaModel   = new RencanaStudiModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    // ===== TAMPIL HALAMAN RENCANA STUDI =====
    public function index()
    {
        $nim = session()->get('kode_peran'); // asumsi NIM disimpan di session saat login

        $data['jadwalTersedia'] = $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, dosen.nama AS nama_dosen, ruangan.nama_ruangan')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('dosen', 'dosen.nidn = jadwal.nidn', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->findAll();

        $data['rencanaSaya'] = $this->rencanaModel
            ->select('rencana_studi.*, jadwal.nama_kelas, jadwal.hari, jadwal.jam,
                      mata_kuliah.nama_mata_kuliah, dosen.nama AS nama_dosen, ruangan.nama_ruangan')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal', 'left')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('dosen', 'dosen.nidn = jadwal.nidn', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->where('rencana_studi.nim', $nim)
            ->findAll();

        return view('mahasiswa/rencana_studi', $data);
    }

    // ===== TAMBAH RENCANA STUDI =====
    public function store()
    {
        $nim = session()->get('kode_peran');
        $id_jadwal = $this->request->getPost('id_jadwal');

        if (!$nim || !$id_jadwal) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        // pastikan mahasiswa ada di tabel mahasiswa
        $mhs = $this->mahasiswaModel->where('nim', $nim)->first();
        if (!$mhs) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan di database.');
        }

        // cek apakah jadwal ini sudah diambil
        $sudahAda = $this->rencanaModel
            ->where('nim', $nim)
            ->where('id_jadwal', $id_jadwal)
            ->first();

        if ($sudahAda) {
            return redirect()->back()->with('error', 'Jadwal ini sudah kamu ambil sebelumnya.');
        }

        // ambil data jadwal baru
        $jadwalBaru = $this->jadwalModel->find($id_jadwal);
        if (!$jadwalBaru) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }

        // normalisasi format jam (misal: "08.00" → "08:00")
        $jadwalBaruJam = str_replace('.', ':', $jadwalBaru['jam']);
        [$baruMulai, $baruSelesai] = $this->pecahWaktu($jadwalBaruJam);

        // ambil semua jadwal mahasiswa untuk cek bentrok
        $rencanaSaya = $this->rencanaModel
            ->select('jadwal.hari, jadwal.jam')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal', 'left')
            ->where('rencana_studi.nim', $nim)
            ->findAll();

        foreach ($rencanaSaya as $r) {
            $hari = $r['hari'];
            $jamLama = str_replace('.', ':', $r['jam']);
            [$lamaMulai, $lamaSelesai] = $this->pecahWaktu($jamLama);

            // jika hari sama & waktu tumpang tindih
            if ($hari === $jadwalBaru['hari'] && $this->cekBentrokJam($baruMulai, $baruSelesai, $lamaMulai, $lamaSelesai)) {
                return redirect()->back()->with('error', 'Jadwal bentrok dengan mata kuliah lain pada hari dan jam yang sama!');
            }
        }

        // simpan ke tabel rencana_studi
        $this->rencanaModel->insert([
            'nim' => $nim,
            'id_jadwal' => $id_jadwal,
        ]);

        return redirect()->to(base_url('mahasiswa/rencana-studi'))
                         ->with('success', 'Mata kuliah berhasil ditambahkan ke rencana studi.');
    }

    // ===== HAPUS RENCANA STUDI =====
    public function remove($id)
    {
        $this->rencanaModel->delete($id);
        return redirect()->to(base_url('mahasiswa/rencana-studi'))
                         ->with('success', 'Mata kuliah berhasil dihapus dari rencana studi.');
    }

    // ===== PECAH FORMAT JAM =====
    private function pecahWaktu(string $jam)
    {
        if (strpos($jam, '-') !== false) {
            $parts = explode('-', $jam);
            return [trim($parts[0]), trim($parts[1])];
        }

        // jika hanya 1 jam (misal "08:00"), beri durasi 59 menit
        return [$jam, date('H:i', strtotime($jam . ' +59 minutes'))];
    }

    // ===== CEK OVERLAP JAM =====
    private function cekBentrokJam($mulai1, $selesai1, $mulai2, $selesai2)
    {
        $mulai1 = strtotime($mulai1);
        $selesai1 = strtotime($selesai1);
        $mulai2 = strtotime($mulai2);
        $selesai2 = strtotime($selesai2);

        // waktu overlap jika mulai < selesai lain dan selesai > mulai lain
        return ($mulai1 < $selesai2 && $selesai1 > $mulai2);
    }
}
