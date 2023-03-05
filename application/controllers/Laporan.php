<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct(){
		parent::__construct();
		check_not_login();
		$this->load->model(['penjualan_m', 'stok_m']);
	}

	public function penjualan()
	{	
		$this->load->model('pelanggan_m');
		$this->load->library('pagination');

		if(isset($_POST['reset'])){
			$this->session->unset_userdata('search');
			redirect('laporan/penjualan');
		}

		if(isset($_POST['filter'])){
			$post = $this->input->post(null, TRUE);
			$this->session->set_userdata('search', $post);
		} else {
			$post = $this->session->userdata('search');
		}

		$config['base_url'] = site_url('laporan/penjualan');
		$config['total_rows'] = $this->penjualan_m->get_penjualan_laporan()->num_rows();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';
		$config['num_tag_open'] = '<li><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '</span></li>';
		$config['first_tag_open'] = '<li><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['prev_tag_open'] = '<li><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';


		$this->pagination->initialize($config);

		$data = array(
			'pagination' => $this->pagination->create_links(),
			'pelanggan' => $this->pelanggan_m->get()->result(),
			'row' => $this->penjualan_m->get_penjualan_laporan($config['per_page'], $this->uri->segment(3)),
			'post' => $post,
			'sum' => $this->penjualan_m->get_total()->row(),
		);
		$this->template->load('template', 'laporan/laporan_penjualan', $data);
	}

	public function produk_penjualan($id_penjualan = null)
	{
		$detail = $this->penjualan_m->get_penjualan_detail($id_penjualan)->result();
		echo json_encode($detail);
	}

	public function stok()
	{	
		
		$this->load->model(['pemasok_m','barang_m']);
		$this->load->library('pagination');


		if(isset($_POST['reset'])){
			$this->session->unset_userdata('search');
			redirect('laporan/stok');
		}

		if(isset($_POST['filter'])){
			$post = $this->input->post(null, TRUE);
			$this->session->set_userdata('search', $post);
		} else {
			$post = $this->session->userdata('search');
		}

		$config['base_url'] = site_url('laporan/stok');
		$config['total_rows'] = $this->stok_m->get_stok_laporan()->num_rows();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Awal';
		$config['last_link'] = 'Akhir';
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';
		$config['num_tag_open'] = '<li><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '</span></li>';
		$config['first_tag_open'] = '<li><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['prev_tag_open'] = '<li><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';


		$this->pagination->initialize($config);

		$data = array(
			'pagination' => $this->pagination->create_links(),
			'pemasok' => $this->pemasok_m->get()->result(),	
			'row' => $this->stok_m->get_stok_laporan($config['per_page'], $this->uri->segment(3)),
			'post' => $post,
			'cek' => $this->barang_m->cek_stok()->result(),
		);
		$this->template->load('template', 'laporan/laporan_stok', $data);
	}
}