<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->from('pelanggan');
		if($id != null){
			$this->db->where('id_pelanggan', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambah($post)
	{
		$params = [
			'nama' => $post['nama'],
			'jenkel' => $post['jenkel'],
			'no_telp' => $post['telp'],
			'alamat' => $post['alamat'],
		];
		$this->db->insert('pelanggan',$params);
	}

	public function ubah($post)
	{
		$params = [
			'nama' => $post['nama'],
			'jenkel' => $post['jenkel'],
			'no_telp' => $post['telp'],
			'alamat' => $post['alamat'],
			'diubah' => date('Y-m-d H:i:s')
		];
		$this->db->where('id_pelanggan', $post['id']);
		$this->db->update('pelanggan',$params);
	}


	public function hapus($id)
	{
		$this->db->where('id_pelanggan', $id);
		$this->db->delete('pelanggan');
	}
}