<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	function __construct(){
		parent::__construct();
		check_not_login();
		$this->load->model(['penjualan_m', 'pelanggan_m', 'barang_m']);
	}

	public function index()
	{	
		$data = array(
			'pelanggan' => $this->pelanggan_m->get()->result(),
			'barang' => $this->barang_m->get()->result(),
			'keranjang' => $this->penjualan_m->get_keranjang(),
			'invoice' => $this->penjualan_m->no_invoice(),
		);
		$this->template->load('template', 'transaksi/penjualan/penjualan_form', $data);
	}

	function get_barang(){
		$barcode = $this->input->post('barcode');
		$barang = $this->barang_m->get_barcode($barcode)->row();
		
		if($this->db->affected_rows() > 0){
			$params = array('success' => true, 'barang' => $barang);
		} else {
			$params = array('success' => false);
		}
		echo json_encode($params);
	}

	public function proses()
	{
		$data = $this->input->post(null, TRUE);

		if(isset($_POST['tambah_keranjang'])){

			$id_barang = $this->input->post('id_barang');
			$cek_barang = $this->penjualan_m->get_keranjang(['t_keranjang.id_barang' => $id_barang]);
			if($cek_barang->num_rows() > 0){
				$this->penjualan_m->ubah_qty($data);
			} else {
				$this->penjualan_m->tambah_keranjang($data);
			}
			if($this->db->affected_rows() > 0){
				$params = array('success' => true);
			} else {
				$params = array('success' => false);
			}
			echo json_encode($params);
		}

		if(isset($_POST['simpan_ubah_keranjang'])){

			$this->penjualan_m->simpan_ubah_keranjang($data);
			if($this->db->affected_rows() > 0){
				$params = array('success' => true);
			} else {
				$params = array('success' => false);
			}
			echo json_encode($params);
		}

		if(isset($_POST['proses_pembayaran'])){

			$id_penjualan = $this->penjualan_m->tambah_penjualan($data);
			$keranjang = $this->penjualan_m->get_keranjang()->result();
			$row = [];
			foreach ($keranjang as $k => $value) {
				array_push($row, array(
					'id_penjualan' => $id_penjualan,
					'id_barang' => $value->id_barang,
					'harga' => $value->harga,
					'qty' => $value->qty,
					'diskon' => $value->diskon,
					'total' => $value->total,
					)
				);
			}
			$this->penjualan_m->tambah_penjualan_detail($row);
			$this->penjualan_m->hapus_keranjang(['id_pengguna' => $this->session->userdata('userid')]);

			if($this->db->affected_rows() > 0){
				$params = array('success' => true, 'id_penjualan' => $id_penjualan);
			} else {
				$params = array('success' => false);
			}
			echo json_encode($params);
		}

	}

	function keranjang_data()
	{
		$keranjang = $this->penjualan_m->get_keranjang();
		$data['keranjang'] = $keranjang;
		$this->load->view('transaksi/penjualan/keranjang_data', $data);
	}

	public function hapus_keranjang()
	{
		if(isset($_POST['batal_transaksi'])){
			$this->penjualan_m->hapus_keranjang(['id_pengguna' => $this->session->userdata('userid')]);
		} else {
			$id_keranjang = $this->input->post('id_keranjang');
			$this->penjualan_m->hapus_keranjang(['id_keranjang' => $id_keranjang]);
		}
		
		if($this->db->affected_rows() > 0){
			$params = array('success' => true);
		} else {
			$params = array('success' => false);
		}
		echo json_encode($params);
	}

	public function cetak($id){
		$data = array(
			'penjualan' => $this->penjualan_m->get_penjualan($id)->row(),
			'penjualan_detail' => $this->penjualan_m->get_penjualan_detail($id)->result(),
		);
		$this->load->view('transaksi/penjualan/faktur_print', $data);
	}

	public function hapus($id)
	{
		$this->penjualan_m->hapus_penjualan($id);
		if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
			redirect('laporan/penjualan');
		} else {
			$this->session->set_flashdata('kesalahan', 'Data gagal dihapus');
			redirect('laporan/penjualan');
		}
	}
}