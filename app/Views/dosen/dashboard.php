<?= $this->include('layouts/header'); ?>
<div class="container py-5">
  <div class="card border-0 shadow-lg">
    <div class="card-body text-center">
      <h2 class="fw-bold text-primary mb-3"><i class="bi bi-person-badge"></i> Dashboard Dosen</h2>
      <p class="text-muted mb-4">Selamat datang, <strong><?= esc(session('nama_user')); ?></strong> (Dosen)</p>

      <div class="row justify-content-center g-4">
        <div class="col-md-4">
          <a href="<?= base_url('dosen/nilai'); ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 bg-light hover-shadow">
              <div class="card-body text-center">
                <i class="bi bi-journal-check text-primary" style="font-size:2rem;"></i>
                <h5 class="mt-3 text-dark">Kelola Nilai Mahasiswa</h5>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="mt-4">
        <a href="<?= base_url('logout'); ?>" class="btn btn-dark px-4"><i class="bi bi-box-arrow-right"></i> Logout</a>
      </div>
    </div>
  </div>
</div>
<?= $this->include('layouts/footer'); ?>
