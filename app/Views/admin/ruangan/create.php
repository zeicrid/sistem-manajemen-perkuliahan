<?= $this->include('layouts/header'); ?>

<div class="container mt-4">
    <h2>Tambah Ruangan</h2>

    <form action="<?= base_url('admin/ruangan/store') ?>" method="post">
        <div class="mb-3">
            <label for="nama_ruangan">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/ruangan') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->include('layouts/footer'); ?>
