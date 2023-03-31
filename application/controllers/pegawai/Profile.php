<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_pegawai'))) {
            $this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_pegawai = $this->db->get('pegawai')->row();

        $this->load->model('M_pegawai', 'pegawai');
    }

    public function index()
    {
        $data = [
            'title'   => 'Profile Pegawai',
            'navbar'  => 'pegawai/navbar',
            'page'    => 'pegawai/profile',
        ];

        $this->load->view('index', $data);
    }

    public function updateOldProfile()
    {

        if ($this->input->post('password')) {

            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[confpwd]');
            $this->form_validation->set_rules('confpwd', 'Confirm Password', 'trim|required|matches[password]');


            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('toastr-eror', 'Gagal update profile');
                redirect('pegawai/profile', 'refresh');
            } else {

                $img = $_FILES['image']['name'];

                if ($img) {
                    $config['upload_path']      = 'uploads/profiles';
                    $config['allowed_types']    = 'jpg|jpeg|png';
                    $config['max_size']         = 2000;
                    $config['remove_spaces']    = TRUE;
                    $config['encrypt_name']     = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $this->session->set_flashdata('toastr-eror', $this->upload->display_errors());
                        redirect('pegawai/profile');
                    } else {
                        $upload_data = $this->upload->data();
                        $previmage = $this->input->post('previmage');

                        $data = [
                            'nama'      => $this->dt_pegawai->nama,
                            'nip'       => $this->dt_pegawai->nip,
                            'email'     => $this->dt_pegawai->email,
                            'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                            'image'     => $upload_data['file_name']
                        ];

                        $this->db->where('id', $this->dt_pegawai->id);
                        $update = $this->db->update('pegawai', $data);

                        if ($update) {
                            if ($previmage != 'default.png') {
                                unlink(FCPATH . 'uploads/profiles/' . $previmage);
                            }
                            $this->session->set_flashdata('toastr-sukses', 'success !');
                            redirect('pegawai/profile');
                        } else {
                            $this->session->set_flashdata('toastr-eror', 'failed!');
                            redirect('pegawai/profile');
                        }
                    }
                } else {
                    $data = [
                        'nama'      => $this->dt_pegawai->nama,
                        'nip'       => $this->dt_pegawai->nip,
                        'email'     => $this->dt_pegawai->email,
                        'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    ];

                    $this->db->where('id', $this->dt_pegawai->id);
                    $update = $this->db->update('pegawai', $data);

                    if ($update) {
                        $this->session->set_flashdata('toastr-sukses', 'success !');
                        redirect('pegawai/profile');
                    } else {
                        $this->session->set_flashdata('toastr-eror', 'failed!');
                        redirect('pegawai/profile');
                    }
                }
            }
        } else {
            $img = $_FILES['image']['name'];

            if ($img) {
                $config['upload_path']      = 'uploads/profiles';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['max_size']         = 2000;
                $config['remove_spaces']    = TRUE;
                $config['encrypt_name']     = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('toastr-eror', $this->upload->display_errors());
                    redirect('pegawai/profile');
                } else {
                    $upload_data = $this->upload->data();
                    $previmage = $this->input->post('previmage');

                    $data = [
                        'nama'      => $this->dt_pegawai->nama,
                        'nip'       => $this->dt_pegawai->nip,
                        'email'     => $this->dt_pegawai->email,
                        'image'     => $upload_data['file_name']
                    ];

                    $this->db->where('id', $this->dt_pegawai->id);
                    $update = $this->db->update('pegawai', $data);

                    if ($update) {
                        if ($previmage != 'default.png') {
                            unlink(FCPATH . 'uploads/profiles/' . $previmage);
                        }
                        $this->session->set_flashdata('toastr-sukses', 'success !');
                        redirect('pegawai/profile');
                    } else {
                        $this->session->set_flashdata('toastr-eror', 'failed!');
                        redirect('pegawai/profile');
                    }
                }
            } else {
                $data = [
                    'nama'      => $this->dt_pegawai->nama,
                    'nip'       => $this->dt_pegawai->nip,
                    'email'     => $this->dt_pegawai->email,
                ];

                $this->db->where('id', $this->dt_pegawai->id);
                $update = $this->db->update('pegawai', $data);

                if ($update) {
                    $this->session->set_flashdata('toastr-sukses', 'success !');
                    redirect('pegawai/profile');
                } else {
                    $this->session->set_flashdata('toastr-eror', 'failed!');
                    redirect('pegawai/profile');
                }
            }
        }
    }

    public function updateNewProfile()
    {
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[confpwd]');
            $this->form_validation->set_rules('confpwd', 'Confirm Password', 'trim|required|matches[password]');


            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('toastr-eror', 'Gagal update profile');
                redirect('pegawai/profile', 'refresh');
            } else {

                $currentPwd = $this->input->post('curpwd');

                if (password_verify($currentPwd, $this->dt_pegawai->password)) {

                    $img = $_FILES['image']['name'];

                    if ($img) {
                        $config['upload_path']      = 'uploads/profiles';
                        $config['allowed_types']    = 'jpg|jpeg|png';
                        $config['max_size']         = 2000;
                        $config['remove_spaces']    = TRUE;
                        $config['encrypt_name']     = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);

                        if (!$this->upload->do_upload('image')) {
                            $this->session->set_flashdata('toastr-eror', $this->upload->display_errors());
                            redirect('pegawai/profile');
                        } else {
                            $upload_data = $this->upload->data();
                            $previmage = $this->input->post('previmage');

                            $data = [
                                'nama'      => $this->dt_pegawai->nama,
                                'nip'       => $this->dt_pegawai->nip,
                                'email'     => $this->dt_pegawai->email,
                                'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                                'image'     => $upload_data['file_name']
                            ];

                            $this->db->where('id', $this->dt_pegawai->id);
                            $update = $this->db->update('pegawai', $data);

                            if ($update) {
                                if ($previmage != 'default.png') {
                                    unlink(FCPATH . 'uploads/profiles/' . $previmage);
                                }
                                $this->session->set_flashdata('toastr-sukses', 'success !');
                                redirect('pegawai/profile');
                            } else {
                                $this->session->set_flashdata('toastr-eror', 'failed!');
                                redirect('pegawai/profile');
                            }
                        }
                    } else {
                        $data = [
                            'nama'      => $this->dt_pegawai->nama,
                            'nip'       => $this->dt_pegawai->nip,
                            'email'     => $this->dt_pegawai->email,
                            'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                        ];

                        $this->db->where('id', $this->dt_pegawai->id);
                        $update = $this->db->update('pegawai', $data);

                        if ($update) {
                            $this->session->set_flashdata('toastr-sukses', 'success !');
                            redirect('pegawai/profile');
                        } else {
                            $this->session->set_flashdata('toastr-eror', 'failed!');
                            redirect('pegawai/profile');
                        }
                    }
                } else {
                    $this->session->set_flashdata('toastr-eror', 'failed! Current password salah!');
                    redirect('pegawai/profile');
                }
            }
        } else {
            $img = $_FILES['image']['name'];

            if ($img) {
                $config['upload_path']      = 'uploads/profiles';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['max_size']         = 2000;
                $config['remove_spaces']    = TRUE;
                $config['encrypt_name']     = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('toastr-eror', $this->upload->display_errors());
                    redirect('pegawai/profile');
                } else {
                    $upload_data = $this->upload->data();
                    $previmage = $this->input->post('previmage');

                    $data = [
                        'nama'      => $this->dt_pegawai->nama,
                        'nip'       => $this->dt_pegawai->nip,
                        'email'     => $this->dt_pegawai->email,
                        'image'     => $upload_data['file_name']
                    ];

                    $this->db->where('id', $this->dt_pegawai->id);
                    $update = $this->db->update('pegawai', $data);

                    if ($update) {
                        if ($previmage != 'default.png') {
                            unlink(FCPATH . 'uploads/profiles/' . $previmage);
                        }
                        $this->session->set_flashdata('toastr-sukses', 'success !');
                        redirect('pegawai/profile');
                    } else {
                        $this->session->set_flashdata('toastr-eror', 'failed!');
                        redirect('pegawai/profile');
                    }
                }
            } else {
                $data = [
                    'nama'      => $this->dt_pegawai->nama,
                    'nip'       => $this->dt_pegawai->nip,
                    'email'     => $this->dt_pegawai->email,
                ];

                $this->db->where('id', $this->dt_pegawai->id);
                $update = $this->db->update('pegawai', $data);

                if ($update) {
                    $this->session->set_flashdata('toastr-sukses', 'success !');
                    redirect('pegawai/profile');
                } else {
                    $this->session->set_flashdata('toastr-eror', 'failed!');
                    redirect('pegawai/profile');
                }
            }
        }
    }

    public function a()
    {
        echo password_hash('user', PASSWORD_BCRYPT);
    }
}

/* End of file Home.php */
