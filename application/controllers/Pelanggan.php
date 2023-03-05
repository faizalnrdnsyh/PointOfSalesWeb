<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	function __construct(){
		parent::__construct();
		check_not_login();
		$this->load->model('pelanggan_m');
	}

	public function index()
	{	
		$data['row'] = $this->pelanggan_m->get();
		$this->template->load('template', 'pelanggan/pelanggan_data', $data);
	}

	public function tambah()
	{	
		$pelanggan = new stdClass();
		$pelanggan->id_pelanggan = null;
		$pelanggan->nama = null;
		$pelanggan->jenkel = null;
		$pelanggan->no_telp = null;
		$pelanggan->alamat = null;
		$data = array(
			'page'=> 'tambah',
			'row'=> $pelanggan
		);
		$this->template->load('template', 'pelanggan/pelanggan_form', $data);
	}

	public function ubah($id)
	{
		$query = $this->pelanggan_m->get($id);
		if($query->num_rows() > 0) {
			$pelanggan = $query->row();
			$data = array(
			'page'=> 'ubah',
			'row'=> $pelanggan
			);
			$this->template->load('template', 'pelanggan/pelanggan_form', $data);
		} else {
			$this->session->set_flashdata('kesalahan', 'Data tidak ditemukan');
			redirect('pelanggan');
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			$this->pelanggan_m->tambah($post);
		} elseif (isset($_POST['ubah'])){
			$this->pelanggan_m->ubah($post);
		}
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
		}
		redirect('pelanggan');
	}

	public function hapus($id)
	{
		$this->pelanggan_m->hapus($id);
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		}
		redirect('pelanggan');
	}
}
