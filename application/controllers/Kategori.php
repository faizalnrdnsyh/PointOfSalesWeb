<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	function __construct(){
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('kategori_m');
	}

	public function index()
	{	
		$data['row'] = $this->kategori_m->get();
		$this->template->load('template', 'produk/kategori/kategori_data', $data);
	}

	public function tambah()
	{	
		$kategori = new stdClass();
		$kategori->id_kategori = null;
		$kategori->nama = null;
		$data = array(
			'page'=> 'tambah',
			'row'=> $kategori
		);
		$this->template->load('template', 'produk/kategori/kategori_form', $data);
	}

	public function ubah($id)
	{
		$query = $this->kategori_m->get($id);
		if($query->num_rows() > 0) {
			$kategori = $query->row();
			$data = array(
			'page'=> 'ubah',
			'row'=> $kategori
			);
			$this->template->load('template', 'produk/kategori/kategori_form', $data);
		} else {
			$this->session->set_flashdata('kesalahan', 'Data tidak ditemukan');
			redirect('kategori');
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->kategori_m->tambah($post);
		} elseif (isset($_POST['ubah'])){
			$this->kategori_m->ubah($post);
		}
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
		}
		redirect('kategori');
	}

	public function hapus($id)
	{
		$this->kategori_m->hapus($id);
		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('peringatan', 'Data masih digunakan, tidak dapat dihapus');
		} elseif($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		} 
		redirect('kategori');
	}
}
