<?= $this->include('layouts/header'); ?>

<div class="p-4">
    <h3 class="fw-bold mb-4 text-dark">Daftar Jadwal Saya</h3>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white text-center fw-bold">
            <i class="bi bi-calendar-week"></i> Jadwal Mengajar
        </div>
        <div class="card-body p-0">
            <?php if (!empty($jadwal)): ?>
                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Ruangan</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($jadwal as $j): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= esc($j['nama_mata_kuliah']); ?></td>
                            <td><?= esc($j['nama_ruangan']); ?></td>
                            <td><?= esc($j['hari']); ?></td>
                            <td><?= esc($j['jam']); ?></td>
                            <td><?= esc($j['nama_kelas']); ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('dosen/nilai/daftar/'.$j['id']); ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-person-lines-fill"></i> Lihat Mahasiswa
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center text-muted p-3">Tidak ada jadwal mengajar.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer'); ?>
