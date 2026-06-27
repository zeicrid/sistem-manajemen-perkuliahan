<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<h2>Tambah Jadwal</h2>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<form action="/admin/jadwal/store" method="post">
    <?= csrf_field() ?>
    <div>
        <label>Nama Kelas</label>
        <input type="text" name="nama_kelas" value="<?= old('nama_kelas') ?>" required>
    </div>

    <div>
        <label>Mata Kuliah</label>
        <select name="id_mata_kuliah" required>
            <?php foreach ($mata_kuliah as $mk): ?>
                <option value="<?= $mk['id_mata_kuliah'] ?>"><?= $mk['nama_mata_kuliah'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Ruangan</label>
        <select name="id_ruangan" required>
            <?php foreach ($ruangan as $r): ?>
                <option value="<?= $r['id_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Dosen</label>
        <select name="nidn" required>
            <?php foreach ($dosen as $d): ?>
                <option value="<?= $d['nidn'] ?>"><?= $d['nama'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Hari</label>
        <input type="text" name="hari" value="<?= old('hari') ?>" required>
    </div>

    <div>
        <label>Jam</label>
        <input type="text" name="jam" placeholder="08:00-10:00" value="<?= old('jam') ?>" required>
    </div>

    <button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>
