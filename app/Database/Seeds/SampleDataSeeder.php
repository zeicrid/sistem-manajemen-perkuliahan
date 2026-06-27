<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // mahasiswa
        $db->table('mahasiswa')->insertBatch([
            ['nim' => '200100001', 'nama' => 'Andi Santoso'],
            ['nim' => '200100002', 'nama' => 'Budi Hartono'],
            ['nim' => '200100003', 'nama' => 'Citra Melati'],
        ]);

        // dosen
        $db->table('dosen')->insertBatch([
            ['nidn' => '100100001', 'nama' => 'Dr. Siti Aminah'],
            ['nidn' => '100100002', 'nama' => 'Ir. Joko Widodo'],
        ]);

        // mata_kuliah
        $db->table('mata_kuliah')->insertBatch([
            ['kode_mata_kuliah' => 'IF101', 'nama_mata_kuliah' => 'Pemrograman Web', 'sks' => 3],
            ['kode_mata_kuliah' => 'IF102', 'nama_mata_kuliah' => 'Basis Data', 'sks' => 3],
            ['kode_mata_kuliah' => 'IF103', 'nama_mata_kuliah' => 'Jaringan Komputer', 'sks' => 2],
        ]);

        // ruangan
        $db->table('ruangan')->insertBatch([
            ['nama_ruangan' => 'R101'],
            ['nama_ruangan' => 'R102'],
        ]);

        // jadwal (ambil id dari tabel)
        $mata = $db->table('mata_kuliah')->get()->getResultArray();
        $ruang = $db->table('ruangan')->get()->getResultArray();
        $dosen = $db->table('dosen')->get()->getResultArray();

        $db->table('jadwal')->insertBatch([
            [
                'nama_kelas' => 'IF-A',
                'id_mata_kuliah' => $mata[0]['id_mata_kuliah'],
                'id_ruangan' => $ruang[0]['id_ruangan'],
                'nidn' => $dosen[0]['nidn'],
                'hari' => 'Senin',
                'jam' => '08:00'
            ],
            [
                'nama_kelas' => 'IF-B',
                'id_mata_kuliah' => $mata[1]['id_mata_kuliah'],
                'id_ruangan' => $ruang[1]['id_ruangan'],
                'nidn' => $dosen[1]['nidn'],
                'hari' => 'Selasa',
                'jam' => '10:00'
            ],
            [
                'nama_kelas' => 'IF-C',
                'id_mata_kuliah' => $mata[2]['id_mata_kuliah'],
                'id_ruangan' => $ruang[0]['id_ruangan'],
                'nidn' => $dosen[0]['nidn'],
                'hari' => 'Rabu',
                'jam' => '13:00'
            ],
        ]);

        // nilai_mutu
        $db->table('nilai_mutu')->insertBatch([
            ['nilai_huruf' => 'A', 'nilai_mutu' => 4.0],
            ['nilai_huruf' => 'B', 'nilai_mutu' => 3.0],
            ['nilai_huruf' => 'C', 'nilai_mutu' => 2.0],
            ['nilai_huruf' => 'D', 'nilai_mutu' => 1.0],
            ['nilai_huruf' => 'E', 'nilai_mutu' => 0.0],
        ]);

        // users
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $db->table('user')->insert([
            'nama_user' => 'Administrator',
            'username' => 'admin',
            'password' => $password,
            'role' => 'admin',
            'kode_peran' => null
        ]);

        // mahasiswa users
        $mhs = $db->table('mahasiswa')->get()->getResultArray();
        foreach ($mhs as $m) {
            $db->table('user')->insert([
                'nama_user' => $m['nama'],
                'username' => 'm_'.$m['nim'],
                'password' => password_hash('mhs123', PASSWORD_DEFAULT),
                'role' => 'mahasiswa',
                'kode_peran' => $m['nim']
            ]);
        }

        // dosen users
        $ds = $db->table('dosen')->get()->getResultArray();
        foreach ($ds as $d) {
            $db->table('user')->insert([
                'nama_user' => $d['nama'],
                'username' => 'd_'.$d['nidn'],
                'password' => password_hash('dsn123', PASSWORD_DEFAULT),
                'role' => 'dosen',
                'kode_peran' => $d['nidn']
            ]);
        }
    }
}
