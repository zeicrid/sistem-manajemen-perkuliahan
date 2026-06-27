<?= $this->include('layouts/header'); ?>
<div class="container py-5">
  <div class="card border-0 shadow-lg">
    <div class="card-body text-center">
      <h2 class="fw-bold text-success mb-3"><i class="bi bi-mortarboard"></i> Dashboard Mahasiswa</h2>
      <p class="text-muted mb-4">Selamat datang, <strong><?= esc(session('nama_user')); ?></strong> (Mahasiswa)</p>

      <div class="row justify-content-center g-4">
        <div class="col-md-4">
          <a href="<?= base_url('mahasiswa/rencana-studi'); ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 bg-light hover-shadow">
              <div class="card-body text-center">
                <i class="bi bi-calendar-plus text-success" style="font-size:2rem;"></i>
                <h5 class="mt-3 text-dark">Rencana Studi</h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a href="<?= base_url('mahasiswa/hasil_studi'); ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 bg-light hover-shadow">
              <div class="card-body text-center">
                <i class="bi bi-bar-chart-line text-success" style="font-size:2rem;"></i>
                <h5 class="mt-3 text-dark">Hasil Studi & IPK</h5>
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
