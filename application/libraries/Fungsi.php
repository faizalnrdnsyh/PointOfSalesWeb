<?php

class Fungsi {
	protected $ci;

	function __construct() {
		$this->ci =& get_instance();
	}

	function user_login(){
		$this->ci->load->model('pengguna_m');
		$user_id = $this->ci->session->userdata('userid');
		$user_data = $this->ci->pengguna_m->get($user_id)->row();
		return $user_data;
	}

	function pdf_generator($html, $filename, $size, $orientation){
		$dompdf = new Dompdf\Dompdf();
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper($size, $orientation);

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream($filename, array('Attachment' => 0));
	}

	function hitung_barang(){
	$this->ci->load->model('barang_m');
	return $this->ci->barang_m->get()->num_rows();
	}
	function hitung_pemasok(){
		$this->ci->load->model('pemasok_m');
		return $this->ci->pemasok_m->get()->num_rows();
	}
	function hitung_pelanggan(){
		$this->ci->load->model('pelanggan_m');
		return $this->ci->pelanggan_m->get()->num_rows();
	}
	function hitung_pengguna(){
		$this->ci->load->model('pengguna_m');
		return $this->ci->pengguna_m->get()->num_rows();
	}
}