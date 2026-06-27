<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }
        .login-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 380px;
        }
        .login-header {
            background: linear-gradient(135deg, #1d976c, #2bc0e4);
            color: white;
            text-align: center;
            padding: 1.5rem;
        }
        .login-header h4 {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .login-header i {
            font-size: 2.2rem;
        }
        .form-control:focus {
            border-color: #1d976c;
            box-shadow: 0 0 5px rgba(29,151,108,0.5);
        }
        .btn-login {
            background-color: #1d976c;
            border: none;
        }
        .btn-login:hover {
            background-color: #16845e;
        }
        .card-footer {
            background-color: #f8f9fa;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <i class="bi bi-mortarboard"></i>
        <h4>Sistem Manajemen Kuliah</h4>
        <p class="mb-0 small text-light">Silakan login untuk melanjutkan</p>
    </div>
    <div class="card-body p-4">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('auth/login') ?>">
            <div class="mb-3">
                <label class="form-label fw-semibold">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-login w-100 text-white fw-bold">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>
    </div>
    <div class="card-footer py-3">
        &copy; <?= date('Y') ?> Sistem Kuliah - Universitas 
    </div>
</div>

</body>
</html>
