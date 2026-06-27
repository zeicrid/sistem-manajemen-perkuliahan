<?= $this->include('layouts/header'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Dosen</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="<?= base_url('admin/dosen/create') ?>" class="btn btn-primary">Tambah Dosen</a>
        <form action="<?= base_url('admin/dosen') ?>" method="get" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari dosen..." value="<?= esc($search ?? '') ?>">
            <button type="submit" class="btn btn-success">Cari</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th style="width:5%; text-align:center;">No</th>
                <th>NIDN</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th style="width:15%; text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dosen)): ?>
                <?php $no = 1; foreach ($dosen as $d): ?>
                <tr>
                    <td style="text-align:center;"><?= $no++; ?></td>
                    <td><?= esc($d['nidn']); ?></td>
                    <td><?= esc($d['nama']); ?></td>
                    <td><?= esc($d['email']); ?></td>
                    <td><?= esc($d['no_telp']); ?></td>
                    <td style="text-align:center;">
                        <a href="<?= base_url('admin/dosen/edit/'.$d['nidn']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('admin/dosen/delete/'.$d['nidn']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="mt-3">
    <a href="<?= base_url('admin') ?>" class="btn btn-secondary">← Kembali ke Dashboard</a>
</div>
</div>
</body>
</html>
<?= $this->include('layouts/footer'); ?>