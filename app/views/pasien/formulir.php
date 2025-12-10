<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Progress Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1 small">Progress Pengisian</h6>
                            <h4 class="mb-0 fw-bold text-primary">
                                <span id="answeredCount">0</span>/<span id="totalQuestions">0</span> Pertanyaan
                            </h4>
                        </div>
                        <div class="circular-progress">
                            <svg width="80" height="80">
                                <circle cx="40" cy="40" r="35" stroke="#e9ecef" stroke-width="6" fill="none" />
                                <circle id="progressCircle" cx="40" cy="40" r="35" stroke="#667eea" stroke-width="6" fill="none"
                                    stroke-dasharray="220" stroke-dashoffset="220"
                                    style="transition: stroke-dashoffset 0.3s ease; transform: rotate(-90deg); transform-origin: center;" />
                            </svg>
                            <div class="progress-text">
                                <span id="progressPercent">0</span>%
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-3" style="height: 8px;">
                        <div id="progressBar" class="progress-bar bg-gradient-primary" role="progressbar" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white py-4 border-0">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper me-3">
                            <i class="bi bi-clipboard2-pulse fs-2"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold">Kuesioner Skrining GERD</h4>
                            <p class="mb-0 opacity-90 small">
                                <i class="bi bi-info-circle me-2"></i>
                                Jawablah sejujur-jujurnya berdasarkan kondisi Anda dalam 1 bulan terakhir
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-lg-5">
                    <form id="skriningForm" action="<?= BASEURL; ?>/pasien/prosesSkrining" method="post">
                        <?php
                        $no = 1;
                        $categoryIndex = 0;
                        foreach ($data['pertanyaan'] as $kategori => $items):
                            $categoryIndex++;
                        ?>

                            <!-- Category Header -->
                            <div class="category-section mb-4" data-category="<?= $categoryIndex; ?>">
                                <div class="alert alert-primary border-0 shadow-sm rounded-3 mb-4" role="alert">
                                    <div class="d-flex align-items-center">
                                        <div class="category-icon me-3">
                                            <i class="bi bi-bookmark-check-fill fs-4"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 fw-bold"><?= $kategori; ?></h5>
                                            <small class="opacity-75"><?= count($items); ?> pertanyaan</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Questions -->
                                <?php foreach ($items as $soal): ?>
                                    <div class="question-card mb-4">
                                        <div class="card border-0 shadow-sm rounded-3 hover-lift">
                                            <div class="card-body p-4">
                                                <!-- Question Number & Text -->
                                                <div class="d-flex align-items-start mb-3">
                                                    <span class="question-number me-3">
                                                        <?= $no; ?>
                                                    </span>
                                                    <p class="mb-0 fw-semibold text-dark flex-grow-1">
                                                        <?= $soal; ?>
                                                    </p>
                                                </div>

                                                <!-- Answer Options -->
                                                <div class="answer-options">
                                                    <div class="row g-2">
                                                        <!-- Option 1 -->
                                                        <div class="col-12 col-md-4">
                                                            <input class="form-check-input d-none answer-input"
                                                                type="radio"
                                                                name="jawaban[<?= $no; ?>]"
                                                                id="q<?= $no; ?>_0"
                                                                value="0"
                                                                required>
                                                            <label class="answer-label w-100" for="q<?= $no; ?>_0">
                                                                <div class="answer-content">
                                                                    <i class="bi bi-x-circle answer-icon"></i>
                                                                    <div>
                                                                        <div class="fw-semibold">Tidak Pernah</div>
                                                                        <small class="text-muted">Skor: 0</small>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <!-- Option 2 -->
                                                        <div class="col-12 col-md-4">
                                                            <input class="form-check-input d-none answer-input"
                                                                type="radio"
                                                                name="jawaban[<?= $no; ?>]"
                                                                id="q<?= $no; ?>_1"
                                                                value="1">
                                                            <label class="answer-label w-100" for="q<?= $no; ?>_1">
                                                                <div class="answer-content">
                                                                    <i class="bi bi-dash-circle answer-icon"></i>
                                                                    <div>
                                                                        <div class="fw-semibold">Kadang-kadang</div>
                                                                        <small class="text-muted">Skor: 1</small>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <!-- Option 3 -->
                                                        <div class="col-12 col-md-4">
                                                            <input class="form-check-input d-none answer-input"
                                                                type="radio"
                                                                name="jawaban[<?= $no; ?>]"
                                                                id="q<?= $no; ?>_2"
                                                                value="2">
                                                            <label class="answer-label w-100" for="q<?= $no; ?>_2">
                                                                <div class="answer-content">
                                                                    <i class="bi bi-check-circle answer-icon"></i>
                                                                    <div>
                                                                        <div class="fw-semibold">Sering</div>
                                                                        <small class="text-muted">Skor: 2</small>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </div>

                        <?php endforeach; ?>

                        <!-- Action Buttons -->
                        <div class="action-buttons mt-5 pt-4 border-top">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <a href="<?= BASEURL; ?>/pasien" class="btn btn-outline-secondary btn-lg w-100 rounded-pill">
                                        <i class="bi bi-arrow-left me-2"></i>Batal
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill shadow-lg submit-btn">
                                        <i class="bi bi-send-fill me-2"></i>Kirim & Lihat Hasil
                                    </button>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-shield-check me-1"></i>
                                    Data Anda akan tersimpan dengan aman
                                </small>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Card -->
            <div class="card border-0 shadow-sm rounded-4 mt-4 bg-light">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start">
                        <i class="bi bi-lightbulb-fill text-warning fs-3 me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-2">Tips Pengisian Kuesioner</h6>
                            <ul class="mb-0 small text-muted ps-3">
                                <li>Jawab berdasarkan kondisi yang Anda alami dalam 1 bulan terakhir</li>
                                <li>Pilih jawaban yang paling sesuai dengan frekuensi gejala Anda</li>
                                <li>Pastikan semua pertanyaan telah dijawab sebelum mengirim</li>
                            </ul>
                        </div>
                    </div>
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

    .progress-bar.bg-gradient-primary {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    /* Question Number Badge */
    .question-number {
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        font-weight: bold;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    /* Answer Options Styling */
    .answer-label {
        display: block;
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .answer-label:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    }

    .answer-input:checked+.answer-label {
        border-color: #667eea;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    .answer-content {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .answer-icon {
        font-size: 1.5rem;
        color: #667eea;
    }

    .answer-input:checked+.answer-label .answer-icon {
        animation: checkBounce 0.4s ease;
    }

    @keyframes checkBounce {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }
    }

    /* Card Hover Effect */
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    /* Category Icon */
    .category-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
    }

    /* Submit Button Animation */
    .submit-btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(25, 135, 84, 0.3) !important;
    }

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .submit-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    /* Circular Progress */
    .circular-progress {
        position: relative;
        width: 80px;
        height: 80px;
    }

    .progress-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1rem;
        font-weight: bold;
        color: #667eea;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .question-number {
            min-width: 35px;
            height: 35px;
            font-size: 1rem;
        }

        .answer-label {
            padding: 0.75rem;
        }

        .answer-icon {
            font-size: 1.25rem;
        }

        .circular-progress {
            width: 60px;
            height: 60px;
        }

        .circular-progress svg {
            width: 60px;
            height: 60px;
        }

        .progress-text {
            font-size: 0.875rem;
        }
    }

    /* Category Section Animation */
    .category-section {
        animation: fadeInUp 0.5s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('skriningForm');
        const answerInputs = document.querySelectorAll('.answer-input');
        const progressBar = document.getElementById('progressBar');
        const progressCircle = document.getElementById('progressCircle');
        const progressPercent = document.getElementById('progressPercent');
        const answeredCount = document.getElementById('answeredCount');
        const totalQuestions = document.getElementById('totalQuestions');

        // Count total questions
        const totalQuestionCount = document.querySelectorAll('.question-card').length;
        totalQuestions.textContent = totalQuestionCount;

        // Update progress function
        function updateProgress() {
            const answeredQuestions = new Set();
            answerInputs.forEach(input => {
                if (input.checked) {
                    const questionName = input.name;
                    answeredQuestions.add(questionName);
                }
            });

            const count = answeredQuestions.size;
            const percentage = Math.round((count / totalQuestionCount) * 100);

            // Update displays
            answeredCount.textContent = count;
            progressBar.style.width = percentage + '%';
            progressPercent.textContent = percentage;

            // Update circular progress
            const circumference = 2 * Math.PI * 35; // 35 is the radius
            const offset = circumference - (percentage / 100) * circumference;
            progressCircle.style.strokeDashoffset = offset;

            // Scroll to first unanswered question when clicking submit
            if (percentage < 100) {
                const firstUnanswered = Array.from(document.querySelectorAll('.question-card')).find(card => {
                    const inputs = card.querySelectorAll('.answer-input');
                    return !Array.from(inputs).some(input => input.checked);
                });

                if (firstUnanswered && form.classList.contains('was-validated')) {
                    firstUnanswered.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }
        }

        // Listen to all radio changes
        answerInputs.forEach(input => {
            input.addEventListener('change', updateProgress);
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Add validation class
            form.classList.add('was-validated');

            // Check if form is valid
            if (!form.checkValidity()) {
                updateProgress(); // This will scroll to first unanswered

                // Show alert
                const alert = document.createElement('div');
                alert.className = 'alert alert-warning alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3';
                alert.style.zIndex = '9999';
                alert.innerHTML = `
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Mohon jawab semua pertanyaan sebelum mengirim!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
                document.body.appendChild(alert);

                setTimeout(() => alert.remove(), 5000);
                return;
            }

            // Confirmation dialog
            if (confirm('Apakah Anda yakin semua jawaban sudah benar?\n\nData yang telah dikirim tidak dapat diubah.')) {
                form.submit();
            }
        });

        // Initialize progress
        updateProgress();
    });
</script>