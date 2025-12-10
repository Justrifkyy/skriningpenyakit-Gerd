<?php
// 1. Panggil Konfigurasi Database
require_once '../app/config/config.php';

// Helper function untuk generate NIK random
function generateRandomNIK()
{
    return '7371' . rand(100000, 999999) . rand(100000, 999999);
}

try {
    // 2. Koneksi Manual ke Database
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h3>🚀 Memulai Proses Seeding Otomatis...</h3>";

    // 3. Reset Database
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("TRUNCATE TABLE screenings");
    $pdo->exec("TRUNCATE TABLE users");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    echo "✅ Tabel berhasil dikoosongkan.<br>";

    // ==========================================
    // DATA 1: MEMBUAT AKUN ADMIN
    // ==========================================
    $passAdmin = password_hash('admin123', PASSWORD_DEFAULT);
    $sqlAdmin = "INSERT INTO users (email, password, role, nama_lengkap, nik, tgl_lahir, jenis_kelamin, alamat, no_hp, status_pernikahan, pekerjaan) 
                 VALUES (:email, :pass, 'admin', 'Administrator Utama', '0000000000000000', '1990-01-01', 'L', 'Kantor Pusat', '08120000000', '-', 'Admin Sistem')";
    $stmt = $pdo->prepare($sqlAdmin);
    $stmt->execute(['email' => 'admin@gerd.com', 'pass' => $passAdmin]);
    echo "✅ Akun ADMIN berhasil dibuat (admin@gerd.com / admin123)<br><hr>";

    // ==========================================
    // DATA 2: LOOPING 12 PASIEN DUMMY + SKRINING RANDOM
    // ==========================================

    // Data dummy untuk variasi nama
    $firstNames = ['Adi', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fajar', 'Gita', 'Hadi', 'Indah', 'Joko', 'Kiki', 'Lina'];
    $lastNames  = ['Santoso', 'Pratama', 'Wijaya', 'Lestari', 'Saputra', 'Kusuma', 'Putri', 'Hidayat', 'Ramadhan', 'Nugraha', 'Sari', 'Wibowo'];
    $pekerjaanList = ['PNS', 'Wiraswasta', 'Mahasiswa', 'Guru', 'Karyawan Swasta', 'Ibu Rumah Tangga', 'Petani', 'Freelancer'];
    $alamatList = ['Makassar', 'Gowa', 'Maros', 'Takalar', 'Jeneponto', 'Parepare', 'Bone', 'Palopo'];

    $sqlUser = "INSERT INTO users (email, password, role, nama_lengkap, nik, tgl_lahir, jenis_kelamin, alamat, no_hp, status_pernikahan, pekerjaan) 
                VALUES (:email, :pass, 'pasien', :nama, :nik, :tgl, :jk, :alamat, :hp, :status, :pekerjaan)";
    $stmtUser = $pdo->prepare($sqlUser);

    $sqlScreening = "INSERT INTO screenings (user_id, total_skor, kategori_risiko, diagnosa, detail_jawaban, feedback_admin, tanggal_feedback, tanggal_skrining) 
                     VALUES (:uid, :skor, :risiko, :diagnosa, :detail, :feedback, :tgl_feedback, :tgl)";
    $stmtScreening = $pdo->prepare($sqlScreening);

    $passUser = password_hash('123456', PASSWORD_DEFAULT);

    // Loop 12 kali
    for ($i = 0; $i < 12; $i++) {

        // --- A. Generate Data User ---
        $nama = $firstNames[$i] . ' ' . $lastNames[rand(0, 11)];
        $email = strtolower($firstNames[$i]) . rand(1, 99) . '@gmail.com';
        $jk = ($i % 2 == 0) ? 'L' : 'P'; // Selang seling cowok cewek

        $stmtUser->execute([
            'email' => $email,
            'pass' => $passUser,
            'nama' => $nama,
            'nik' => generateRandomNIK(),
            'tgl' => rand(1970, 2005) . '-' . rand(1, 12) . '-' . rand(1, 28),
            'jk' => $jk,
            'alamat' => 'Jl. Contoh No. ' . rand(1, 100) . ', ' . $alamatList[array_rand($alamatList)],
            'hp' => '08' . rand(1000000000, 9999999999),
            'status' => (rand(0, 1) ? 'Menikah' : 'Belum Menikah'),
            'pekerjaan' => $pekerjaanList[array_rand($pekerjaanList)]
        ]);

        $userId = $pdo->lastInsertId();

        // --- B. Generate Hasil Skrining Random ---

        // 1. Generate 30 jawaban acak (0, 1, atau 2)
        $jawaban_array = [];
        $total_skor = 0;
        for ($j = 0; $j < 30; $j++) {
            // Kita buat random weighted (lebih sering muncul 0 atau 1 biar skornya variatif, sesekali 2)
            $rand = rand(0, 10);
            $val = 0;
            if ($rand > 3 && $rand <= 7) $val = 1;
            if ($rand > 7) $val = 2;

            $jawaban_array[] = $val;
            $total_skor += $val;
        }

        // 2. Tentukan Risiko
        $risiko = 'Risiko Rendah';
        $diagnosa = 'Normal / Sehat';
        if ($total_skor >= 16) {
            $risiko = 'Risiko Sedang';
            $diagnosa = 'Gejala Ringan (Dispepsia)';
        }
        if ($total_skor >= 31) {
            $risiko = 'Risiko Tinggi';
            $diagnosa = 'GERD Positif (Perlu Obat)';
        }

        // 3. Tentukan Feedback (Random: Ada yang sudah dibalas admin, ada yang belum)
        $is_feedback = rand(0, 1); // 0 = Belum, 1 = Sudah
        $feedback = null;
        $tgl_feedback = null;

        if ($is_feedback) {
            $tgl_feedback = date('Y-m-d H:i:s', strtotime('-' . rand(0, 5) . ' days')); // Feedback beberapa hari lalu

            if ($risiko == 'Risiko Tinggi') {
                $feedback = "Skor Anda cukup tinggi ($total_skor). Segera konsultasi ke poli dalam. Resep: Omeprazole 2x1.";
            } elseif ($risiko == 'Risiko Sedang') {
                $feedback = "Perbaiki pola makan. Hindari pedas dan kopi. Minum antasida jika perlu.";
            } else {
                $feedback = "Kondisi aman. Pertahankan gaya hidup sehat.";
            }
        }

        // Tanggal skrining acak dalam 1 bulan terakhir
        $tgl_skrining = date('Y-m-d H:i:s', strtotime('-' . rand(0, 30) . ' days'));

        $stmtScreening->execute([
            'uid' => $userId,
            'skor' => $total_skor,
            'risiko' => $risiko,
            'diagnosa' => ($is_feedback ? $diagnosa : null), // Jika belum feedback, diagnosa null
            'detail' => json_encode($jawaban_array),
            'feedback' => $feedback,
            'tgl_feedback' => $tgl_feedback,
            'tgl' => $tgl_skrining
        ]);

        echo "👤 User dibuat: <b>$nama</b> | Skor: $total_skor ($risiko) | Status: " . ($is_feedback ? '✅ Selesai' : '⏳ Menunggu') . "<br>";
    }

    echo "<hr><h3>🎉 SEEDING 12 PASIEN SELESAI!</h3>";
    echo "<a href='http://localhost/project-gerd/public/auth' style='padding:10px 20px; background:blue; color:white; text-decoration:none; border-radius:5px;'>Login Sekarang</a>";
} catch (PDOException $e) {
    echo "❌ Gagal: " . $e->getMessage();
}
