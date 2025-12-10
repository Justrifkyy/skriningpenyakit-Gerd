<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h2 class="fw-bold text-dark mb-2">
                        <i class="bi bi-speedometer2 text-primary me-2"></i>Dashboard Overview
                    </h2>
                    <p class="text-muted mb-0">Ringkasan aktivitas skrining kesehatan pasien</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm" onclick="window.location.reload()">
                        <i class="bi bi-arrow-clockwise me-1"></i>Refresh
                    </button>
                    <a href="<?= BASEURL; ?>/admin/pasien" class="btn btn-primary btn-sm">
                        <i class="bi bi-people-fill me-1"></i>Lihat Semua Pasien
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 g-md-4 mb-4">
        <!-- Total Skrining Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-1">Total Skrining</h6>
                            <h2 class="display-5 fw-bold mb-0 text-primary"><?= $data['stats']['total_pasien']; ?></h2>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-clipboard-data-fill text-primary fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-graph-up me-1"></i>
                        <span>Total pasien terdaftar</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Risiko Tinggi Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-1">Risiko Tinggi</h6>
                            <h2 class="display-5 fw-bold mb-0 text-danger"><?= $data['stats']['total_tinggi']; ?></h2>
                        </div>
                        <div class="stat-icon bg-danger bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-heart-pulse me-1"></i>
                        <span>Perlu perhatian khusus</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menunggu Feedback Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-1">Menunggu Feedback</h6>
                            <h2 class="display-5 fw-bold mb-0 text-warning"><?= $data['stats']['belum_feedback']; ?></h2>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-hourglass-split text-warning fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-clock-history me-1"></i>
                        <span>Menunggu validasi dokter</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selesai Validasi Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="stat-card card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h6 class="text-uppercase text-muted small fw-bold mb-1">Selesai Validasi</h6>
                            <h2 class="display-5 fw-bold mb-0 text-success"><?= $data['stats']['sudah_feedback']; ?></h2>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 rounded-3 p-3">
                            <i class="bi bi-check-circle-fill text-success fs-3"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-muted small">
                        <i class="bi bi-shield-check me-1"></i>
                        <span>Telah diberi feedback</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-3 g-md-4 mb-4">
        <!-- Chart Risiko -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 fw-bold">
                                <i class="bi bi-pie-chart-fill text-primary me-2"></i>Sebaran Tingkat Risiko
                            </h5>
                            <p class="text-muted small mb-0">Distribusi kategori risiko pasien</p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="chart-container" style="position: relative; height: 280px;">
                        <canvas id="chartRisiko"></canvas>
                    </div>
                    <!-- Legend Custom -->
                    <div class="row g-2 mt-3">
                        <div class="col-4">
                            <div class="d-flex align-items-center">
                                <div class="legend-dot bg-danger me-2"></div>
                                <div>
                                    <div class="small text-muted">Tinggi</div>
                                    <div class="fw-bold"><?= $data['stats']['total_tinggi']; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex align-items-center">
                                <div class="legend-dot bg-warning me-2"></div>
                                <div>
                                    <div class="small text-muted">Sedang</div>
                                    <div class="fw-bold"><?= $data['stats']['total_sedang']; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex align-items-center">
                                <div class="legend-dot bg-success me-2"></div>
                                <div>
                                    <div class="small text-muted">Rendah</div>
                                    <div class="fw-bold"><?= $data['stats']['total_rendah']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Feedback -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1 fw-bold">
                                <i class="bi bi-bar-chart-fill text-primary me-2"></i>Produktivitas Feedback
                            </h5>
                            <p class="text-muted small mb-0">Status pemberian feedback dokter</p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="chart-container" style="position: relative; height: 280px;">
                        <canvas id="chartFeedback"></canvas>
                    </div>
                    <!-- Progress Stats -->
                    <div class="mt-4">
                        <?php
                        $total = $data['stats']['sudah_feedback'] + $data['stats']['belum_feedback'];
                        $percentage = $total > 0 ? round(($data['stats']['sudah_feedback'] / $total) * 100) : 0;
                        ?>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted small">Progress Validasi</span>
                            <span class="fw-bold text-primary"><?= $percentage; ?>%</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar bg-gradient" role="progressbar"
                                style="width: <?= $percentage; ?>%; background: linear-gradient(90deg, #0d6efd, #0a58ca);"
                                aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Patients Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <h5 class="mb-1 fw-bold">
                                <i class="bi bi-clock-history text-primary me-2"></i>Pasien Terbaru Masuk
                            </h5>
                            <p class="text-muted small mb-0">Daftar pasien yang baru melakukan skrining</p>
                        </div>
                        <a href="<?= BASEURL; ?>/admin/pasien" class="btn btn-primary btn-sm rounded-pill px-4">
                            <i class="bi bi-eye me-1"></i>Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 border-0">
                                        <i class="bi bi-person-fill me-1"></i>Nama Pasien
                                    </th>
                                    <th class="py-3 border-0 d-none d-md-table-cell">
                                        <i class="bi bi-calendar-event me-1"></i>Tanggal
                                    </th>
                                    <th class="py-3 border-0 text-center">
                                        <i class="bi bi-star-fill me-1"></i>Skor
                                    </th>
                                    <th class="py-3 border-0 d-none d-lg-table-cell">
                                        <i class="bi bi-shield-exclamation me-1"></i>Risiko
                                    </th>
                                    <th class="py-3 border-0 pe-4 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($data['terbaru'])): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                <p class="mb-0">Belum ada data pasien</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($data['terbaru'] as $index => $row): ?>
                                        <tr class="patient-row" style="animation: fadeIn 0.3s ease-in-out <?= $index * 0.05; ?>s both;">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle me-3 bg-primary bg-gradient text-white d-flex justify-content-center align-items-center rounded-circle fw-bold shadow-sm"
                                                        style="width: 40px; height: 40px; min-width: 40px; font-size: 14px;">
                                                        <?= strtoupper(substr($row['nama_lengkap'], 0, 2)); ?>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <div class="fw-bold text-dark"><?= $row['nama_lengkap']; ?></div>
                                                        <div class="small text-muted d-md-none mt-1">
                                                            <i class="bi bi-calendar-event me-1"></i>
                                                            <?= date('d M, H:i', strtotime($row['tanggal_skrining'])); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted small d-none d-md-table-cell">
                                                <div>
                                                    <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($row['tanggal_skrining'])); ?>
                                                </div>
                                                <div class="mt-1">
                                                    <i class="bi bi-clock me-1"></i><?= date('H:i', strtotime($row['tanggal_skrining'])); ?> WITA
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-primary rounded-pill px-3 py-2 fw-bold" style="font-size: 1rem;">
                                                    <?= $row['total_skor']; ?>
                                                </span>
                                            </td>
                                            <td class="d-none d-lg-table-cell">
                                                <?php
                                                $badgeClass = 'success';
                                                $icon = 'shield-check-fill';
                                                if ($row['kategori_risiko'] == 'Risiko Tinggi') {
                                                    $badgeClass = 'danger';
                                                    $icon = 'exclamation-triangle-fill';
                                                } elseif ($row['kategori_risiko'] == 'Risiko Sedang') {
                                                    $badgeClass = 'warning';
                                                    $icon = 'exclamation-circle-fill';
                                                }
                                                ?>
                                                <span class="badge bg-<?= $badgeClass; ?> bg-opacity-10 text-<?= $badgeClass; ?> border border-<?= $badgeClass; ?> rounded-pill px-3 py-2">
                                                    <i class="bi bi-<?= $icon; ?> me-1"></i><?= $row['kategori_risiko']; ?>
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="<?= BASEURL; ?>/admin/beri_feedback/<?= $row['id']; ?>"
                                                    class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm">
                                                    <i class="bi bi-eye me-1"></i>
                                                    <span class="d-none d-sm-inline">Detail</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // --- Chart Configuration ---
    Chart.defaults.font.family = "'Inter', 'Segoe UI', sans-serif";
    Chart.defaults.color = '#6c757d';

    // --- 1. Chart Risiko (Doughnut) ---
    const ctxRisiko = document.getElementById('chartRisiko').getContext('2d');
    const chartRisiko = new Chart(ctxRisiko, {
        type: 'doughnut',
        data: {
            labels: ['Risiko Tinggi', 'Risiko Sedang', 'Risiko Rendah'],
            datasets: [{
                data: [
                    <?= $data['stats']['total_tinggi']; ?>,
                    <?= $data['stats']['total_sedang']; ?>,
                    <?= $data['stats']['total_rendah']; ?>
                ],
                backgroundColor: [
                    '#dc3545',
                    '#ffc107',
                    '#198754'
                ],
                borderWidth: 0,
                hoverOffset: 15,
                offset: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed / total) * 100).toFixed(1);
                            return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true,
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // --- 2. Chart Feedback (Bar) ---
    const ctxFeedback = document.getElementById('chartFeedback').getContext('2d');
    const chartFeedback = new Chart(ctxFeedback, {
        type: 'bar',
        data: {
            labels: ['Sudah Dibalas', 'Belum Dibalas'],
            datasets: [{
                label: 'Jumlah Pasien',
                data: [
                    <?= $data['stats']['sudah_feedback']; ?>,
                    <?= $data['stats']['belum_feedback']; ?>
                ],
                backgroundColor: [
                    'rgba(13, 110, 253, 0.8)',
                    'rgba(108, 117, 125, 0.6)'
                ],
                borderColor: [
                    'rgba(13, 110, 253, 1)',
                    'rgba(108, 117, 125, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8,
                barPercentage: 0.6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return 'Total: ' + context.parsed.y + ' pasien';
                        }
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // --- Hover Effects untuk Cards ---
    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>

<style>
    /* General Improvements */
    body {
        background-color: #f8f9fa;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    /* Stat Cards */
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 16px;
        position: relative;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
    }

    .stat-icon {
        transition: transform 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
    }

    /* Cards */
    .card {
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
    }

    .card-header {
        border-radius: 16px 16px 0 0 !important;
    }

    /* Chart Container */
    .chart-container {
        padding: 10px;
    }

    /* Legend Dots */
    .legend-dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* Avatar Circle */
    .avatar-circle {
        flex-shrink: 0;
        transition: transform 0.2s ease;
    }

    /* Table Enhancements */
    .patient-row {
        transition: all 0.2s ease;
    }

    .table-hover tbody .patient-row:hover {
        background-color: #f8f9fa;
        transform: scale(1.002);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: relative;
        z-index: 1;
    }

    .patient-row:hover .avatar-circle {
        transform: scale(1.1);
    }

    /* Badges */
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
        transition: all 0.2s ease;
    }

    /* Buttons */
    .btn {
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Progress Bar */
    .progress {
        background-color: #e9ecef;
    }

    .progress-bar {
        transition: width 1s ease-in-out;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 576px) {
        .display-5 {
            font-size: 2rem;
        }

        .stat-icon {
            padding: 0.75rem !important;
        }

        .stat-icon i {
            font-size: 1.5rem !important;
        }

        .card-body {
            padding: 1.5rem !important;
        }

        h2 {
            font-size: 1.5rem;
        }

        .avatar-circle {
            width: 35px !important;
            height: 35px !important;
            min-width: 35px !important;
            font-size: 12px !important;
        }
    }

    @media (max-width: 768px) {
        .chart-container {
            height: 250px !important;
        }
    }

    /* Scrollbar */
    .table-responsive {
        scrollbar-width: thin;
        scrollbar-color: #0d6efd #f8f9fa;
    }

    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f8f9fa;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #0d6efd;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #0b5ed7;
    }

    /* Empty State */
    .text-muted i.bi-inbox {
        opacity: 0.3;
    }
</style>