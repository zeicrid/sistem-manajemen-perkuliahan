<?= $this->include('layouts/header'); ?>

<div class="container mt-4">
    <h2>Tambah Dosen</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/dosen/store') ?>" method="post">
        <div class="mb-3">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="text" name="nidn" id="nidn" class="form-control"
                   maxlength="10" pattern="\d{1,10}" title="Hanya angka (maks 10 digit)"
                   oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dosen</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                   placeholder="contoh: dosen@kampus.com" required>
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No. Telepon</label>
            <input type="text" name="no_telp" id="no_telp" class="form-control"
                   maxlength="13" pattern="\d{1,13}" title="Hanya angka (maks 13 digit)"
                   oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,13)" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/dosen') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->include('layouts/footer'); ?>
