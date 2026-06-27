<?= $this->include('layouts/header'); ?>

<div class="container mt-5">
    <h2>Daftar Jadwal Kuliah</h2>

    <!-- Pesan sukses atau error -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="/admin/jadwal/create" class="btn btn-primary">+ Tambah Jadwal</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Ruangan</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($jadwal)): ?>
                <?php $no = 1; foreach ($jadwal as $j): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($j['nama_kelas']); ?></td>
                        <td><?= esc($j['nama_mata_kuliah'] ?? '-'); ?></td>
                        <td><?= esc($j['nama_dosen'] ?? '-'); ?></td>
                        <td><?= esc($j['nama_ruangan'] ?? '-'); ?></td>
                        <td><?= esc($j['hari']); ?></td>
                        <td><?= esc($j['jam']); ?></td>
                        <td>
                            <a href="/admin/jadwal/edit/<?= $j['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="/admin/jadwal/delete/<?= $j['id']; ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Belum ada data jadwal.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->include('layouts/footer'); ?>
