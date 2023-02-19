<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_admin'))) {
            $this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_admin = $this->db->get('tb_admin')->row();

        $this->load->model('M_user', 'user');
        $this->load->model('M_admin', 'admin');
    }

    public function index()
    {
        $data = [
            'title'         => 'Dashboard Admin',
            'page'          => 'admin/dashboard',
        ];

        $this->load->view('index', $data);
    }

    public function listUser()
    {
        $data = [
            'title'         => 'List User',
            'page'          => 'admin/list_user',
            'user'          => $this->admin->getAllUser()
        ];

        $this->load->view('index', $data);
    }

    public function addUser()
    {
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {

            $config['upload_path']      = 'uploads/profiles';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $config['max_size']         = 3000;
            $config['remove_spaces']    = TRUE;
            $config['encrypt_name']     = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('toastr-eror', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else {
                $upload_data = $this->upload->data();
                $data = [
                    'image'     => $upload_data['file_name'],
                    'name'      => htmlspecialchars($this->input->post('name', true)),
                    'username'  => htmlspecialchars($this->input->post('username', true)),
                    'password'  => password_hash('user123', PASSWORD_BCRYPT)
                ];

                $insert = $this->db->insert('tb_user', $data);
                if ($insert) {
                    $this->session->set_flashdata('toastr-sukses', 'success added user !');
                    redirect('list-user', 'refresh');
                } else {
                    $this->session->set_flashdata('toastr-eror', 'failed added user !');
                    redirect('list-user', 'refresh');
                }
            }
        } else {
            $data = [
                'name'      => htmlspecialchars($this->input->post('name', true)),
                'username'  => htmlspecialchars($this->input->post('username', true)),
                'password'  => password_hash('user123', PASSWORD_BCRYPT)
            ];

            $this->db->insert('tb_user', $data);
            $this->session->set_flashdata('toastr-sukses', 'Success added user');
            redirect('list-user');
        }
    }

    public function deleteUser($id)
    {
        if ($id) {
            $this->db->where('id', $id);
            $data = $this->db->get('tb_user')->row();

            $this->db->where('id', $id);
            $delete = $this->db->delete('tb_user');

            if ($delete) {
                if ($data->image != 'default.png') {
                    unlink(FCPATH . 'uploads/profiles/' . $data->image);
                }

                $this->session->set_flashdata('toastr-sukses', 'Data berhasil di hapus');
            } else {
                $this->session->set_flashdata('toastr-eror', 'Data gagal di hapus!!');
            }
        }

        redirect('list-user', 'refresh');
    }

    public function resetPwd($id)
    {
        $data = [
            'password'      => password_hash('user123', PASSWORD_BCRYPT)
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_user', $data);
        $this->session->set_flashdata('toastr-sukses', 'Password reset successfuly!');
        redirect('list-user');
    }
}

/* End of file User.php */
