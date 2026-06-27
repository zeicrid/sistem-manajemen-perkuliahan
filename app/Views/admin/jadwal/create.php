<?= $this->include('layouts/header'); ?>

<div class="container mt-5">
    <h2>Tambah Jadwal Kuliah</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <form action="/admin/jadwal/store" method="post">
        <?= csrf_field(); ?>

        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?= old('nama_kelas'); ?>" required>
        </div>

        <div class="mb-3">
            <label for="id_mata_kuliah" class="form-label">Mata Kuliah</label>
            <select class="form-select" id="id_mata_kuliah" name="id_mata_kuliah" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                <?php foreach ($mata_kuliah as $mk): ?>
                    <option value="<?= $mk['id_mata_kuliah']; ?>"><?= esc($mk['nama_mata_kuliah']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="nidn" class="form-label">Dosen Pengampu</label>
            <select class="form-select" id="nidn" name="nidn" required>
                <option value="">-- Pilih Dosen --</option>
                <?php foreach ($dosen as $d): ?>
                    <option value="<?= $d['nidn']; ?>"><?= esc($d['nama']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_ruangan" class="form-label">Ruangan</label>
            <select class="form-select" id="id_ruangan" name="id_ruangan" required>
                <option value="">-- Pilih Ruangan --</option>
                <?php foreach ($ruangan as $r): ?>
                    <option value="<?= $r['id_ruangan']; ?>"><?= esc($r['nama_ruangan']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <select class="form-select" id="hari" name="hari" required>
                <option value="">-- Pilih Hari --</option>
                <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari): ?>
                    <option value="<?= $hari; ?>"><?= $hari; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="jam" class="form-label">Jam</label>
            <input type="text" class="form-control" id="jam" name="jam" placeholder="contoh: 08:00-10:00" value="<?= old('jam'); ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/jadwal" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->include('layouts/footer'); ?>
