<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_user'))) {
            $this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_user = $this->db->get('tb_user')->row();

        $this->load->model('M_user', 'user');
    }

    public function index()
    {
        $data = [
            'title'         => 'Dashboard User',
            'page'          => 'user/dashboard',
        ];

        $this->load->view('index', $data);
    }

    public function berkas()
    {
        $data = [
            'title'         => 'Berkas',
            'page'          => 'user/berkas',
            'berkas'    => $this->user->getBerkas($this->dt_user->id)
        ];

        $this->load->view('index', $data);
    }

    public function uploadBerkas()
    {
        if (!$this->session->userdata('log_user')) {
            $this->session->set_flashdata('toastr-eror', 'Silahkan login terlebih dahulu !');

            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

        $cek = $this->user->getBerkas($this->dt_user->id);

        if (!$cek) {
            $this->db->insert('tb_berkas', [
                'berkas_id' => $this->dt_user->id
            ]);
        }

        $laporan = $_FILES['laporan']['name'];

        if ($laporan) {

            $config['upload_path'] = 'uploads/berkas/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']  = 3000;
            $config['remove_spaces']  = TRUE;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('laporan')) {
                $this->session->set_flashdata('laporan', $this->upload->display_errors());
            } else {
                $upload_data = $this->upload->data();

                $data = [
                    'laporan'    => $upload_data['file_name']
                ];

                $this->db->where('berkas_id', $this->dt_user->id);
                $update = $this->db->update('tb_berkas', $data);

                if ($update) {
                    if ($cek->laporan != null) {
                        unlink(FCPATH . 'uploads/berkas/' . $cek->laporan);
                    }

                    $this->session->set_flashdata('laporan', 'laporan berhasil diupload');
                } else {
                    $this->session->set_flashdata('laporan', 'laporan gagal diupload');
                }
            }
        }
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    public function userProfile()
    {
        $data = [
            'title'         => 'Profile',
            'page'          => 'user/profile',
        ];

        $this->load->view('index', $data);
    }

    public function update_profile()
    {
        $old = $this->input->post('current_pass');
        $hash = $this->dt_user->password;

        $image = $_FILES['image']['name'];

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('retype_again', 'Retype Password', 'trim|required|matches[password]');


        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->session->set_flashdata('toastr-eror', 'Isi Semua Form');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        } else {
            # code...
            if (password_verify($old, $hash)) {

                if ($image) {

                    $config['upload_path']   = 'uploads/profiles';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = 3000;
                    $config['remove_spaces'] = TRUE;
                    $config['encrypt_name']  = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $this->session->set_flashdata('toastr-eror', $this->upload->display_errors());
                        redirect('user/profile', 'refresh');
                    } else {
                        $upload_data = $this->upload->data();
                        $data = [
                            'username'  => htmlspecialchars($this->input->post('username', true)),
                            'name'      => htmlspecialchars($this->input->post('name', true)),
                            'image'     => $upload_data['file_name'],
                            'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
                        ];

                        $this->db->where('id', $this->dt_user->id);
                        $update = $this->db->update('tb_user', $data);

                        if ($update) {
                            if ($this->dt_user->image != null && $this->dt_user->image != 'default.png') {
                                unlink(FCPATH . 'uploads/profiles/' . $this->dt_user->image);
                            }
                            $this->session->set_flashdata('toastr-sukses', 'Profile updated');
                        } else {
                            $this->session->set_flashdata('toastr-eror', 'Failed Profile updated');
                        }
                    }
                } else {
                    $data = [
                        'username'  => htmlspecialchars($this->input->post('username', true)),
                        'name'      => htmlspecialchars($this->input->post('name', true)),
                        'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
                    ];

                    $this->db->where('id', $this->dt_user->id);
                    $update = $this->db->update('tb_user', $data);
                    if ($update) {
                        $this->session->set_flashdata('toastr-sukses', 'Profile Updated');
                    } else {
                        $this->session->set_flashdata('toastr-eror', 'Profile updated failed');
                    }
                }
            } else if (password_verify($this->dt_user->username, $this->dt_user->password)) {
                if ($image) {

                    $config['upload_path']   = 'uploads/profiles';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size']      = 3000;
                    $config['remove_spaces'] = TRUE;
                    $config['encrypt_name']  = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $this->session->set_flashdata('toastr-eror', $this->upload->display_errors());
                        redirect('user/profile', 'refresh');
                    } else {
                        $upload_data = $this->upload->data();
                        $data = [
                            'username'  => htmlspecialchars($this->input->post('username', true)),
                            'name'      => htmlspecialchars($this->input->post('name', true)),
                            'image'     => $upload_data['file_name'],
                            'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
                        ];

                        $this->db->where('id', $this->dt_user->id);
                        $update = $this->db->update('tb_user', $data);

                        if ($update) {
                            if ($this->dt_user->image != null && $this->dt_user->image != 'default.png') {
                                unlink(FCPATH . 'uploads/profiles/' . $this->dt_user->image);
                            }
                            $this->session->set_flashdata('toastr-sukses', 'Profile updated');
                        } else {
                            $this->session->set_flashdata('toastr-eror', 'Failed Profile updated');
                        }
                    }
                } else {
                    $data = [
                        'username'  => htmlspecialchars($this->input->post('username', true)),
                        'name'      => htmlspecialchars($this->input->post('name', true)),
                        'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
                    ];

                    $this->db->where('id', $this->dt_user->id);
                    $update = $this->db->update('tb_user', $data);
                    if ($update) {
                        $this->session->set_flashdata('toastr-sukses', 'Profile Updated');
                    } else {
                        $this->session->set_flashdata('toastr-eror', 'Profile updated failed');
                    }
                }
            } else {
                $this->session->set_flashdata('toastr-eror', 'Current profile salah');
            }
        }
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
}

/* End of file User.php */
