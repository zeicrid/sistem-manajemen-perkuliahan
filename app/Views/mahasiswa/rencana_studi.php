<?= $this->include('layouts/header'); ?>

<div class="p-4">

    <!-- Judul Halaman -->
    <h3 class="fw-bold mb-4 text-dark">Rencana Studi Mahasiswa</h3>

    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Jadwal yang Tersedia -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white fw-bold text-center">
            <i class="bi bi-calendar-week"></i> Daftar Jadwal yang Tersedia
        </div>
        <div class="card-body p-0">
            <?php if (!empty($jadwalTersedia)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>Ruangan</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($jadwalTersedia as $j): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= esc($j['nama_mata_kuliah']); ?></td>
                                    <td><?= esc($j['nama_dosen']); ?></td>
                                    <td><?= esc($j['nama_ruangan']); ?></td>
                                    <td class="text-center"><?= esc($j['hari']); ?></td>
                                    <td class="text-center"><?= esc($j['jam']); ?></td>
                                    <td class="text-center"><?= esc($j['nama_kelas']); ?></td>
                                    <td class="text-center">
                                        <form action="<?= base_url('mahasiswa/rencana-studi'); ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id_jadwal" value="<?= esc($j['id']); ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-plus-circle"></i> Ambil
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-center text-muted p-3 mb-0">Tidak ada jadwal yang tersedia untuk diambil.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Jadwal yang Sudah Diambil -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-bold text-center">
            <i class="bi bi-journal-check"></i> Rencana Studi Saya
        </div>
        <div class="card-body p-0">
            <?php if (!empty($rencanaSaya)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>Ruangan</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($rencanaSaya as $r): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= esc($r['nama_mata_kuliah']); ?></td>
                                    <td><?= esc($r['nama_dosen']); ?></td>
                                    <td><?= esc($r['nama_ruangan']); ?></td>
                                    <td class="text-center"><?= esc($r['hari']); ?></td>
                                    <td class="text-center"><?= esc($r['jam']); ?></td>
                                    <td class="text-center"><?= esc($r['nama_kelas']); ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('mahasiswa/rencana-studi/remove/' . $r['id_rencana_studi']); ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Hapus mata kuliah ini dari rencana studi?')">
                                           <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-center text-muted p-3 mb-0">Belum ada mata kuliah yang diambil.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-4">
        <a href="<?= base_url('mahasiswa'); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>

<?= $this->include('layouts/footer'); ?>
