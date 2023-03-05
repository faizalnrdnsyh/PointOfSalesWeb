<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_m extends CI_Model {


	// start datatables
    var $column_order = array(null, 'barcode', 'p_barang.nama', 'nama_kategori', 'nama_satuan', 'harga', 'stok'); //set column field database for datatable orderable
    var $column_search = array('barcode', 'p_barang.nama', 'harga'); //set column field database for datatable searchable
    var $order = array('stok' => 'asc'); // default order 
 
    private function _get_datatables_query() {
        $this->db->select('p_barang.*, p_kategori.nama as nama_kategori, p_satuan.nama as nama_satuan');
        $this->db->from('p_barang');
        $this->db->join('p_kategori', 'p_barang.id_kategori = p_kategori.id_kategori');
        $this->db->join('p_satuan', 'p_barang.id_satuan = p_satuan.id_satuan');
        
        $i = 0;
        foreach ($this->column_search as $barang) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($barang, $_POST['search']['value']);
                } else {
                    $this->db->or_like($barang, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('p_barang');
        return $this->db->count_all_results();
    }
    // end datatables

	public function no_barcode()
	{
		$sql = "SELECT MAX(MID(barcode,11,3)) AS no_barcode 
				FROM p_barang 
				WHERE MID(barcode,5, 6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			$row = $query->row();
			$n = ((int)$row->no_barcode) + 1;
			$no = sprintf("%'.03d",$n);
		} else {
			$no = "001";
		}
		date_default_timezone_set('Asia/Jakarta');
		$nobarcode = "UNIK".date('ymd').$no;
		return $nobarcode;
	}

	public function get($id = null)
	{	
		$this->db->select('p_barang.*, p_kategori.nama as nama_kategori, p_satuan.nama as nama_satuan');
        $this->db->from('p_barang');
        $this->db->join('p_kategori', 'p_barang.id_kategori = p_kategori.id_kategori');
        $this->db->join('p_satuan', 'p_barang.id_satuan = p_satuan.id_satuan');
		if($id != null){
			$this->db->where('id_barang', $id);
		}
		$this->db->order_by('id_barang', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get_stok_masuk($id = null)
	{	
		$this->db->select('p_barang.*, p_kategori.nama as nama_kategori, p_satuan.nama as nama_satuan');
        $this->db->from('p_barang');
        $this->db->join('p_kategori', 'p_barang.id_kategori = p_kategori.id_kategori');
        $this->db->join('p_satuan', 'p_barang.id_satuan = p_satuan.id_satuan');
		if($id != null){
			$this->db->where('id_barang', $id);
		}
		$this->db->where('p_barang.stok < 5');
		$this->db->order_by('p_barang.stok', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function get_stok_keluar($id = null)
	{	
		$this->db->select('p_barang.*, p_kategori.nama as nama_kategori, p_satuan.nama as nama_satuan');
        $this->db->from('p_barang');
        $this->db->join('p_kategori', 'p_barang.id_kategori = p_kategori.id_kategori');
        $this->db->join('p_satuan', 'p_barang.id_satuan = p_satuan.id_satuan');
		if($id != null){
			$this->db->where('id_barang', $id);
		}
		$this->db->where('p_barang.retur = 1');
		$this->db->order_by('id_barang', 'desc');
		$query = $this->db->get();
		return $query;
	}

	function get_barcode($barcode = null)
	{	
		$this->db->select('p_barang.*, p_kategori.nama as nama_kategori, p_satuan.nama as nama_satuan');
        $this->db->from('p_barang');
        $this->db->join('p_kategori', 'p_barang.id_kategori = p_kategori.id_kategori');
        $this->db->join('p_satuan', 'p_barang.id_satuan = p_satuan.id_satuan');
		if($barcode != null){
			$this->db->where('barcode', $barcode);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tambah($post)
	{
		$params = [
			'barcode' => $post['barcode'],
			'nama' => $post['nama'],
			'id_kategori' => $post['kategori'],
			'id_satuan' => $post['satuan'],
			'harga' => $post['harga'],
			'retur' => $post['retur'],
		];
		$this->db->insert('p_barang',$params);
	}

	public function ubah($post)
	{
		$params = [
			'barcode' => $post['barcode'],
			'nama' => $post['nama'],
			'id_kategori' => $post['kategori'],
			'id_satuan' => $post['satuan'],
			'harga' => $post['harga'],
			'retur' => $post['retur'],
			'diubah' => date('Y-m-d H:i:s')
		];
		$this->db->where('id_barang', $post['id']);
		$this->db->update('p_barang',$params);
	}


	public function hapus($id)
	{
		$this->db->where('id_barang', $id);
		$this->db->delete('p_barang');
	}

	function cek_barcode($kode, $id = null)
	{
		$this->db->from('p_barang');
		$this->db->where('barcode', $kode);
		if($id != null){
			$this->db->where('id_barang !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	function tambah_stok($data)
	{
		$qty = $data['qty'];
		$id = $data['id_barang'];
		$sql = "UPDATE p_barang SET stok = stok + '$qty' WHERE id_barang = '$id'";
		$this->db->query($sql);
	}

	function kurang_stok($data)
	{
		$qty = $data['qty'];
		$id = $data['id_barang'];
		$sql = "UPDATE p_barang SET stok = stok - '$qty' WHERE id_barang = '$id'";
		$this->db->query($sql);
	}

	function cek_stok()
	{	
		$this->db->select('p_barang.*');
        $this->db->from('p_barang');
		$this->db->where('stok < 5');
		$this->db->order_by('id_barang', 'desc');
		$query = $this->db->get();
		return $query;
	}
}