<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-gradient-primary text-white py-4 border-0">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="mb-1 fw-bold d-flex align-items-center">
                                <i class="bi bi-clock-history me-3 fs-3"></i>
                                <span>Riwayat Skrining Anda</span>
                            </h4>
                            <p class="mb-0 opacity-90 small">Pantau kesehatan lambung Anda secara berkala</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <a href="<?= BASEURL; ?>/pasien/formulir" class="btn btn-light btn-lg rounded-pill px-4 shadow-sm">
                                <i class="bi bi-plus-circle me-2"></i>Skrining Baru
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <?php if (empty($data['riwayat'])) : ?>
                        <!-- Empty State -->
                        <div class="text-center py-5 px-3">
                            <div class="empty-state-icon mb-4">
                                <i class="bi bi-clipboard-data display-1 text-primary opacity-25"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">Belum Ada Riwayat Skrining</h5>
                            <p class="text-muted mb-4">Mulai perjalanan kesehatan Anda dengan melakukan skrining pertama</p>
                            <a href="<?= BASEURL; ?>/pasien/formulir" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                                <i class="bi bi-heart-pulse me-2"></i>Mulai Skrining Sekarang
                            </a>
                        </div>
                    <?php else : ?>
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-lg-block">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr class="text-secondary small text-uppercase">
                                        <th class="ps-4 py-3 fw-semibold" width="5%">No</th>
                                        <th class="py-3 fw-semibold" width="20%">Tanggal & Waktu</th>
                                        <th class="py-3 fw-semibold text-center" width="12%">Skor</th>
                                        <th class="py-3 fw-semibold" width="20%">Kategori Risiko</th>
                                        <th class="py-3 fw-semibold" width="18%">Status Review</th>
                                        <th class="pe-4 py-3 fw-semibold text-end" width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($data['riwayat'] as $rw) : ?>
                                        <tr class="border-bottom">
                                            <td class="ps-4">
                                                <span class="badge bg-light text-dark rounded-circle p-2" style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">
                                                    <?= $no++; ?>
                                                </span>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-wrapper me-3">
                                                        <i class="bi bi-calendar-event text-primary fs-5"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold text-dark"><?= date('d M Y', strtotime($rw['tanggal_skrining'])); ?></div>
                                                        <small class="text-muted">
                                                            <i class="bi bi-clock me-1"></i><?= date('H:i', strtotime($rw['tanggal_skrining'])); ?> WITA
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div class="score-badge">
                                                    <span class="fw-bold fs-4 text-primary"><?= $rw['total_skor']; ?></span>
                                                    <span class="text-muted small">/60</span>
                                                </div>
                                            </td>

                                            <td>
                                                <?php
                                                $bgClass = 'bg-success';
                                                $icon = '<i class="bi bi-shield-check me-2"></i>';
                                                $textClass = 'text-white';

                                                if ($rw['kategori_risiko'] == 'Risiko Tinggi') {
                                                    $bgClass = 'bg-danger';
                                                    $icon = '<i class="bi bi-exclamation-triangle-fill me-2"></i>';
                                                } elseif ($rw['kategori_risiko'] == 'Risiko Sedang') {
                                                    $bgClass = 'bg-warning';
                                                    $icon = '<i class="bi bi-exclamation-circle-fill me-2"></i>';
                                                }
                                                ?>
                                                <span class="badge <?= $bgClass; ?> <?= $textClass; ?> rounded-pill px-3 py-2 fw-normal">
                                                    <?= $icon . $rw['kategori_risiko']; ?>
                                                </span>
                                            </td>

                                            <td>
                                                <?php if ($rw['feedback_admin']) : ?>
                                                    <span class="badge bg-primary rounded-pill px-3 py-2 fw-normal">
                                                        <i class="bi bi-check-circle-fill me-2"></i>Telah Direview
                                                    </span>
                                                <?php else : ?>
                                                    <span class="badge bg-secondary rounded-pill px-3 py-2 fw-normal">
                                                        <i class="bi bi-hourglass-split me-2"></i>Menunggu Review
                                                    </span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="pe-4 text-end">
                                                <a href="<?= BASEURL; ?>/pasien/detail/<?= $rw['id']; ?>"
                                                    class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm btn-hover">
                                                    <i class="bi bi-eye me-1"></i>Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="d-lg-none p-3">
                            <?php $no = 1;
                            foreach ($data['riwayat'] as $rw) : ?>
                                <div class="card mb-3 shadow-sm border-0 rounded-3 card-hover">
                                    <div class="card-body p-3">
                                        <!-- Header -->
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="badge bg-light text-dark rounded-circle me-2" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">
                                                        <?= $no++; ?>
                                                    </span>
                                                    <span class="fw-bold text-dark"><?= date('d M Y', strtotime($rw['tanggal_skrining'])); ?></span>
                                                </div>
                                                <small class="text-muted">
                                                    <i class="bi bi-clock me-1"></i><?= date('H:i', strtotime($rw['tanggal_skrining'])); ?> WITA
                                                </small>
                                            </div>
                                            <div class="text-center">
                                                <div class="fw-bold fs-4 text-primary"><?= $rw['total_skor']; ?></div>
                                                <small class="text-muted">/60</small>
                                            </div>
                                        </div>

                                        <!-- Risk Category -->
                                        <div class="mb-3">
                                            <?php
                                            $bgClass = 'bg-success';
                                            $icon = '<i class="bi bi-shield-check me-2"></i>';

                                            if ($rw['kategori_risiko'] == 'Risiko Tinggi') {
                                                $bgClass = 'bg-danger';
                                                $icon = '<i class="bi bi-exclamation-triangle-fill me-2"></i>';
                                            } elseif ($rw['kategori_risiko'] == 'Risiko Sedang') {
                                                $bgClass = 'bg-warning';
                                                $icon = '<i class="bi bi-exclamation-circle-fill me-2"></i>';
                                            }
                                            ?>
                                            <span class="badge <?= $bgClass; ?> text-white rounded-pill px-3 py-2 fw-normal w-100">
                                                <?= $icon . $rw['kategori_risiko']; ?>
                                            </span>
                                        </div>

                                        <!-- Status & Action -->
                                        <div class="d-flex justify-content-between align-items-center gap-2">
                                            <div class="flex-grow-1">
                                                <?php if ($rw['feedback_admin']) : ?>
                                                    <span class="badge bg-primary rounded-pill px-3 py-2 fw-normal w-100">
                                                        <i class="bi bi-check-circle-fill me-1"></i>Telah Direview
                                                    </span>
                                                <?php else : ?>
                                                    <span class="badge bg-secondary rounded-pill px-3 py-2 fw-normal w-100">
                                                        <i class="bi bi-hourglass-split me-1"></i>Menunggu Review
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <a href="<?= BASEURL; ?>/pasien/detail/<?= $rw['id']; ?>"
                                                class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm">
                                                <i class="bi bi-eye me-1"></i>Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Gradient Background */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Card Hover Effects */
    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }

    /* Button Hover Effect */
    .btn-hover {
        transition: all 0.3s ease;
    }

    .btn-hover:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4) !important;
    }

    /* Table Row Hover */
    .table-hover tbody tr {
        transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
    }

    /* Custom Shadows */
    .shadow-lg {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07) !important;
    }

    /* Responsive Font Sizes */
    @media (max-width: 768px) {
        .card-header h4 {
            font-size: 1.25rem;
        }

        .card-header p {
            font-size: 0.875rem;
        }
    }

    /* Badge Animations */
    .badge {
        transition: all 0.2s ease;
    }

    .badge:hover {
        transform: scale(1.05);
    }

    /* Empty State Animation */
    .empty-state-icon i {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    /* Score Badge Styling */
    .score-badge {
        padding: 0.5rem;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    }

    /* Table Padding */
    .table> :not(caption)>*>* {
        padding: 1.25rem 0.75rem;
    }

    /* Smooth Scrolling for Table */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Custom Scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #667eea;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #764ba2;
    }
</style>