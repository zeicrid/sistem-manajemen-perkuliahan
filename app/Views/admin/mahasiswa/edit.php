<?= $this->include('layouts/header'); ?>

<div class="container mt-4">
    <h2>Edit Mahasiswa</h2>

    <!-- ✅ Pesan error/success -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/mahasiswa/update/' . $mahasiswa['nim']) ?>" method="post">
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input 
                type="text" 
                name="nim" 
                id="nim" 
                class="form-control" 
                value="<?= esc($mahasiswa['nim']) ?>" 
                maxlength="10" 
                required 
                readonly
            >
            <small class="text-muted">NIM tidak dapat diubah</small>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input 
                type="text" 
                name="nama" 
                id="nama" 
                class="form-control" 
                value="<?= esc($mahasiswa['nama']) ?>" 
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="<?= base_url('admin/mahasiswa') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->include('layouts/footer'); ?>
