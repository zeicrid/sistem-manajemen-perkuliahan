<?php

namespace App\Models;

use CodeIgniter\Model;

class RencanaStudiModel extends Model
{
    protected $table = 'rencana_studi';
    protected $primaryKey = 'id_rencana_studi';
    protected $allowedFields = ['nim', 'id_jadwal', 'nilai_angka', 'nilai_huruf'];

    // ✅ Ambil semua jadwal yang sudah diambil oleh mahasiswa tertentu
    public function getByMahasiswa($nim)
    {
        return $this->select('
                rencana_studi.id_rencana_studi,
                jadwal.id AS id_jadwal,
                jadwal.nama_kelas,
                jadwal.hari,
                jadwal.jam,
                mata_kuliah.nama_mata_kuliah,
                dosen.nama AS nama_dosen,
                ruangan.nama_ruangan
            ')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('rencana_studi.nim', $nim)
            ->orderBy('jadwal.hari', 'ASC')
            ->findAll();
    }
}
