<?= $this->include('layouts/header'); ?>

<div class="p-4">
    <h3 class="fw-bold mb-4 text-dark">Hasil Studi Mahasiswa</h3>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-bold text-center">
            <i class="bi bi-mortarboard"></i> Daftar Nilai Mata Kuliah
        </div>
        <div class="card-body p-0">
            <?php if (!empty($hasilStudi)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen</th>
                                <th>SKS</th>
                                <th>Nilai Huruf</th>
                                <th>Nilai Mutu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($hasilStudi as $row): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= esc($row['nama_mata_kuliah']); ?></td>
                                    <td><?= esc($row['nama_dosen']); ?></td>
                                    <td class="text-center"><?= esc($row['sks']); ?></td>
                                    <td class="text-center"><?= esc($row['nilai_huruf'] ?? '-'); ?></td>
                                    <td class="text-center"><?= esc($row['nilai_mutu'] ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="p-3 bg-light">
                    <h5 class="fw-bold text-dark">IPK: <span class="text-success"><?= $ipk; ?></span></h5>
                </div>
            <?php else: ?>
                <p class="text-center text-muted p-3 mb-0">Belum ada hasil studi yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-4">
        <a href="<?= base_url('mahasiswa'); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>

<?= $this->include('layouts/footer'); ?>
