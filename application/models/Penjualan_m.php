<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_m extends CI_Model {

	public function no_invoice()
	{
		$sql = "SELECT MAX(MID(invoice,7,4)) AS no_invoice 
				FROM t_penjualan 
				WHERE MID(invoice,1, 6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$n = ((int)$row->no_invoice) + 1;
			$no = sprintf("%'.04d",$n);
		} else {
			$no = "0001";
		}
		date_default_timezone_set('Asia/Jakarta');
		$invoice = date('ymd').$no;
		return $invoice;
	}

	public function get_keranjang($params = null)
	{
		$this->db->select('*, p_barang.nama as nama_barang, t_keranjang.harga as harga_k, t_keranjang.diskon as diskon_barang');
		$this->db->from('t_keranjang');
		$this->db->join('p_barang', 't_keranjang.id_barang = p_barang.id_barang');
		if($params != null){
			$this->db->where($params);
		}
		$this->db->where('id_pengguna', $this->session->userdata('userid'));
		$query = $this->db->get();
		return $query;
	}

	public function tambah_keranjang($post)
	{
		$query = $this->db->query("SELECT MAX(id_keranjang) AS no_keranjang FROM t_keranjang");
		if($query->num_rows() > 0){
			$row = $query->row();
			$no = ((int)$row->no_keranjang) + 1;
		} else {
			$no = "1";
		}
		$params = array(
			'id_keranjang' => $no,
			'id_barang' => $post['id_barang'],
			'harga' => $post['harga'],
			'qty' => $post['qty'],
			'total' => ($post['harga'] * $post['qty']),
			'id_pengguna' => $this->session->userdata('userid')
		);
		$this->db->insert('t_keranjang', $params);
	}

	function ubah_qty($post)
	{
		$sql = "UPDATE t_keranjang SET harga ='$post[harga]',
				qty = qty + '$post[qty]',
				total = '$post[harga]' * qty
				WHERE id_barang = '$post[id_barang]'";
		$this->db->query($sql);
	}

	public function hapus_keranjang($params = null)
	{
		if($params != null){
			$this->db->where($params);
		}
		$this->db->delete('t_keranjang');
	}

	public function simpan_ubah_keranjang($post)
	{
		$params = array (
			'harga' => $post['harga'],
			'qty' => $post['qty'],
			'diskon' => $post['diskon'],
			'total' => $post['total'],
		);
		$this->db->where('id_keranjang', $post['id_keranjang']);
		$this->db->update('t_keranjang', $params);
	}

	public function tambah_penjualan($post)
	{
		$params = array (
			'invoice' => $this->no_invoice(),
			'id_pelanggan' => $post['id_pelanggan'] == "" ? null : $post['id_pelanggan'],
			'total_harga' => $post['subtotal'],
			'diskon' => $post['diskon'],
			'total_akhir' => $post['grandtotal'],
			'bayar' => $post['bayar'],
			'kembali' => $post['kembali'],
			'catatan' => $post['catatan'],
			'tanggal' => $post['tanggal'],
			'id_pengguna' => $this->session->userdata('userid')
		);
		$this->db->insert('t_penjualan', $params);
		return $this->db->insert_id();
	}

	function tambah_penjualan_detail($params)
	{
		$this->db->insert_batch('t_penjualan_detail', $params);
	}

	public function get_penjualan($id = null)
	{
		$this->db->select('*, pelanggan.nama as nama_pelanggan, pengguna.nama as namapengguna, t_penjualan.dibuat as penjualan_dibuat');
		$this->db->from('t_penjualan');
		$this->db->join('pelanggan', 't_penjualan.id_pelanggan = pelanggan.id_pelanggan', 'left');
		$this->db->join('pengguna', 't_penjualan.id_pengguna = pengguna.id_pengguna');
		if($id != null){
			$this->db->where('id_penjualan', $id);
		}
		$this->db->order_by('invoice', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get_penjualan_laporan($limit = null, $start = null)
	{
		$post = $this->session->userdata('search');
		$this->db->select('*, pelanggan.nama as nama_pelanggan, pengguna.nama as namapengguna, t_penjualan.dibuat as penjualan_dibuat');
		$this->db->from('t_penjualan');
		$this->db->join('pelanggan', 't_penjualan.id_pelanggan = pelanggan.id_pelanggan', 'left');
		$this->db->join('pengguna', 't_penjualan.id_pengguna = pengguna.id_pengguna');

		if(!empty($post['tanggal1']) && !empty($post['tanggal2'])){
			$this->db->where("t_penjualan.tanggal BETWEEN '".$post['tanggal1']."' AND '".$post['tanggal2']."'");
		}
		if(!empty($post['pelanggan'])){
			if($post['pelanggan'] == 'null') {
				$this->db->where("t_penjualan.id_pelanggan IS NULL");
			} else {
				$this->db->where("t_penjualan.id_pelanggan", $post['pelanggan']);
			}
		}
		if(!empty($post['invoice'])){
			$this->db->like("invoice", $post['invoice']);
		}

		$this->db->limit($limit, $start);
		$this->db->order_by('penjualan_dibuat', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get_total()
	{
		$post = $this->session->userdata('search');
		$this->db->select('sum(total_harga) as sum_total, sum(diskon) as sum_diskon, sum(total_akhir) as sum_akhir');
		$this->db->from('t_penjualan');
		if(!empty($post['tanggal1']) && !empty($post['tanggal2'])){
			$this->db->where("t_penjualan.tanggal BETWEEN '".$post['tanggal1']."' AND '".$post['tanggal2']."'");
		}
		if(!empty($post['pelanggan'])){
			if($post['pelanggan'] == 'null') {
				$this->db->where("t_penjualan.id_pelanggan IS NULL");
			} else {
				$this->db->where("t_penjualan.id_pelanggan", $post['pelanggan']);
			}
		}
		if(!empty($post['invoice'])){
			$this->db->like("invoice", $post['invoice']);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_penjualan_detail($id_penjualan = null)
	{
		$this->db->from('t_penjualan_detail');
		$this->db->join('p_barang', 't_penjualan_detail.id_barang = p_barang.id_barang');
		if($id_penjualan != null){
			$this->db->where('t_penjualan_detail.id_penjualan', $id_penjualan);
		}
		$query = $this->db->get();
		return $query;
	}

	public function hapus_penjualan($id)
	{
		$this->db->where('id_penjualan', $id);
		$this->db->delete('t_penjualan');
	}
}