<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Sistem Manajemen Kuliah') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2e8b57, #00bcd4);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 15px;
        }
        .main-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            padding: 40px 50px;
            max-width: 1000px;
            width: 100%;
        }
        .navbar {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
        }
        .nav-link, .navbar-brand {
            color: #fff !important;
        }
        .btn-custom {
            background-color: #2e8b57;
            border: none;
            color: white;
        }
        .btn-custom:hover {
            background-color: #239b56;
        }
        footer {
            text-align: center;
            padding: 15px;
            color: white;
            background: rgba(0,0,0,0.6);
            font-size: 14px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid px-5">
    <a class="navbar-brand fw-bold" href="#">🎓 Sistem Kuliah</a>
    <div class="d-flex">
      <span class="text-white me-3"><?= esc(session('nama_user')); ?> (<?= esc(session('role')); ?>)</span>
      <a href="<?= base_url('logout'); ?>" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="main-content">
  <div class="main-card">
    <?= $this->renderSection('content'); ?>
  </div>
</div>

<footer>
  &copy; <?= date('Y'); ?> Sistem Manajemen Kuliah — All Rights Reserved
</footer>

</body>
</html>
