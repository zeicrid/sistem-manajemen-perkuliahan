<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Mata Kuliah</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="<?= base_url('admin/mata-kuliah/create') ?>" class="btn btn-primary">Tambah Mata Kuliah</a>
        <form action="<?= base_url('admin/mata-kuliah') ?>" method="get" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari mata kuliah..." value="<?= esc($search ?? '') ?>">
            <button type="submit" class="btn btn-success">Cari</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th style="width:5%; text-align:center;">No</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th style="width:15%; text-align:center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mata_kuliah)): ?>
                <?php $no = 1; foreach ($mata_kuliah as $mk): ?>
                <tr>
                    <td style="text-align:center;"><?= $no++; ?></td>
                    <td><?= esc($mk['kode_mata_kuliah']); ?></td>
                    <td><?= esc($mk['nama_mata_kuliah']); ?></td>
                    <td><?= esc($mk['sks']); ?></td>
                    <td style="text-align:center;">
                        <a href="<?= base_url('admin/mata-kuliah/edit/'.$mk['id_mata_kuliah']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('admin/mata-kuliah/delete/'.$mk['id_mata_kuliah']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">Tidak ada data</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
<div class="mt-3">
    <a href="<?= base_url('admin') ?>" class="btn btn-secondary">← Kembali ke Dashboard</a>
</div>
</body>
</html>
