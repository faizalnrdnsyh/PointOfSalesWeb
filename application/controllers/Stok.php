<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

	function __construct(){
		parent::__construct();
		check_not_login();
		$this->load->model(['stok_m', 'barang_m', 'pemasok_m']);
	}

	public function stok_masuk_data()
	{
		$data['row'] = $this->stok_m->get_stok_masuk()->result();
		$this->template->load('template', 'transaksi/stok_masuk/stok_masuk_data', $data);
	}

	public function stok_masuk_tambah()
	{
		$barang = $this->barang_m->get()->result();
		$pemasok = $this->pemasok_m->get()->result();
		$restok = $this->barang_m->get_stok_masuk()->result();
		$data = [
			'barang' => $barang,
			'pemasok' => $pemasok,
			'restok' => $restok,
		];
		$this->template->load('template', 'transaksi/stok_masuk/stok_masuk_form', $data);
	}


	public function stok_masuk_hapus()
	{	
		$id_stok = $this->uri->segment(4);
		$id_barang = $this->uri->segment(5);
		$qty = $this->stok_m->get_stok_masuk($id_stok)->row()->qty;
		$stok = $this->barang_m->get($id_barang)->row()->stok;
		if($qty > $stok){
			$this->session->set_flashdata('peringatan', 'Data masih digunakan');
		} else {

		$data = ['qty' => $qty,'id_barang' => $id_barang];

		$this->barang_m->kurang_stok($data);

		$this->stok_m->hapus($id_stok);

		 if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
            } 
        }
            redirect('stok/masuk');
	}

	public function stok_keluar_data()
	{
		$data['row'] = $this->stok_m->get_stok_keluar()->result();
		$this->template->load('template', 'transaksi/stok_keluar/stok_keluar_data', $data);
	}

	public function stok_keluar_tambah()
	{
		$barang = $this->barang_m->get_stok_keluar()->result();
		$data = ['barang' => $barang];
		$this->template->load('template', 'transaksi/stok_keluar/stok_keluar_form', $data);
	}

	public function stok_keluar_hapus()
	{	
		$id_stok = $this->uri->segment(4);
		$id_barang = $this->uri->segment(5);
		$qty = $this->stok_m->get_stok_keluar($id_stok)->row()->qty;
		$data = ['qty' => $qty,'id_barang' => $id_barang];

		$this->barang_m->tambah_stok($data);

		$this->stok_m->hapus($id_stok);

		 if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
            } 
            redirect('stok/keluar');
	}

	public function	proses()
	{
		if(isset($_POST['tambah_masuk'])){
			$post = $this->input->post(null, TRUE);
			$this->stok_m->tambah_stok_masuk($post);
			$this->barang_m->tambah_stok($post);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
			}
			redirect('stok/masuk');
		} elseif (isset($_POST['tambah_keluar'])){
			$post = $this->input->post(null, TRUE);
			$stok = $this->input->post('stok');
			$qty =  $this->input->post('qty');
			if($qty > $stok){
				$this->session->set_flashdata('peringatan', 'Qty melebihi stok tersedia');
	            redirect('stok/keluar/tambah');
	        } else {
				$this->stok_m->tambah_stok_keluar($post);
				$this->barang_m->kurang_stok($post);
				if($this->db->affected_rows() > 0){
					$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
				}
				redirect('stok/keluar');
			}
		}
	}

}