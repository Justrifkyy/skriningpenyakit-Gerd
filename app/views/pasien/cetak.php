<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Medis - <?= $data['detail']['nama_lengkap']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <style>
        /* RESET CSS AGAR FULL PAGE */
        body,
        html {
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
            font-family: 'Times New Roman', Times, serif;
            /* Font resmi surat */
        }

        /* TAMPILAN KERTAS A4 */
        .page-a4 {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 20px auto;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        /* HEADER / KOP SURAT */
        .kop-surat {
            border-bottom: 4px double #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-klinik {
            font-size: 40px;
            font-weight: bold;
            color: #0d6efd;
            border: 2px solid #0d6efd;
            padding: 5px 15px;
            border-radius: 10px;
        }

        /* TABEL IDENTITAS */
        .table-identitas td {
            padding: 4px 0;
            font-size: 14px;
        }

        /* KOTAK SKOR */
        .box-result {
            border: 2px solid #000;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        /* FONT TANDA TANGAN */
        .signature {
            font-family: 'Great Vibes', cursive;
            font-size: 28px;
            color: #000080;
            /* Warna biru pulpen */
            margin-top: 10px;
            margin-bottom: 5px;
        }

        /* SETTINGAN KHUSUS PRINT (CTRL+P) */
        @media print {
            @page {
                size: A4;
                margin: 0;
                /* Hilangkan margin browser */
            }

            body {
                background: white;
            }

            .page-a4 {
                width: 100%;
                margin: 0;
                box-shadow: none;
                padding: 15mm 20mm;
                /* Margin kertas saat print */
            }

            .no-print {
                display: none !important;
            }

            /* Hilangkan header/footer bawaan browser (URL/Jam) */
            body::before,
            body::after {
                content: none !important;
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="page-a4">

        <div class="kop-surat">
            <div class="logo-klinik">GERD+</div>
            <div class="text-center flex-grow-1 px-3">
                <h4 class="mb-0 fw-bold text-uppercase">Klinik Sehat Lambung</h4>
                <p class="mb-0 small">Jl. Perintis Kemerdekaan KM. 10, Makassar, Sulawesi Selatan</p>
                <p class="mb-0 small">Izin Dinkes: 445/123/Yankes/2025 | Email: report@gerdcare.id</p>
            </div>
            <div class="text-end">
                <small class="text-muted d-block">Ref ID:</small>
                <strong>#<?= str_pad($data['detail']['id'], 6, '0', STR_PAD_LEFT); ?></strong>
            </div>
        </div>

        <h5 class="text-center fw-bold text-decoration-underline mb-4">HASIL SKRINING KESEHATAN</h5>

        <table class="table-identitas w-100 mb-4">
            <tr>
                <td width="20%"><strong>Nama Pasien</strong></td>
                <td width="2%">:</td>
                <td width="40%"><?= strtoupper($data['detail']['nama_lengkap']); ?></td>

                <td width="20%"><strong>Tanggal Periksa</strong></td>
                <td width="2%">:</td>
                <td><?= date('d-m-Y', strtotime($data['detail']['tanggal_skrining'])); ?></td>
            </tr>
            <tr>
                <td><strong>NIK</strong></td>
                <td>:</td>
                <td><?= $data['detail']['nik']; ?></td>

                <td><strong>Usia</strong></td>
                <td>:</td>
                <td><?= date_diff(date_create($data['detail']['tgl_lahir']), date_create('today'))->y; ?> Tahun</td>
            </tr>
            <tr>
                <td><strong>Alamat</strong></td>
                <td>:</td>
                <td colspan="4"><?= $data['detail']['alamat']; ?></td>
            </tr>
        </table>

        <div class="row g-3 mb-4">
            <div class="col-6">
                <div class="box-result bg-light">
                    <small class="text-uppercase fw-bold text-muted">Total Skor</small>
                    <h2 class="fw-bold mb-0 display-5"><?= $data['detail']['total_skor']; ?></h2>
                    <small>dari maks. 60</small>
                </div>
            </div>
            <div class="col-6">
                <?php
                $color = ($data['detail']['kategori_risiko'] == 'Risiko Tinggi') ? '#dc3545' : (($data['detail']['kategori_risiko'] == 'Risiko Sedang') ? '#ffc107' : '#198754');
                $bg_style = "background-color: $color; color: white;";
                if ($data['detail']['kategori_risiko'] == 'Risiko Sedang') $bg_style = "background-color: $color; color: black;";
                ?>
                <div class="box-result" style="<?= $bg_style; ?> border-color: <?= $color; ?>;">
                    <small class="text-uppercase fw-bold opacity-75">Kategori Risiko</small>
                    <h3 class="fw-bold mb-0 mt-1"><?= strtoupper($data['detail']['kategori_risiko']); ?></h3>
                    <small>Indikasi Klinis</small>
                </div>
            </div>
        </div>

        <div class="mb-4" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
            <p class="mb-1 fw-bold text-decoration-underline">KESIMPULAN DOKTER</p>
            <p class="fw-bold text-primary mb-3">Diagnosa: <?= $data['detail']['diagnosa'] ?? '-'; ?></p>

            <p class="mb-1 fw-bold text-decoration-underline">SARAN & RESEP</p>
            <div style="min-height: 100px; font-style: italic;">
                <?= nl2br($data['detail']['feedback_admin'] ?? 'Belum ada catatan.'); ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-8">
                <small class="text-muted" style="font-size: 11px;">
                    * Dokumen ini diterbitkan secara elektronik oleh Sistem GERD Care.<br>
                    * Tidak memerlukan tanda tangan basah untuk keperluan skrining awal.<br>
                    * Dicetak pada: <?= date('d F Y H:i'); ?> WITA
                </small>
            </div>
            <div class="col-4 text-center">
                <p class="mb-0 small">Makassar, <?= ($data['detail']['tanggal_feedback']) ? date('d F Y', strtotime($data['detail']['tanggal_feedback'])) : date('d F Y'); ?></p>
                <p class="fw-bold mb-0 small">Dokter Penanggung Jawab,</p>

                <div class="signature">dr. Administrator, Sp.PD</div>

                <p class="fw-bold mb-0" style="border-top: 1px solid black; display: inline-block; padding-top: 2px;">dr. Administrator, Sp.PD</p>
                <br><small>SIP. 445/Dinkes/2025</small>
            </div>
        </div>

    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>