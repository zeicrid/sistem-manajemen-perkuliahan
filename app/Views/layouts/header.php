<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Sistem Kuliah') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- optional: icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
    <a class="navbar-brand" href="<?= site_url() ?>">Sistem Kuliah</a>

    <div class="d-flex align-items-center">
      <span class="navbar-text text-white me-3">
        <?= esc(session()->get('nama_user')) ?> (<?= esc(session()->get('role')) ?>)
      </span>

      <!-- gunakan site_url('logout') agar index.php atau baseURL diperhitungkan -->
      <a href="<?= site_url('logout') ?>" class="btn btn-outline-light btn-sm">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </div>
  </div>
</nav>

<div class="container mt-4">
