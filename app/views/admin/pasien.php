<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid px-3 px-md-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h2 class="fw-bold text-primary mb-2">
                        <i class="bi bi-people-fill me-2"></i>Data Pasien Skrining
                    </h2>
                    <p class="text-muted mb-0 small">Kelola hasil tes dan berikan feedback medis kepada pasien</p>
                </div>
                <div>
                    <a href="<?= BASEURL; ?>/admin/export" target="_blank" class="btn btn-success shadow-sm">
                        <i class="bi bi-file-earmark-excel-fill me-2"></i>
                        <span class="d-none d-sm-inline">Export </span>Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    <div class="row mb-3">
        <div class="col-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <!-- Statistics Cards (Optional - bisa dihapus jika tidak perlu) -->
    <div class="row g-3 mb-4 d-none d-lg-flex">
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-people-fill text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 small">Total Pasien</h6>
                            <h4 class="mb-0 fw-bold"><?= count($data['screenings']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-check2-circle text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 small">Selesai</h6>
                            <h4 class="mb-0 fw-bold">
                                <?= count(array_filter($data['screenings'], function ($s) {
                                    return $s['feedback_admin'];
                                })); ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-hourglass-split text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 small">Menunggu</h6>
                            <h4 class="mb-0 fw-bold">
                                <?= count(array_filter($data['screenings'], function ($s) {
                                    return !$s['feedback_admin'];
                                })); ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-danger bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-exclamation-triangle-fill text-danger fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 small">Risiko Tinggi</h6>
                            <h4 class="mb-0 fw-bold">
                                <?= count(array_filter($data['screenings'], function ($s) {
                                    return $s['kategori_risiko'] == 'Risiko Tinggi';
                                })); ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-3 p-md-4">
                    <div class="table-responsive">
                        <table id="tabelPasien" class="table table-hover align-middle" style="width:100%">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3 border-0">Pasien</th>
                                    <th class="py-3 border-0 d-none d-md-table-cell">Waktu Tes</th>
                                    <th class="py-3 text-center border-0">Skor</th>
                                    <th class="py-3 border-0 d-none d-lg-table-cell">Kategori Risiko</th>
                                    <th class="py-3 border-0 d-none d-xl-table-cell">Status</th>
                                    <th class="py-3 px-3 border-0 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['screenings'] as $row) : ?>
                                    <tr class="patient-row">
                                        <!-- Pasien Column -->
                                        <td class="px-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-2 me-md-3 bg-primary bg-gradient text-white d-flex justify-content-center align-items-center rounded-circle fw-bold shadow-sm" style="width: 40px; height: 40px; font-size: 14px; min-width: 40px;">
                                                    <?= strtoupper(substr($row['nama_lengkap'], 0, 2)); ?>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <div class="fw-bold text-dark text-truncate"><?= $row['nama_lengkap']; ?></div>
                                                    <div class="small text-muted text-truncate d-none d-sm-block" style="font-size: 12px;">
                                                        <i class="bi bi-envelope me-1"></i><?= $row['email']; ?>
                                                    </div>
                                                    <!-- Mobile: Show time on small screens -->
                                                    <div class="small text-muted d-md-none mt-1" style="font-size: 11px;">
                                                        <i class="bi bi-calendar-event me-1"></i><?= date('d/m/Y H:i', strtotime($row['tanggal_skrining'])); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Waktu Tes Column (Hidden on mobile) -->
                                        <td class="d-none d-md-table-cell">
                                            <div class="text-muted small">
                                                <div class="mb-1">
                                                    <i class="bi bi-calendar-event me-1"></i><?= date('d M Y', strtotime($row['tanggal_skrining'])); ?>
                                                </div>
                                                <div>
                                                    <i class="bi bi-clock me-1"></i><?= date('H:i', strtotime($row['tanggal_skrining'])); ?> WITA
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Skor Column -->
                                        <td class="text-center">
                                            <div class="score-badge bg-light rounded-3 d-inline-block px-3 py-2">
                                                <h5 class="fw-bold mb-0 text-primary"><?= $row['total_skor']; ?></h5>
                                            </div>
                                            <!-- Mobile: Show risk category below score -->
                                            <div class="d-lg-none mt-2">
                                                <?php
                                                $badgeClass = 'bg-light text-dark';
                                                $icon = '';

                                                if ($row['kategori_risiko'] == 'Risiko Tinggi') {
                                                    $badgeClass = 'bg-danger text-white';
                                                    $icon = '<i class="bi bi-exclamation-triangle-fill me-1"></i>';
                                                } elseif ($row['kategori_risiko'] == 'Risiko Sedang') {
                                                    $badgeClass = 'bg-warning text-dark';
                                                    $icon = '<i class="bi bi-exclamation-circle-fill me-1"></i>';
                                                } else {
                                                    $badgeClass = 'bg-success text-white';
                                                    $icon = '<i class="bi bi-shield-check-fill me-1"></i>';
                                                }
                                                ?>
                                                <span class="badge rounded-pill fw-normal px-2 py-1 <?= $badgeClass; ?>" style="font-size: 10px;">
                                                    <?= $icon . $row['kategori_risiko']; ?>
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Kategori Risiko Column (Hidden on smaller screens) -->
                                        <td class="d-none d-lg-table-cell">
                                            <?php
                                            $badgeClass = 'bg-light text-dark border';
                                            $icon = '';

                                            if ($row['kategori_risiko'] == 'Risiko Tinggi') {
                                                $badgeClass = 'bg-danger text-white';
                                                $icon = '<i class="bi bi-exclamation-triangle-fill me-1"></i>';
                                            } elseif ($row['kategori_risiko'] == 'Risiko Sedang') {
                                                $badgeClass = 'bg-warning text-dark';
                                                $icon = '<i class="bi bi-exclamation-circle-fill me-1"></i>';
                                            } else {
                                                $badgeClass = 'bg-success text-white';
                                                $icon = '<i class="bi bi-shield-check-fill me-1"></i>';
                                            }
                                            ?>
                                            <span class="badge rounded-pill fw-normal px-3 py-2 <?= $badgeClass; ?> shadow-sm">
                                                <?= $icon . $row['kategori_risiko']; ?>
                                            </span>
                                        </td>

                                        <!-- Status Column (Hidden on smaller screens) -->
                                        <td class="d-none d-xl-table-cell">
                                            <?php if ($row['feedback_admin']): ?>
                                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill border border-primary">
                                                    <i class="bi bi-check2-all me-1"></i>Selesai
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill border border-secondary">
                                                    <i class="bi bi-hourglass-split me-1"></i>Menunggu
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Aksi Column -->
                                        <td class="text-end px-3">
                                            <?php if ($row['feedback_admin']): ?>
                                                <a href="<?= BASEURL; ?>/admin/beri_feedback/<?= $row['id']; ?>"
                                                    class="btn btn-outline-primary btn-sm rounded-pill px-3 shadow-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                    <span class="d-none d-sm-inline ms-1">Edit</span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= BASEURL; ?>/admin/beri_feedback/<?= $row['id']; ?>"
                                                    class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                                    <i class="bi bi-chat-text-fill"></i>
                                                    <span class="d-none d-sm-inline ms-1">Balas</span>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabelPasien').DataTable({
            "language": {
                "search": "Cari:",
                "searchPlaceholder": "Nama atau email...",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "›",
                    "previous": "‹"
                },
                "zeroRecords": "Tidak ada data yang cocok",
                "emptyTable": "Tidak ada data tersedia"
            },
            "order": [],
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "responsive": true,
            "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
        });
    });
</script>

<style>
    /* General Improvements */
    body {
        background-color: #f8f9fa;
    }

    /* Avatar Circle */
    .avatar-circle {
        flex-shrink: 0;
        transition: transform 0.2s ease;
    }

    /* Card Enhancements */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    }

    /* Table Row Hover */
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

    /* Score Badge */
    .score-badge {
        transition: all 0.2s ease;
    }

    .patient-row:hover .score-badge {
        background-color: #e7f1ff !important;
    }

    /* DataTables Custom Styling */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px;
        padding: 6px 16px;
        border: 1px solid #dee2e6;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        outline: none;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 10px;
        padding: 4px 12px;
        border: 1px solid #dee2e6;
    }

    /* Pagination */
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        border-radius: 8px;
    }

    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
        background-color: #e7f1ff;
        border-color: #0d6efd;
    }

    /* Badge Enhancements */
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
        transition: all 0.2s ease;
    }

    .badge:hover {
        transform: scale(1.05);
    }

    /* Button Enhancements */
    .btn {
        transition: all 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-sm {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
    }

    /* Table Header */
    thead th {
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
    }

    /* Responsive Text */
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .card-body {
            padding: 1rem !important;
        }

        h2 {
            font-size: 1.5rem;
        }

        .table {
            font-size: 0.875rem;
        }

        .avatar-circle {
            width: 35px !important;
            height: 35px !important;
            font-size: 12px !important;
        }
    }

    /* Loading Animation */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    /* Smooth Scrolling */
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

    /* Text Truncate for Email */
    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>