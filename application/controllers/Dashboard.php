<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		check_not_login();

		// $query = $this->db->query("SELECT t_penjualan_detail.id_barang, p_barang.nama AS nama, (SELECT SUM(t_penjualan_detail.qty)) AS produk FROM t_penjualan_detail
		// 		INNER JOIN t_penjualan ON t_penjualan_detail.id_penjualan = t_penjualan.id_penjualan
		// 		INNER JOIN p_barang ON t_penjualan_detail.id_barang = p_barang.id_barang 
		// 	WHERE MID(t_penjualan.tanggal, 6, 2) = DATE_FORMAT(CURDATE(), '%m')
		// 	GROUP BY t_penjualan_detail.id_barang
		// 	ORDER BY produk DESC
		// 	LIMIT 10");
		$query = $this->db->query("SELECT t_penjualan_detail.id_barang, p_barang.nama AS nama, (SELECT SUM(CASE 
			WHEN t_penjualan_detail.harga <= 150 THEN t_penjualan_detail.qty/1000 
			WHEN t_penjualan_detail.harga < 500 THEN t_penjualan_detail.qty /100
            ELSE t_penjualan_detail.qty END)) AS produk FROM t_penjualan_detail
				INNER JOIN t_penjualan ON t_penjualan_detail.id_penjualan = t_penjualan.id_penjualan
				INNER JOIN p_barang ON t_penjualan_detail.id_barang = p_barang.id_barang 
			WHERE MID(t_penjualan.tanggal, 6, 2) = DATE_FORMAT(CURDATE(), '%m')
			GROUP BY t_penjualan_detail.id_barang
			ORDER BY produk DESC
			LIMIT 10");
		// + konversi gram menjadi kilogram
		
		$sql = $this->db->query("SELECT tanggal, sum(total_akhir) as omzet FROM t_penjualan 
			GROUP BY tanggal
			ORDER BY tanggal DESC
			LIMIT 7");

		$data = array (
			'product' => $query->result(),
			'sales' => $sql->result()
		);

		$this->template->load('template', 'dashboard', $data);
	}
}
