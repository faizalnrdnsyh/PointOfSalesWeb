<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_m extends CI_Model {

	public function get($id = null)
	{
		$this->db->from('p_kategori');
		if($id != null){
			$this->db->where('id_kategori', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambah($post)
	{
		$params = [
			'nama' => $post['nama'],
		];
		$this->db->insert('p_kategori',$params);
	}

	public function ubah($post)
	{
		$params = [
			'nama' => $post['nama'],
			'diubah' => date('Y-m-d H:i:s')
		];
		$this->db->where('id_kategori', $post['id']);
		$this->db->update('p_kategori',$params);
	}


	public function hapus($id)
	{
		$this->db->where('id_kategori', $id);
		$this->db->delete('p_kategori');
	}
}