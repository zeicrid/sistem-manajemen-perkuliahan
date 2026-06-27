<?= $this->include('layouts/header'); ?>

<div class="p-4">
    <h3 class="fw-bold mb-4 text-dark">Input Nilai - <?= esc($jadwal['nama_mata_kuliah']); ?></h3>

    <form action="<?= base_url('dosen/nilai/simpan'); ?>" method="post">
        <?= csrf_field(); ?>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-bold text-center">
                <i class="bi bi-people"></i> Daftar Mahasiswa
            </div>
            <div class="card-body p-0">
                <?php if (!empty($mahasiswa)): ?>
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Nilai Huruf</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($mahasiswa as $m): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= esc($m['nim']); ?></td>
                                <td><?= esc($m['nama']); ?></td>
                                <td class="text-center">
                                    <select name="nilai[<?= $m['id_rencana_studi']; ?>]" class="form-select form-select-sm">
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($nilaiMutu as $n): ?>
                                            <option value="<?= esc($n['nilai_huruf']); ?>" <?= ($m['nilai_huruf'] ?? '') === $n['nilai_huruf'] ? 'selected' : '' ?>>
                                                <?= esc($n['nilai_huruf']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center text-muted p-3 mb-0">Tidak ada mahasiswa terdaftar di jadwal ini.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan Nilai
            </button>
            <a href="<?= base_url('dosen/nilai'); ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<?= $this->include('layouts/footer'); ?>
