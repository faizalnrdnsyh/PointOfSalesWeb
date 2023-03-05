<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_m extends CI_Model {
	
	public function login($post)
	{	
		$this->db->from('pengguna');
		$this->db->where('nama_pengguna', $post['username']);
		$this->db->where('katasandi', sha1($post['password']));
		$query = $this->db->get();
		return $query;
	}

	public function get($id = null)
	{
		$this->db->from('pengguna');
		if($id != null){
			$this->db->where('id_pengguna', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambah($post)
	{	
		$params['nama'] = $post['namalengkap'];
		$params['nama_pengguna'] = $post['namapengguna'];
		$params['katasandi'] = sha1($post['katasandi']);
		$params['alamat'] = $post['alamat'] != "" ? $post['alamat'] : null;
		$params['level'] = $post['level'];
		$this->db->insert('pengguna',$params);
	}

	public function ubah($post)
	{	
		$params['nama'] = $post['namalengkap'];
		$params['nama_pengguna'] = $post['namapengguna'];
		if(!empty($post['katasandi'])){
			$params['katasandi'] = sha1($post['katasandi']);
		}
		$params['alamat'] = $post['alamat'] != "" ? $post['alamat'] : null;
		$params['level'] = $post['level'];
		$this->db->where('id_pengguna', $post['id']);	
		$this->db->update('pengguna', $params);
	}

	public function hapus($id)
	{
		$this->db->where('id_pengguna', $id);
		$this->db->delete('pengguna');
	}
}