<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\RencanaStudiModel;
use App\Models\NilaiMutuModel;

class HasilStudi extends BaseController
{
    protected $rencanaModel;
    protected $nilaiMutuModel;

    public function __construct()
    {
        $this->rencanaModel = new RencanaStudiModel();
        $this->nilaiMutuModel = new NilaiMutuModel();
    }

    public function index()
    {
        $nim = session()->get('kode_peran');

        // Ambil data hasil studi mahasiswa
        $hasilStudi = $this->rencanaModel
            ->select('rencana_studi.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, dosen.nama AS nama_dosen')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal', 'left')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('dosen', 'dosen.nidn = jadwal.nidn', 'left')
            ->where('rencana_studi.nim', $nim)
            ->findAll();

        $totalMutu = 0;
        $totalSks = 0;

        foreach ($hasilStudi as &$h) {
            if (!empty($h['nilai_huruf'])) {
                $nilaiMutu = $this->nilaiMutuModel
                    ->where('nilai_huruf', $h['nilai_huruf'])
                    ->first();

                $mutu = $nilaiMutu ? $nilaiMutu['nilai_mutu'] : 0;
                $h['nilai_mutu'] = $mutu;

                $totalMutu += $mutu * $h['sks'];
                $totalSks += $h['sks'];
            } else {
                $h['nilai_mutu'] = '-';
            }
        }

        $ipk = $totalSks > 0 ? round($totalMutu / $totalSks, 2) : 0;

        $data = [
            'hasilStudi' => $hasilStudi,
            'ipk' => $ipk
        ];

        return view('mahasiswa/hasil_studi', $data);
    }
}
