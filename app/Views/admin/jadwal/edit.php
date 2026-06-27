<?= $this->include('layouts/header'); ?>

<div class="container mt-5">
    <h2>Edit Jadwal Kuliah</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <form action="/admin/jadwal/update/<?= $jadwal['id']; ?>" method="post">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?= esc($jadwal['nama_kelas']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_mata_kuliah" class="form-label">Mata Kuliah</label>
            <select class="form-select" id="id_mata_kuliah" name="id_mata_kuliah" required>
                <?php foreach ($mata_kuliah as $mk): ?>
                    <option value="<?= $mk['id_mata_kuliah']; ?>" <?= $mk['id_mata_kuliah'] == $jadwal['id_mata_kuliah'] ? 'selected' : ''; ?>>
                        <?= esc($mk['nama_mata_kuliah']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="nidn" class="form-label">Dosen Pengampu</label>
            <select class="form-select" id="nidn" name="nidn" required>
                <?php foreach ($dosen as $d): ?>
                    <option value="<?= $d['nidn']; ?>" <?= $d['nidn'] == $jadwal['nidn'] ? 'selected' : ''; ?>>
                        <?= esc($d['nama']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_ruangan" class="form-label">Ruangan</label>
            <select class="form-select" id="id_ruangan" name="id_ruangan" required>
                <?php foreach ($ruangan as $r): ?>
                    <option value="<?= $r['id_ruangan']; ?>" <?= $r['id_ruangan'] == $jadwal['id_ruangan'] ? 'selected' : ''; ?>>
                        <?= esc($r['nama_ruangan']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select class="form-select" id="hari" name="hari" required>
                <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari): ?>
                    <option value="<?= $hari; ?>" <?= $hari == $jadwal['hari'] ? 'selected' : ''; ?>><?= $hari; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="jam" class="form-label">Jam</label>
            <input type="text" class="form-control" id="jam" name="jam" value="<?= esc($jadwal['jam']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/jadwal" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->include('layouts/footer'); ?>
