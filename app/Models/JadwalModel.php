<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kelas', 'id_mata_kuliah', 'id_ruangan', 'nidn', 'hari', 'jam'];

    // Relasi Jadwal lengkap (Mata Kuliah, Dosen, Ruangan)
    public function getAllJadwal()
    {
        return $this->select('
                jadwal.id,
                jadwal.nama_kelas,
                jadwal.hari,
                jadwal.jam,
                mata_kuliah.nama_mata_kuliah,
                dosen.nama AS nama_dosen,
                ruangan.nama_ruangan
            ')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->orderBy('hari', 'ASC')
            ->findAll();
    }

    // ✅ Tambahan: ambil jadwal yang belum diambil oleh mahasiswa tertentu
    public function getAvailableJadwal($nim)
    {
        return $this->select('
                jadwal.id,
                jadwal.nama_kelas,
                jadwal.hari,
                jadwal.jam,
                mata_kuliah.nama_mata_kuliah,
                dosen.nama AS nama_dosen,
                ruangan.nama_ruangan
            ')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where("jadwal.id NOT IN (SELECT id_jadwal FROM rencana_studi WHERE nim = '$nim')", null, false)
            ->orderBy('hari', 'ASC')
            ->findAll();
    }
}
