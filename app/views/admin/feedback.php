<style>
    .sticky-card {
        position: sticky;
        top: 90px;
        z-index: 10;
    }

    .question-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .question-card:hover {
        border-left-color: #0d6efd;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }

    .badge-response {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        border-radius: 8px;
    }

    .risk-badge {
        font-size: 1rem;
        padding: 0.5rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
    }

    .category-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin: 1.5rem 0 1rem 0;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(102, 126, 234, 0.3);
    }

    .card-header-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.25rem;
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .card-header-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .score-display {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 12px;
        padding: 1.25rem;
        color: white;
        box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
    }

    .score-display.low-risk {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        box-shadow: 0 4px 15px rgba(56, 239, 125, 0.3);
    }

    .question-row {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }

    .question-row:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }

    .btn-primary-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.875rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-primary-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    .info-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        background: #e7f3ff;
        color: #0066cc;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    @media (max-width: 991.98px) {
        .sticky-card {
            position: relative;
            top: 0;
        }
    }

    .scrollable-content {
        max-height: 600px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #667eea #f1f1f1;
    }

    .scrollable-content::-webkit-scrollbar {
        width: 8px;
    }

    .scrollable-content::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .scrollable-content::-webkit-scrollbar-thumb {
        background: #667eea;
        border-radius: 10px;
    }

    .scrollable-content::-webkit-scrollbar-thumb:hover {
        background: #764ba2;
    }
</style>

<div class="container-fluid px-3 px-md-4 mt-4 mb-5">

    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="mb-2 fw-bold">
                <i class="bi bi-clipboard-pulse text-primary"></i> Lembar Konsultasi & Feedback
            </h2>
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <span class="info-badge">
                    <i class="bi bi-hash"></i> Rekam Medis: <?= $data['detail']['id']; ?>
                </span>
                <span class="info-badge">
                    <i class="bi bi-person-fill"></i> <?= $data['detail']['nama_lengkap']; ?>
                </span>
            </div>
        </div>
        <a href="<?= BASEURL; ?>/admin/pasien" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row g-4">

        <!-- Left Column: Medical History -->
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header-custom">
                    <h5 class="mb-0">
                        <i class="bi bi-clipboard-data"></i> Riwayat Keluhan (Anamnesa)
                    </h5>
                </div>

                <div class="card-body p-3 p-md-4 scrollable-content">

                    <!-- Score Display -->
                    <div class="score-display <?= ($data['detail']['kategori_risiko'] == 'Risiko Tinggi') ? '' : 'low-risk'; ?> mb-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <div class="small opacity-75 mb-1">Total Skor Keluhan</div>
                                <h3 class="mb-0 fw-bold"><?= $data['detail']['total_skor']; ?>/60</h3>
                            </div>
                            <div>
                                <span class="risk-badge bg-white text-dark">
                                    <?= $data['detail']['kategori_risiko']; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Questions by Category -->
                    <?php
                    $index_soal = 0;
                    foreach ($data['list_pertanyaan'] as $kategori => $soal_soal):
                    ?>
                        <div class="category-header">
                            <i class="bi bi-folder2-open"></i> <?= $kategori; ?>
                        </div>

                        <div class="mb-4">
                            <?php foreach ($soal_soal as $soal):
                                $jawaban = $data['jawaban_pasien'][$index_soal] ?? 0;

                                $teks_jawab = '';
                                $badge_class = '';
                                $icon = '';

                                if ($jawaban == 2) {
                                    $teks_jawab = 'SERING';
                                    $badge_class = 'bg-danger text-white';
                                    $icon = 'bi-exclamation-circle-fill';
                                } elseif ($jawaban == 1) {
                                    $teks_jawab = 'KADANG';
                                    $badge_class = 'bg-warning text-dark';
                                    $icon = 'bi-exclamation-triangle-fill';
                                } else {
                                    $teks_jawab = 'TIDAK';
                                    $badge_class = 'bg-success text-white';
                                    $icon = 'bi-check-circle-fill';
                                }
                            ?>
                                <div class="question-row d-flex justify-content-between align-items-center gap-3 mb-2">
                                    <div class="flex-grow-1">
                                        <span class="text-muted small"><?= $index_soal + 1 ?>.</span>
                                        <?= $soal; ?>
                                    </div>
                                    <div class="text-end flex-shrink-0">
                                        <span class="badge-response badge <?= $badge_class; ?>">
                                            <i class="bi <?= $icon; ?>"></i> <?= $teks_jawab; ?>
                                        </span>
                                    </div>
                                </div>
                            <?php $index_soal++;
                            endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

        <!-- Right Column: Doctor's Notes -->
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 sticky-card">
                <div class="card-header-custom card-header-success">
                    <h5 class="mb-0">
                        <i class="bi bi-person-badge"></i> Catatan Dokter / Admin
                    </h5>
                </div>
                <div class="card-body p-3 p-md-4">

                    <form action="<?= BASEURL; ?>/admin/prosesFeedback" method="post">
                        <input type="hidden" name="id" value="<?= $data['detail']['id']; ?>">

                        <!-- Examination Date -->
                        <div class="mb-4">
                            <label class="form-label text-muted small d-flex align-items-center gap-2">
                                <i class="bi bi-calendar-event"></i> Tanggal Pemeriksaan
                            </label>
                            <input type="text" class="form-control bg-light border-0 shadow-sm"
                                value="<?= ($data['detail']['tanggal_feedback']) ? date('d F Y, H:i', strtotime($data['detail']['tanggal_feedback'])) : date('d F Y, H:i') . ' (Sekarang)'; ?>"
                                readonly>
                        </div>

                        <!-- Diagnosis -->
                        <div class="mb-4">
                            <label class="form-label fw-bold d-flex align-items-center gap-2">
                                <i class="bi bi-clipboard-pulse text-primary"></i> Diagnosa / Kesimpulan
                            </label>
                            <select name="diagnosa" class="form-select shadow-sm border-primary" required>
                                <option value="" disabled selected>Pilih Diagnosa...</option>
                                <option value="GERD Positif (Perlu Obat)" <?= ($data['detail']['diagnosa'] == 'GERD Positif (Perlu Obat)') ? 'selected' : ''; ?>>
                                    🔴 GERD Positif (Perlu Obat)
                                </option>
                                <option value="Gejala Ringan (Dispepsia)" <?= ($data['detail']['diagnosa'] == 'Gejala Ringan (Dispepsia)') ? 'selected' : ''; ?>>
                                    🟡 Gejala Ringan (Dispepsia)
                                </option>
                                <option value="Normal / Sehat" <?= ($data['detail']['diagnosa'] == 'Normal / Sehat') ? 'selected' : ''; ?>>
                                    🟢 Normal / Sehat
                                </option>
                                <option value="Butuh Pemeriksaan Lanjutan" <?= ($data['detail']['diagnosa'] == 'Butuh Pemeriksaan Lanjutan') ? 'selected' : ''; ?>>
                                    🔵 Butuh Pemeriksaan Lanjutan
                                </option>
                            </select>
                        </div>

                        <!-- Clinical Advice -->
                        <div class="mb-4">
                            <label class="form-label fw-bold d-flex align-items-center gap-2">
                                <i class="bi bi-prescription2 text-success"></i> Saran Klinis & Resep
                            </label>
                            <textarea name="feedback" class="form-control shadow-sm border-success" rows="10"
                                placeholder="Contoh:&#10;&#10;📋 Saran Gaya Hidup:&#10;• Hindari makanan pedas dan asam&#10;• Kurangi kafein dan cokelat&#10;• Makan porsi kecil tapi sering&#10;&#10;💊 Resep Obat:&#10;• Omeprazole 20mg - 1x1 sebelum makan pagi&#10;• Antasida sirup - 3x1 sendok setelah makan&#10;&#10;⚠️ Perhatian:&#10;• Jangan tidur 2-3 jam setelah makan&#10;• Tinggikan kepala saat tidur" required><?= $data['detail']['feedback_admin']; ?></textarea>
                            <div class="form-text small">
                                <i class="bi bi-info-circle"></i> Tuliskan saran gaya hidup dan rekomendasi obat secara lengkap
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-gradient btn-lg">
                                <i class="bi bi-send-fill"></i> Simpan & Kirim ke Pasien
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="bi bi-shield-check"></i> Data akan disimpan dengan aman
                            </small>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>