<?php
class Auth extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('auth/login');
        $this->view('templates/footer');
    }

    public function login()
    {
        if ($this->model('User_model')->getUserByEmail($_POST['email'])) {
            $user = $this->model('User_model')->getUserByEmail($_POST['email']);

            // Cek Password
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['user_session'] = $user;

                // Cek Role untuk Redirect
                if ($user['role'] == 'admin') {
                    header('Location: ' . BASEURL . '/admin');
                } else {
                    header('Location: ' . BASEURL . '/pasien');
                }
                exit;
            } else {
                Flasher::setFlash('gagal', 'login (password salah)', 'danger');
                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        } else {
            Flasher::setFlash('gagal', 'login (email tidak ditemukan)', 'danger');
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function register()
    {
        $data['judul'] = 'Register';
        $this->view('templates/header', $data);
        $this->view('auth/register');
        $this->view('templates/footer');
    }

    public function prosesRegister()
    {
        if ($this->model('User_model')->tambahDataUser($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/auth');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}
