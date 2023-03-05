<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasok_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->from('pemasok');
		if($id != null){
			$this->db->where('id_pemasok', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambah($post)
	{
		$params = [
			'nama' => $post['nama'],
			'no_telp' => $post['telp'],
			'alamat' => $post['alamat'],
			'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi']
		];
		$this->db->insert('pemasok',$params);
	}

	public function ubah($post)
	{
		$params = [
			'nama' => $post['nama'],
			'no_telp' => $post['telp'],
			'alamat' => $post['alamat'],
			'deskripsi' => empty($post['deskripsi']) ? null : $post['deskripsi'],
			'diubah' => date('Y-m-d H:i:s')
		];
		$this->db->where('id_pemasok', $post['id']);
		$this->db->update('pemasok',$params);
	}


	public function hapus($id)
	{
		$this->db->where('id_pemasok', $id);
		$this->db->delete('pemasok');
	}
}