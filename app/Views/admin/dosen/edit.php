<?= $this->include('layouts/header'); ?>

<div class="container mt-4">
    <h2>Edit Dosen</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/dosen/update/' . $dosen['nidn']) ?>" method="post">
        <div class="mb-3">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="text" class="form-control" value="<?= esc($dosen['nidn']); ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dosen</label>
            <input type="text" name="nama" class="form-control" value="<?= esc($dosen['nama']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= esc($dosen['email']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">No. Telepon</label>
            <input type="text" name="no_telp" class="form-control"
                   value="<?= esc($dosen['no_telp']); ?>"
                   maxlength="13" pattern="\d{1,13}"
                   oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,13)" required>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="<?= base_url('admin/dosen') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->include('layouts/footer'); ?>
