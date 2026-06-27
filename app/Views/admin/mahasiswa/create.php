<?= $this->include('layouts/header'); ?>

<div class="container mt-4">
    <h2>Tambah Mahasiswa</h2>

    <!-- ✅ Pesan error & sukses -->
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

    <!-- ✅ Form tambah mahasiswa -->
    <form action="<?= base_url('admin/mahasiswa/store') ?>" method="post">
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input 
                type="text" 
                name="nim" 
                id="nim" 
                class="form-control" 
                maxlength="10" 
                pattern="\d{1,10}" 
                title="NIM hanya boleh angka dan maksimal 10 digit" 
                required 
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10)"
                placeholder="Masukkan NIM (hanya angka, maks 10 digit)"
            >
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input 
                type="text" 
                name="nama" 
                id="nama" 
                class="form-control" 
                required
                placeholder="Masukkan nama mahasiswa"
            >
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/mahasiswa') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->include('layouts/footer'); ?>
