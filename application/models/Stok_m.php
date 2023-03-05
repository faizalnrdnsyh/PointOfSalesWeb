<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_m extends CI_Model {

	public function get_stok_masuk($id = null)
	{
		$this->db->select('t_stok.*, pemasok.*, p_barang.* , pemasok.nama as nama_pemasok, p_barang.nama as nama_barang ');
		$this->db->from('t_stok');
		$this->db->join('p_barang', 't_stok.id_barang = p_barang.id_barang');
		$this->db->join('pemasok', 't_stok.id_pemasok = pemasok.id_pemasok', 'left');
		$this->db->where('tipe', 'masuk');
		$this->db->order_by('tanggal', 'desc');
		if($id != null){
			$this->db->where('id_stok', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambah_stok_masuk($post)
	{
		$params = [
			'id_barang' => $post['id_barang'],
			'tipe' => 'masuk',
			'keterangan' => $post['keterangan'],
			'id_pemasok' => $post['pemasok'] == '' ? null : $post['pemasok'],
			'qty' => $post['qty'],
			'tanggal' => $post['tanggal'],
			'id_pengguna' => $this->session->userdata('userid')
		];
		$this->db->insert('t_stok',$params);
	}

	public function get_stok_keluar($id = null)
	{
		$this->db->select('t_stok.*, p_barang.*, p_barang.nama as nama_barang ');
		$this->db->from('t_stok');
		$this->db->join('p_barang', 't_stok.id_barang = p_barang.id_barang');
		$this->db->where('tipe', 'keluar');
		$this->db->order_by('tanggal', 'desc');
		if($id != null){
			$this->db->where('id_stok', $id);

		}
		$query = $this->db->get();
		return $query;
	}


	public function tambah_stok_keluar($post)
	{
		$params = [
			'id_barang' => $post['id_barang'],
			'tipe' => 'keluar',
			'keterangan' => $post['keterangan'],
			'qty' => $post['qty'],
			'tanggal' => $post['tanggal'],
			'id_pengguna' => $this->session->userdata('userid')
		];
		$this->db->insert('t_stok',$params);
	}

	public function hapus($id)
	{
		$this->db->where('id_stok', $id);
		$this->db->delete('t_stok');
	}

	public function get_stok_laporan($limit = null, $start = null)
	{
		$post = $this->session->userdata('search');
		$this->db->select('t_stok.*, pemasok.*, p_barang.* , pemasok.nama as nama_pemasok, p_barang.nama as nama_barang, pengguna.nama as pengguna, t_stok.dibuat as stok_dibuat ');
		$this->db->from('t_stok');
		$this->db->join('p_barang', 't_stok.id_barang = p_barang.id_barang');
		$this->db->join('pemasok', 't_stok.id_pemasok = pemasok.id_pemasok', 'left');
		$this->db->join('pengguna', 't_stok.id_pengguna = pengguna.id_pengguna', 'left');
		if(!empty($post['tanggal1']) && !empty($post['tanggal2'])){
			$this->db->where("t_stok.tanggal BETWEEN '".$post['tanggal1']."' AND '".$post['tanggal2']."'");
		}
		if(!empty($post['pemasok'])){
			if($post['pemasok'] == 'null') {
				$this->db->where("t_stok.id_pemasok IS NULL");
			} else {
				$this->db->where("t_stok.id_pemasok", $post['pemasok']);
			}
		}
		if(!empty($post['mutasi'])){
			if($post['mutasi'] == 'masuk') {
				$this->db->where("t_stok.tipe = 'masuk'");
			} else {
				$this->db->where("t_stok.tipe = 'keluar'");
			}
		}
		$this->db->order_by('stok_dibuat', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query;
	}
}	
