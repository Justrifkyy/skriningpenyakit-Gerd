<?php
class Screening_model
{
    private $table = 'screenings';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function tambahHasilSkrining($data)
    {
        $query = "INSERT INTO screenings 
                    (user_id, total_skor, kategori_risiko, detail_jawaban) 
                  VALUES 
                    (:user_id, :total_skor, :kategori_risiko, :detail_jawaban)";

        $this->db->query($query);
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('total_skor', $data['total_skor']);
        $this->db->bind('kategori_risiko', $data['kategori_risiko']);
        $this->db->bind('detail_jawaban', $data['detail_jawaban']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getRiwayatByUser($user_id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_id=:user_id ORDER BY tanggal_skrining DESC');
        $this->db->bind('user_id', $user_id);
        return $this->db->resultSet();
    }

    // [BARU] Ambil semua data skrining + Nama Pasien (JOIN tabel users)
    public function getAllScreenings()
    {
        $query = "SELECT screenings.*, users.nama_lengkap, users.email 
                  FROM screenings 
                  JOIN users ON screenings.user_id = users.id 
                  ORDER BY screenings.tanggal_skrining DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // [BARU] Ambil 1 data spesifik berdasarkan ID skrining
    public function getScreeningById($id)
    {
        // Tambahkan users.alamat di select
        $query = "SELECT screenings.*, 
                         users.nama_lengkap, 
                         users.nik, 
                         users.tgl_lahir, 
                         users.jenis_kelamin,
                         users.alamat  -- <--- TAMBAHKAN INI
                  FROM screenings 
                  JOIN users ON screenings.user_id = users.id 
                  WHERE screenings.id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // [BARU] Simpan feedback dari admin
    // Update Feedback, Diagnosa, dan Waktu Feedback
    public function updateFeedback($data)
    {
        // Pastikan ada baris 'tanggal_feedback = NOW()' di bawah ini
        $query = "UPDATE screenings SET 
                feedback_admin = :feedback,
                diagnosa = :diagnosa,
                tanggal_feedback = NOW() 
              WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('feedback', $data['feedback']);
        $this->db->bind('diagnosa', $data['diagnosa']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataExport()
    {
        $query = "SELECT 
                    users.nama_lengkap, 
                    users.nik, 
                    users.jenis_kelamin, 
                    users.tgl_lahir, 
                    users.alamat, 
                    users.no_hp, 
                    users.pekerjaan,
                    screenings.tanggal_skrining, 
                    screenings.total_skor, 
                    screenings.kategori_risiko, 
                    screenings.diagnosa, 
                    screenings.feedback_admin,
                    screenings.tanggal_feedback,
                    screenings.detail_jawaban 
                  FROM screenings 
                  JOIN users ON screenings.user_id = users.id 
                  ORDER BY screenings.tanggal_skrining DESC";

        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getDashboardStats()
    {
        // Query menggunakan COUNT dan CASE WHEN untuk menghitung kategori sekaligus
        $query = "SELECT 
                    COUNT(*) as total_pasien,
                    SUM(CASE WHEN kategori_risiko = 'Risiko Tinggi' THEN 1 ELSE 0 END) as total_tinggi,
                    SUM(CASE WHEN kategori_risiko = 'Risiko Sedang' THEN 1 ELSE 0 END) as total_sedang,
                    SUM(CASE WHEN kategori_risiko = 'Risiko Rendah' THEN 1 ELSE 0 END) as total_rendah,
                    SUM(CASE WHEN feedback_admin IS NULL THEN 1 ELSE 0 END) as belum_feedback,
                    SUM(CASE WHEN feedback_admin IS NOT NULL THEN 1 ELSE 0 END) as sudah_feedback
                  FROM screenings";

        $this->db->query($query);
        return $this->db->single();
    }

    // Ambil 5 data terbaru untuk tabel mini di dashboard
    public function getLatestScreenings($limit = 5)
    {
        $query = "SELECT screenings.*, users.nama_lengkap 
                  FROM screenings 
                  JOIN users ON screenings.user_id = users.id 
                  ORDER BY screenings.tanggal_skrining DESC 
                  LIMIT :limit";
        $this->db->query($query);
        $this->db->bind('limit', $limit);
        return $this->db->resultSet();
    }
}
