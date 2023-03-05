<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

	function __construct(){
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model('satuan_m');
	}

	public function index()
	{	
		$data['row'] = $this->satuan_m->get();
		$this->template->load('template', 'produk/satuan/satuan_data', $data);
	}

	public function tambah()
	{	
		$satuan = new stdClass();
		$satuan->id_satuan = null;
		$satuan->nama = null;
		$data = array(
			'page'=> 'tambah',
			'row'=> $satuan
		);
		$this->template->load('template', 'produk/satuan/satuan_form', $data);
	}

	public function ubah($id)
	{
		$query = $this->satuan_m->get($id);
		if($query->num_rows() > 0) {
			$satuan = $query->row();
			$data = array(
			'page'=> 'ubah',
			'row'=> $satuan
			);
			$this->template->load('template', 'produk/satuan/satuan_form', $data);
		} else {
			$this->session->set_flashdata('kesalahan', 'Data tidak ditemukan');
			redirect('satuan');
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->satuan_m->tambah($post);
		} elseif (isset($_POST['ubah'])){
			$this->satuan_m->ubah($post);
		}
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
		}
		redirect('satuan');
	}

	public function hapus($id)
	{
		$this->satuan_m->hapus($id);
		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('peringatan', 'Data masih digunakan, tidak dapat dihapus');
		} elseif($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		} 
		redirect('satuan');
	}
}
