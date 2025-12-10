<?php
class Admin extends Controller
{
    public function __construct()
    {
        // Cek Login & Cek Role Admin
        if (!isset($_SESSION['user_session']) || $_SESSION['user_session']['role'] != 'admin') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Dashboard Admin';

        // Ambil Statistik Angka
        $data['stats'] = $this->model('Screening_model')->getDashboardStats();

        // Ambil 5 Data Terbaru
        $data['terbaru'] = $this->model('Screening_model')->getLatestScreenings();

        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function pasien()
    {
        $data['judul'] = 'Data Hasil Skrining';
        $data['screenings'] = $this->model('Screening_model')->getAllScreenings();

        $this->view('templates/header', $data);
        $this->view('admin/pasien', $data);
        $this->view('templates/footer');
    }

    public function beri_feedback($id_screening)
    {
        $data['judul'] = 'Lembar Konsultasi Dokter';

        // 1. Ambil Data Pasien & Hasil
        $data['detail'] = $this->model('Screening_model')->getScreeningById($id_screening);

        // 2. Decode Jawaban JSON menjadi Array PHP
        // Hasilnya misal: [0, 2, 1, 0 ...]
        $data['jawaban_pasien'] = json_decode($data['detail']['detail_jawaban'], true);

        // 3. Kita butuh Daftar Pertanyaan (Copy dari Pasien Controller agar bisa ditampilkan labelnya)
        // Idealnya ini ditaruh di satu file config terpisah, tapi agar mudah kita taruh sini dulu.
        $data['list_pertanyaan'] = [
            'A. Gejala Utama' => [
                'Sensasi terbakar di dada (heartburn)',
                'Asam lambung naik ke tenggorokan',
                'Gejala muncul setelah makan besar',
                'Gejala memburuk saat berbaring',
                'Nyeri dada non-fisik',
                'Rasa pahit/asam di mulut',
                'Gejala muncul malam hari',
                'Gejala > 2-3x seminggu'
            ],
            'B. Gejala Tambahan' => [
                'Batuk kering tak jelas',
                'Suara serak',
                'Radang tenggorokan',
                'Dada penuh/kembung',
                'Cepat kenyang',
                'Sendawa berlebihan',
                'Mual/muntah'
            ],
            'C. Faktor Risiko' => [
                'Riwayat maag',
                'Diagnosis GERD sebelumnya',
                'Keluarga riwayat lambung',
                'Stres berlebihan',
                'Obesitas (IMT > 25)',
                'Asma/Alergi',
                'Tidur setelah makan'
            ],
            'D. Pola Makan' => [
                'Makan pedas',
                'Berlemak/Gorengan',
                'Kopi/Soda/Kafein',
                'Makan larut malam',
                'Makan porsi besar'
            ],
            'E. Kebiasaan' => [
                'Merokok',
                'Jarang olahraga',
                'Pakaian ketat'
            ]
        ];

        $this->view('templates/header', $data);
        $this->view('admin/feedback', $data);
        $this->view('templates/footer');
    }

    public function prosesFeedback()
    {
        if ($this->model('Screening_model')->updateFeedback($_POST) > 0) {
            Flasher::setFlash('berhasil', 'dikirim ke pasien', 'success');
            header('Location: ' . BASEURL . '/admin/pasien');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dikirim', 'danger');
            header('Location: ' . BASEURL . '/admin/pasien');
            exit;
        }
    }

    public function export()
    {
        $dataPasien = $this->model('Screening_model')->getDataExport();
        $filename = "Laporan_Lengkap_GERD_" . date('Ymd_His') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');

        // 1. SIAPKAN HEADER KOLOM UTAMA
        $header = [
            'No',
            'Nama Pasien',
            'NIK',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Alamat',
            'No HP',
            'Pekerjaan',
            'Tanggal Skrining',
            'Skor Total',
            'Kategori Risiko',
            'Diagnosa',
            'Saran Dokter',
            'Tgl Validasi'
        ];

        // 2. TAMBAHKAN HEADER UNTUK 30 PERTANYAAN (Q1 - Q30)
        // Agar Excel tidak kepanjangan, kita pakai kode Q1, Q2 dst.
        for ($i = 1; $i <= 30; $i++) {
            $header[] = "Q$i (0-2)";
        }

        fputcsv($output, $header);

        // 3. ISI DATA
        $no = 1;
        foreach ($dataPasien as $row) {

            // Decode JSON jawaban menjadi Array
            // Contoh: [2, 0, 1, 2, ...]
            $jawaban_array = json_decode($row['detail_jawaban'], true);

            // Siapkan data dasar
            $baris_csv = [
                $no++,
                $row['nama_lengkap'],
                "'" . $row['nik'],
                ($row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'),
                $row['tgl_lahir'],
                $row['alamat'],
                "'" . $row['no_hp'],
                $row['pekerjaan'],
                $row['tanggal_skrining'],
                $row['total_skor'],
                $row['kategori_risiko'],
                $row['diagnosa'] ?? '-',
                $row['feedback_admin'] ?? 'Belum ada feedback',
                $row['tanggal_feedback'] ?? '-'
            ];

            // 4. GABUNGKAN DATA DASAR DENGAN 30 JAWABAN
            if (is_array($jawaban_array)) {
                foreach ($jawaban_array as $jawab) {
                    // Opsional: Jika ingin angka saja (0,1,2) gunakan $jawab
                    // Jika ingin teks, gunakan logika if dibawah:
                    $teks = $jawab;
                    if ($jawab == 0) $teks = "0 (Tidak)";
                    if ($jawab == 1) $teks = "1 (Kadang)";
                    if ($jawab == 2) $teks = "2 (Sering)";

                    $baris_csv[] = $teks;
                }
            } else {
                // Jika data jawaban rusak/kosong, isi strip sampai 30 kali
                for ($k = 0; $k < 30; $k++) $baris_csv[] = '-';
            }

            fputcsv($output, $baris_csv);
        }

        fclose($output);
        exit;
    }
}
