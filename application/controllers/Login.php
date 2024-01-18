<?php

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_login', 'ml');
    }

    function index()
    {
        $data['title'] = 'Login | Material Request';
        if ($this->session->userdata('role') == 'Warehouse') {
            redirect('Warehouse/index');
        } elseif ($this->session->userdata('role') == 'Production') {
            redirect('Production/index');
        } else {
            $this->load->view('templates/header_w', $data);
            $this->load->view('v_login');
        }
    }

    function aksi_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek = $this->ml->cek_users($username, $password);

        if ($cek->num_rows() == 1) {
            foreach ($cek->result() as $data) {
                $users = array(
                    'id_user' => $data->id_user,
                    'username' => $data->username,
                    'nama' => $data->nama,
                    'role' => $data->role
                );

                $this->session->set_userdata($users);

                if ($this->session->userdata('role') == 'Warehouse') {
                    $this->session->set_flashdata('success', 'Login Successfully !');
                    redirect('Warehouse/index');
                } elseif ($this->session->userdata('role') == 'Production') {
                    $this->session->set_flashdata('success', 'Login Successfully !');
                    redirect('Production/index');
                } else {
                    $this->session->set_flashdata('error', 'Incorrect Username / Password');
                    redirect(base_url());
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Incorrect Username / Password');
            redirect(base_url());
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success1', 'Logout Successfully !');
        redirect(base_url());
    }
}
