<?= $this->include('layouts/header'); ?>
<div class="container py-5">
  <div class="card border-0 shadow-lg">
    <div class="card-body text-center">
      <h2 class="fw-bold text-success mb-3"><i class="bi bi-speedometer2"></i> Dashboard Admin</h2>
      <p class="text-muted mb-4">Selamat datang, <strong><?= esc(session('nama_user')); ?></strong> (Admin)</p>

      <div class="row g-4">
        <?php
        $menu = [
          ['url' => 'admin/mahasiswa', 'icon' => 'bi-people', 'title' => 'Kelola Mahasiswa'],
          ['url' => 'admin/dosen', 'icon' => 'bi-person-badge', 'title' => 'Kelola Dosen'],
          ['url' => 'admin/mata-kuliah', 'icon' => 'bi-book', 'title' => 'Kelola Mata Kuliah'],
          ['url' => 'admin/ruangan', 'icon' => 'bi-door-closed', 'title' => 'Kelola Ruangan'],
          ['url' => 'admin/jadwal', 'icon' => 'bi-calendar-week', 'title' => 'Kelola Jadwal'],
        ];
        foreach ($menu as $m): ?>
          <div class="col-md-4">
            <a href="<?= base_url($m['url']); ?>" class="text-decoration-none">
              <div class="card border-0 shadow-sm h-100 bg-light hover-shadow">
                <div class="card-body text-center">
                  <i class="bi <?= $m['icon']; ?> text-success" style="font-size:2rem;"></i>
                  <h5 class="mt-3 text-dark"><?= $m['title']; ?></h5>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="mt-4">
        <a href="<?= base_url('logout'); ?>" class="btn btn-dark px-4"><i class="bi bi-box-arrow-right"></i> Logout</a>
      </div>
    </div>
  </div>
</div>
<?= $this->include('layouts/footer'); ?>
