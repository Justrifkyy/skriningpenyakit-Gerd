<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> - GERD Screening</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="<?= BASEURL; ?>">
                <img src="<?= BASEURL; ?>/img/umi.png" alt="Logo UMI" height="45" class="me-2">
                <img src="<?= BASEURL; ?>/img/fkm.png" alt="Logo FKM" height="60" class="me-3">

                <div class="d-flex flex-column" style="line-height: 1.1;">
                    <span class="fw-bold text-primary" style="font-size: 1.1rem;">GERD Care</span>
                    <small class="text-muted fw-bold" style="font-size: 0.65rem; letter-spacing: 0.5px;">KESEHATAN MASYARAKAT UMI</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">

                    <?php if (isset($_SESSION['user_session'])): ?>
                        <?php if ($_SESSION['user_session']['role'] == 'admin'): ?>

                            <li class="nav-item">
                                <a class="nav-link <?= ($_GET['url'] == 'admin' || $_GET['url'] == 'admin/index') ? 'active fw-bold text-primary' : ''; ?>" href="<?= BASEURL; ?>/admin">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= (strpos($_GET['url'] ?? '', 'admin/pasien') !== false) ? 'active fw-bold text-primary' : ''; ?>" href="<?= BASEURL; ?>/admin/pasien">Data Pasien</a>
                            </li>

                        <?php else: ?>

                            <li class="nav-item">
                                <a class="nav-link <?= ($_GET['url'] == 'pasien' || $_GET['url'] == 'pasien/index') ? 'active fw-bold text-primary' : ''; ?>" href="<?= BASEURL; ?>/pasien">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= (strpos($_GET['url'] ?? '', 'pasien/formulir') !== false) ? 'active fw-bold text-primary' : ''; ?>" href="<?= BASEURL; ?>/pasien/formulir">Mulai Skrining</a>
                            </li>

                        <?php endif; ?>

                        <li class="nav-item ms-2">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle btn btn-light px-3 rounded-pill border" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-1"></i>
                                    <?= explode(' ', $_SESSION['user_session']['nama_lengkap'])[0]; ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                    <li>
                                        <div class="dropdown-header text-muted">Akun Saya</div>
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="<?= BASEURL; ?>/auth/logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>

                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="<?= BASEURL; ?>/auth">Masuk</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link btn btn-primary text-white px-4 rounded-pill shadow-sm" href="<?= BASEURL; ?>/auth/register">Daftar</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <main>