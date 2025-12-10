<?php
class Pasien extends Controller
{
    public function __construct()
    {
        // Cek apakah user sudah login dan role-nya pasien
        if (!isset($_SESSION['user_session']) || $_SESSION['user_session']['role'] != 'pasien') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Dashboard Pasien';
        $data['user'] = $_SESSION['user_session'];

        // Ambil riwayat skrining user ini
        $data['riwayat'] = $this->model('Screening_model')->getRiwayatByUser($_SESSION['user_session']['id']);

        $this->view('templates/header', $data);
        $this->view('pasien/index', $data);
        $this->view('templates/footer');
    }

    public function formulir()
    {
        $data['judul'] = 'Isi Skrining GERD';
        $data['user'] = $_SESSION['user_session'];

        // Data Pertanyaan (Sesuai request awal)
        $data['pertanyaan'] = [
            'A. Gejala Utama' => [
                'Apakah Anda sering merasakan sensasi terbakar di dada (heartburn)?',
                'Apakah Anda merasakan asam lambung naik ke tenggorokan (regurgitasi)?',
                'Apakah gejala muncul setelah makan besar atau makanan tertentu?',
                'Apakah gejala memburuk saat Anda berbaring?',
                'Apakah Anda pernah merasakan nyeri dada yang tidak berkaitan dengan aktivitas fisik?',
                'Apakah Anda merasakan rasa pahit atau asam di mulut?',
                'Apakah gejala muncul saat malam hari?',
                'Apakah gejala muncul lebih dari 2–3 kali per minggu?'
            ],
            'B. Gejala Tambahan' => [
                'Apakah Anda sering mengalami batuk kering yang tidak jelas penyebabnya?',
                'Apakah Anda sering mengalami suara serak?',
                'Apakah Anda sering mengalami radang tenggorokan berulang?',
                'Apakah Anda merasakan dada terasa penuh/kembung?',
                'Apakah Anda sering merasa cepat kenyang?',
                'Apakah Anda sering bersendawa berlebihan?',
                'Apakah Anda pernah merasa mual atau ingin muntah tanpa sebab jelas?'
            ],
            'C. Faktor Risiko & Riwayat Medis' => [
                'Apakah Anda memiliki riwayat maag atau gastritis?',
                'Apakah Anda pernah didiagnosis GERD oleh dokter?',
                'Apakah keluarga Anda ada yang memiliki riwayat masalah lambung atau GERD?',
                'Apakah Anda sering mengalami stres berlebihan?',
                'Apakah Anda mengalami kelebihan berat badan (IMT ≥ 25)?',
                'Apakah Anda memiliki riwayat penyakit asma atau alergi pernapasan?',
                'Apakah Anda memiliki kebiasaan tidur setelah makan?'
            ],
            'D. Pola Makan & Minuman' => [
                'Apakah Anda sering makan makanan pedas?',
                'Apakah Anda sering makan makanan berlemak atau digoreng?',
                'Apakah Anda sering minum kopi, teh pekat, soda, atau minuman berkafein lainnya?',
                'Apakah Anda sering makan larut malam (setelah jam 21.00)?',
                'Apakah Anda sering makan dalam porsi besar?'
            ],
            'E. Kebiasaan & Gaya Hidup' => [
                'Apakah Anda merokok?',
                'Apakah Anda jarang berolahraga?',
                'Apakah Anda sering menggunakan pakaian sangat ketat (yang menekan perut)?'
            ]
        ];

        $this->view('templates/header', $data);
        $this->view('pasien/formulir', $data);
        $this->view('templates/footer');
    }

    public function prosesSkrining()
    {
        // 1. Ambil data jawaban dari form
        $jawaban = $_POST['jawaban']; // Ini berupa array [0=>2, 1=>1, dst...]

        // 2. Hitung Total Skor
        $total_skor = array_sum($jawaban);

        // 3. Tentukan Kategori Risiko
        // Interpretasi: 0–15 (Rendah), 16–30 (Sedang), ≥ 31 (Tinggi)
        if ($total_skor >= 31) {
            $kategori = 'Risiko Tinggi';
        } elseif ($total_skor >= 16) {
            $kategori = 'Risiko Sedang';
        } else {
            $kategori = 'Risiko Rendah';
        }

        // 4. Siapkan data untuk disimpan
        $data_simpan = [
            'user_id' => $_SESSION['user_session']['id'],
            'total_skor' => $total_skor,
            'kategori_risiko' => $kategori,
            'detail_jawaban' => json_encode($jawaban) // Simpan detail jawaban sebagai JSON
        ];

        // 5. Kirim ke Model
        if ($this->model('Screening_model')->tambahHasilSkrining($data_simpan) > 0) {
            // Set session flash untuk sukses (opsional)
            Flasher::setFlash('berhasil', 'disimpan', 'success');

            // Redirect ke halaman hasil (bawa skor lewat session sementara atau URL)
            // Agar aman, kita simpan di session sementara untuk ditampilkan di halaman hasil
            $_SESSION['hasil_terbaru'] = [
                'skor' => $total_skor,
                'kategori' => $kategori
            ];

            header('Location: ' . BASEURL . '/pasien/hasil');
            exit;
        } else {
            Flasher::setFlash('gagal', 'menyimpan data', 'danger');
            header('Location: ' . BASEURL . '/pasien');
            exit;
        }
    }

    public function hasil()
    {
        // Cek apakah ada data hasil terbaru
        if (!isset($_SESSION['hasil_terbaru'])) {
            header('Location: ' . BASEURL . '/pasien');
            exit;
        }

        $data['judul'] = 'Hasil Skrining';
        $data['hasil'] = $_SESSION['hasil_terbaru'];

        $this->view('templates/header', $data);
        $this->view('pasien/hasil', $data);
        $this->view('templates/footer');

        // Hapus session hasil terbaru agar tidak muncul terus saat di-refresh
        unset($_SESSION['hasil_terbaru']);
    }

    // Method untuk Tampilan Web (Enak dibaca di layar)
    public function detail($id_screening)
    {
        $data['judul'] = 'Detail Hasil';
        $data['user'] = $_SESSION['user_session'];

        // Ambil data + Alamat
        $screening = $this->model('Screening_model')->getScreeningById($id_screening);

        // Validasi Keamanan
        if (!$screening || $screening['user_id'] != $data['user']['id']) {
            Flasher::setFlash('gagal', 'akses ditolak', 'danger');
            header('Location: ' . BASEURL . '/pasien');
            exit;
        }

        $data['detail'] = $screening;

        // Load View WEB (Pakai Header & Footer)
        $this->view('templates/header', $data);
        $this->view('pasien/detail', $data);
        $this->view('templates/footer');
    }

    // Method Khusus Cetak (Tampilan A4 Surat)
    public function cetak($id_screening)
    {
        $data['judul'] = 'Cetak Laporan';
        $data['user'] = $_SESSION['user_session'];

        $screening = $this->model('Screening_model')->getScreeningById($id_screening);

        if (!$screening || $screening['user_id'] != $data['user']['id']) {
            header('Location: ' . BASEURL . '/pasien');
            exit;
        }

        $data['detail'] = $screening;

        // Load View CETAK (Tanpa Header & Footer)
        $this->view('pasien/cetak', $data);
    }

}
