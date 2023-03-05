<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		check_already_login();
		$this->load->view('login');
	}

	public function process()
	{	
		$post = $this->input->post(null, TRUE);
		if(isset($post['login'])){
			$this->load->model('pengguna_m');
			$query = $this->pengguna_m->login($post);
			if($query->num_rows() > 0){
				$row = $query->row();
				$params = array(
					'userid' => $row->id_pengguna,
					'level' => $row->level
				);
				$this->session->set_userdata($params);
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('kesalahan', 'Nama pengguna / kata sandi salah');
				redirect('auth/login');
			}
		}
	}

	public function logout()
	{
		$params = array('userid', 'level');
		$this->session->unset_userdata($params);
		redirect('auth/login');
	}
}
