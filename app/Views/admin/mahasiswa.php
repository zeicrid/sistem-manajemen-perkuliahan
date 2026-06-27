<div class="row">
  <div class="col-md-12">
    <h3>Daftar Mahasiswa</h3>
    <a href="<?= site_url('admin/mahasiswa/create') ?>" class="btn btn-sm btn-success mb-2">Tambah</a>
    <table class="table table-bordered">
      <thead><tr><th>NIM</th><th>Nama</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php foreach($mahasiswa as $m): ?>
          <tr>
            <td><?= esc($m['nim']) ?></td>
            <td><?= esc($m['nama']) ?></td>
            <td>
              <a href="<?= site_url('admin/mahasiswa/edit/'.$m['nim']) ?>" class="btn btn-sm btn-primary">Edit</a>
              <a href="<?= site_url('admin/mahasiswa/delete/'.$m['nim']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
