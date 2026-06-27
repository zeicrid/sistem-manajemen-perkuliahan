<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<h2>Edit Jadwal</h2>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form action="/admin/jadwal/update/<?= $jadwal['id'] ?>" method="post">
    <?= csrf_field() ?>
    <div>
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" value="<?= old('nama_kelas', $jadwal['nama_kelas']) ?>" required>
    </div>

    <div>
        <label>Mata Kuliah</label>
        <select name="id_mata_kuliah" required>
            <?php foreach ($mata_kuliah as $mk): ?>
                <option value="<?= $mk['id_mata_kuliah'] ?>" <?= $mk['id_mata_kuliah'] == $jadwal['id_mata_kuliah'] ? 'selected' : '' ?>>
                    <?= $mk['nama_mata_kuliah'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Ruangan</label>
        <select name="id_ruangan" required>
            <?php foreach ($ruangan as $r): ?>
                <option value="<?= $r['id_ruangan'] ?>" <?= $r['id_ruangan'] == $jadwal['id_ruangan'] ? 'selected' : '' ?>>
                    <?= $r['nama_ruangan'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Dosen</label>
        <select name="nidn" required>
            <?php foreach ($dosen as $d): ?>
                <option value="<?= $d['nidn'] ?>" <?= $d['nidn'] == $jadwal['nidn'] ? 'selected' : '' ?>>
                    <?= $d['nama'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Hari</label>
        <input type="text" name="hari" value="<?= old('hari', $jadwal['hari']) ?>" required>
    </div>

    <div>
        <label>Jam</label>
        <input type="text" name="jam" value="<?= old('jam', $jadwal['jam']) ?>" required>
    </div>

    <button type="submit">Update</button>
</form>

<?= $this->endSection() ?>
