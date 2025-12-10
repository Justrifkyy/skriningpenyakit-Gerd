<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <?php
            // Tentukan warna, icon, dan konfigurasi berdasarkan kategori
            $warna = 'success';
            $bgGradient = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
            $icon = 'bi-shield-check-fill';
            $iconBg = 'rgba(16, 185, 129, 0.1)';
            $pesan = 'Selamat! Risiko Anda rendah. Tetap jaga kesehatan lambung Anda dengan pola makan sehat dan gaya hidup seimbang.';
            $rekomendasi = [
                'Pertahankan pola makan yang sehat dan teratur',
                'Hindari makanan pemicu asam lambung',
                'Lakukan olahraga ringan secara rutin',
                'Kelola stress dengan baik'
            ];

            if ($data['hasil']['kategori'] == 'Risiko Tinggi') {
                $warna = 'danger';
                $bgGradient = 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)';
                $icon = 'bi-exclamation-triangle-fill';
                $iconBg = 'rgba(239, 68, 68, 0.1)';
                $pesan = 'Skor Anda menunjukkan indikasi kuat GERD. Segera konsultasikan dengan dokter spesialis dalam untuk pemeriksaan lebih lanjut.';
                $rekomendasi = [
                    'Konsultasi dengan dokter spesialis dalam sesegera mungkin',
                    'Hindari makanan pedas, asam, dan berlemak tinggi',
                    'Tidur dengan posisi kepala lebih tinggi',
                    'Hindari berbaring setelah makan minimal 2-3 jam'
                ];
            } elseif ($data['hasil']['kategori'] == 'Risiko Sedang') {
                $warna = 'warning';
                $bgGradient = 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)';
                $icon = 'bi-exclamation-circle-fill';
                $iconBg = 'rgba(245, 158, 11, 0.1)';
                $pesan = 'Anda memiliki risiko menengah. Perbaiki pola makan dan gaya hidup Anda untuk mencegah kondisi memburuk.';
                $rekomendasi = [
                    'Konsultasi dengan dokter untuk evaluasi lebih lanjut',
                    'Kurangi konsumsi kafein dan makanan berminyak',
                    'Makan dalam porsi kecil tapi sering',
                    'Hindari merokok dan konsumsi alkohol'
                ];
            }
            ?>

            <!-- Success Animation Card -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4 result-card">
                <div class="card-header text-white text-center py-5 border-0 position-relative" style="background: <?= $bgGradient; ?>">
                    <div class="confetti-container"></div>
                    <div class="result-icon mb-4">
                        <div class="icon-circle">
                            <i class="bi <?= $icon; ?>"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-2">Hasil Skrining GERD Anda</h3>
                    <p class="mb-0 opacity-90">Hasil telah tersimpan dan akan ditinjau oleh dokter</p>
                </div>

                <div class="card-body p-5 text-center">
                    <!-- Score Display -->
                    <div class="score-display mb-4">
                        <div class="score-circle mx-auto" style="background: <?= $iconBg; ?>">
                            <div class="score-number">
                                <span class="display-1 fw-bold text-<?= $warna; ?>"><?= $data['hasil']['skor']; ?></span>
                                <span class="fs-4 text-muted">/60</span>
                            </div>
                        </div>
                    </div>

                    <!-- Category Badge -->
                    <div class="mb-4">
                        <span class="badge badge-<?= $warna; ?> px-4 py-3 fs-5 fw-semibold">
                            <i class="bi <?= $icon; ?> me-2"></i><?= $data['hasil']['kategori']; ?>
                        </span>
                    </div>

                    <!-- Message -->
                    <div class="alert alert-<?= $warna; ?> alert-modern border-0 shadow-sm mx-auto" style="max-width: 600px;">
                        <div class="d-flex align-items-start">
                            <i class="bi <?= $icon; ?> fs-3 me-3 flex-shrink-0"></i>
                            <p class="mb-0 text-start"><?= $pesan; ?></p>
                        </div>
                    </div>

                    <!-- Recommendations -->
                    <div class="recommendations-section mt-5">
                        <h5 class="fw-bold mb-4 text-start">
                            <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                            Rekomendasi untuk Anda
                        </h5>
                        <div class="row g-3">
                            <?php foreach ($rekomendasi as $index => $item): ?>
                                <div class="col-md-6">
                                    <div class="recommendation-card h-100">
                                        <div class="d-flex align-items-start">
                                            <div class="recommendation-number me-3">
                                                <?= $index + 1; ?>
                                            </div>
                                            <p class="mb-0 text-start"><?= $item; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="info-box mt-5">
                        <div class="card border-0 shadow-sm rounded-3" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start">
                                    <div class="info-icon me-3">
                                        <i class="bi bi-info-circle-fill text-primary fs-3"></i>
                                    </div>
                                    <div class="text-start flex-grow-1">
                                        <h6 class="fw-bold mb-2 text-primary">Langkah Selanjutnya</h6>
                                        <p class="mb-2 text-dark">Hasil skrining ini telah dikirim ke Admin/Dokter untuk ditinjau.</p>
                                        <p class="mb-0 small text-muted">
                                            <i class="bi bi-clock-history me-1"></i>
                                            Silakan cek menu <strong>"Riwayat Skrining"</strong> secara berkala untuk mendapatkan feedback dan saran medis lebih lanjut dari dokter.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons mt-5">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="<?= BASEURL; ?>/pasien" class="btn btn-primary btn-lg w-100 rounded-pill shadow">
                                    <i class="bi bi-house-fill me-2"></i>Kembali ke Dashboard
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="<?= BASEURL; ?>/pasien/riwayat" class="btn btn-outline-primary btn-lg w-100 rounded-pill">
                                    <i class="bi bi-clock-history me-2"></i>Lihat Riwayat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info Cards -->
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-calendar-check text-primary fs-1 mb-3"></i>
                            <h6 class="fw-bold mb-2">Skrining Berkala</h6>
                            <p class="small text-muted mb-0">Lakukan skrining ulang setiap 3 bulan untuk monitoring</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-chat-dots text-success fs-1 mb-3"></i>
                            <h6 class="fw-bold mb-2">Konsultasi Dokter</h6>
                            <p class="small text-muted mb-0">Tunggu feedback dari dokter melalui sistem</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-3 h-100 hover-lift">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-graph-up text-warning fs-1 mb-3"></i>
                            <h6 class="fw-bold mb-2">Pantau Progress</h6>
                            <p class="small text-muted mb-0">Lihat perkembangan kesehatan Anda dari waktu ke waktu</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Result Card Animation */
    .result-card {
        animation: slideInUp 0.6s ease;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Icon Circle Animation */
    .result-icon {
        animation: scaleIn 0.5s ease 0.3s both;
    }

    .icon-circle {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        animation: pulse 2s ease-in-out infinite;
    }

    .icon-circle i {
        font-size: 3.5rem;
        color: white;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
        }

        50% {
            transform: scale(1.05);
            box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
        }
    }

    /* Score Circle */
    .score-circle {
        width: 220px;
        height: 220px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        animation: scoreReveal 0.8s ease 0.5s both;
    }

    @keyframes scoreReveal {
        from {
            transform: scale(0) rotate(180deg);
            opacity: 0;
        }

        to {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
    }

    /* Custom Badges */
    .badge-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .badge-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    /* Alert Modern */
    .alert-modern {
        border-radius: 16px;
        animation: fadeIn 0.6s ease 0.7s both;
    }

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

    /* Recommendations */
    .recommendations-section {
        animation: fadeIn 0.6s ease 0.9s both;
    }

    .recommendation-card {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.25rem;
        transition: all 0.3s ease;
    }

    .recommendation-card:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    }

    .recommendation-number {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
    }

    /* Info Box Animation */
    .info-box {
        animation: fadeIn 0.6s ease 1.1s both;
    }

    .info-icon {
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    /* Hover Lift Effect */
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15) !important;
    }

    /* Confetti Animation */
    .confetti-container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        overflow: hidden;
    }

    /* Button Animations */
    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-primary:hover {
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4) !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .icon-circle {
            width: 90px;
            height: 90px;
        }

        .icon-circle i {
            font-size: 2.5rem;
        }

        .score-circle {
            width: 180px;
            height: 180px;
        }

        .display-1 {
            font-size: 4rem;
        }

        .recommendation-card:hover {
            transform: translateX(0);
        }
    }

    /* Action Buttons Animation */
    .action-buttons {
        animation: fadeIn 0.6s ease 1.3s both;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Create confetti effect for success
        const kategori = '<?= $data['hasil']['kategori']; ?>';

        if (kategori === 'Risiko Rendah') {
            createConfetti();
        }

        function createConfetti() {
            const container = document.querySelector('.confetti-container');
            if (!container) return;

            const colors = ['#ffd700', '#ff6b6b', '#4ecdc4', '#45b7d1', '#f9ca24'];

            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.width = '10px';
                confetti.style.height = '10px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = '-10px';
                confetti.style.opacity = '0';
                confetti.style.transform = 'rotate(' + Math.random() * 360 + 'deg)';
                confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                confetti.style.animation = `confettiFall ${2 + Math.random() * 3}s ease-out ${Math.random() * 2}s`;

                container.appendChild(confetti);

                setTimeout(() => confetti.remove(), 5000);
            }
        }

        // Add CSS animation dynamically
        const style = document.createElement('style');
        style.textContent = `
        @keyframes confettiFall {
            0% {
                top: -10px;
                opacity: 1;
            }
            100% {
                top: 100%;
                opacity: 0;
                transform: translateX(${Math.random() * 200 - 100}px) rotate(${Math.random() * 720}deg);
            }
        }
    `;
        document.head.appendChild(style);
    });
</script>