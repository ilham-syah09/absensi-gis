<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('log_admin'))) {
            if ($this->uri->segment(2) != 'logout') {
                $this->session->set_flashdata('notif-error', 'Anda sudah login !');
                redirect('admin');
            }
        } else if (!empty($this->session->userdata('log_user'))) {
            if ($this->uri->segment(2) != 'logout') {
                $this->session->set_flashdata('notif-error', 'Anda sudah login !');
                redirect('user');
            }
        }
        $this->load->model('M_login', 'login');
    }

    public function index()
    {

        $data = [
            'title'     => 'Login',
            'page'      => 'auth/login'
        ];

        $this->load->view('auth/index', $data);
    }

    public function proses()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('toastr-eror', validation_errors());
            redirect('auth');
        } else {
            # code...
            $username   = $this->input->post('username');
            $password   = $this->input->post('password');

            $user = $this->login->cek($username, $password);

            if ($user == 'admin') {
                $this->session->set_flashdata('toastr-sukses', 'Login berhasil');
                redirect('admin');
            } else if ($user == 'user') {
                $this->session->set_flashdata('toastr-sukses', 'Login berhasil');
                redirect('user');
            } else {
                $this->session->set_flashdata('toastr-eror', $user);
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy($this->session->userdata('log_admin'));
        redirect('auth', 'refresh');
    }

    public function user()
    {
        $data = password_hash('user123', PASSWORD_BCRYPT);
        echo $data;
    }
}

/* End of file Auth.php */
