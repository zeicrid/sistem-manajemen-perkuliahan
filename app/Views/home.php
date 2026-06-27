<div class="row">
  <div class="col-md-12">
    <h2>Dashboard</h2>
    <p>Selamat datang di Sistem Manajemen Perkuliahan.</p>
    <?php if(session()->get('role') === 'admin'): ?>
      <a href="<?= site_url('admin/mahasiswa') ?>" class="btn btn-sm btn-primary">Kelola Mahasiswa</a>
    <?php elseif(session()->get('role') === 'mahasiswa'): ?>
      <a href="<?= site_url('mahasiswa/rencana-studi') ?>" class="btn btn-sm btn-primary">Rencana Studi</a>
      <a href="<?= site_url('mahasiswa/hasil-studi') ?>" class="btn btn-sm btn-success">Hasil Studi</a>
    <?php elseif(session()->get('role') === 'dosen'): ?>
      <a href="<?= site_url('dosen/nilai') ?>" class="btn btn-sm btn-primary">Kelola Nilai</a>
    <?php endif; ?>
  </div>
</div>
