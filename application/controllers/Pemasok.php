<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasok extends CI_Controller {

	function __construct(){
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('pemasok_m');
	}

	public function index()
	{	
		$data['row'] = $this->pemasok_m->get();
		$this->template->load('template', 'pemasok/pemasok_data', $data);
	}

	public function tambah()
	{	
		$pemasok = new stdClass();
		$pemasok->id_pemasok = null;
		$pemasok->nama = null;
		$pemasok->no_telp = null;
		$pemasok->alamat = null;
		$pemasok->deskripsi = null;
		$data = array(
			'page'=> 'tambah',
			'row'=> $pemasok
		);
		$this->template->load('template', 'pemasok/pemasok_form', $data);
	}

	public function ubah($id)
	{
		$query = $this->pemasok_m->get($id);
		if($query->num_rows() > 0) {
			$pemasok = $query->row();
			$data = array(
			'page'=> 'ubah',
			'row'=> $pemasok
			);
			$this->template->load('template', 'pemasok/pemasok_form', $data);
		} else {
			$this->session->set_flashdata('kesalahan', 'Data tidak ditemukan');
			redirect('pemasok');
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->pemasok_m->tambah($post);
		} elseif (isset($_POST['ubah'])){
			$this->pemasok_m->ubah($post);
		}
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
		}
		redirect('pemasok');
	}

	public function hapus($id)
	{
		$this->pemasok_m->hapus($id);
		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('peringatan', 'Data masih digunakan, tidak dapat dihapus');
		} elseif($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		} 
		redirect('pemasok');
	}
}
