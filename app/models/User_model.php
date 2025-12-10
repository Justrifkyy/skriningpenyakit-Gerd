<?php
class User_model
{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function tambahDataUser($data)
    {
        $query = "INSERT INTO users 
                    (nama_lengkap, email, password, role, nik, tgl_lahir, jenis_kelamin, alamat, no_hp, status_pernikahan, pekerjaan) 
                  VALUES 
                    (:nama, :email, :pass, 'pasien', :nik, :tgl_lahir, :jk, :alamat, :no_hp, :status, :pekerjaan)";

        $this->db->query($query);

        // Binding data
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('pass', password_hash($data['password'], PASSWORD_DEFAULT)); // Enkripsi password
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('tgl_lahir', $data['tgl_lahir']);
        $this->db->bind('jk', $data['jenis_kelamin']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_hp', $data['no_hp']);
        $this->db->bind('status', $data['status_pernikahan']);
        $this->db->bind('pekerjaan', $data['pekerjaan']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email=:email');
        $this->db->bind('email', $email);
        return $this->db->single();
    }
}
