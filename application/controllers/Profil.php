<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	function __construct(){
		parent::__construct();
		check_not_login();
		$this->load->model('pengguna_m');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['row'] = $this->pengguna_m->get();
		$this->template->load('template', 'profil', $data);
	}

	public function ubah($id)
	{
		$this->form_validation->set_rules('namalengkap', 'Nama', 'required');
		$this->form_validation->set_rules('namapengguna', 'Nama Pengguna', 'min_length[5]|callback_cek_namapengguna');
		if($this->input->post('katasandi')) {
			$this->form_validation->set_rules('katasandi', 'Kata Sandi', 'min_length[5]');
			$this->form_validation->set_rules('konfsandi', 'Konfirmasi Sandi', 'required|matches[katasandi]',
				array('matches' => '%s tidak sesuai dengan Kata Sandi')
			);
		}
		if($this->input->post('konfsandi')) {
			$this->form_validation->set_rules('konfsandi', 'Konfirmasi Sandi', 'matches[katasandi]',
				array('matches' => '%s tidak sesuai dengan Kata Sandi')
			);
		}
			
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
		$this->form_validation->set_message('is_unique', 'Nama pengguna sudah dipakai');
		$this->form_validation->set_message('min_length', '%s minimal 5 karakter');


		if($this->form_validation->run() == FALSE){
			$idprofil = $this->session->userdata('userid');
			if($id != $idprofil){
				redirect('profil/'.$idprofil);
			} else {
				$query = $this->pengguna_m->get($id);
				if($query->num_rows() > 0){
					$data['row'] = $query->row();
					$this->template->load('template', 'profil', $data);
				} else {
					$this->session->set_flashdata('kesalahan', 'Data tidak ditemukan');
            		redirect('dashboard');
				}
			}
		} else {
			$post = $this->input->post(null, TRUE);
			$this->pengguna_m->ubah($post);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
			}
			redirect('dashboard');
		}
	}

	function cek_namapengguna()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM pengguna WHERE nama_pengguna = '$post[namapengguna]' AND id_pengguna != '$post[id]'");
		if($query->num_rows() > 0){
				$this->form_validation->set_message('cek_namapengguna', '%s ini sudah digunakan');
				return FALSE;
			} else {
				return TRUE;
			}
	}

}