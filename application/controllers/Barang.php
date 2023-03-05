<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	function __construct(){
		parent::__construct();
		check_not_login();
		check_admin();
		$this->load->model(['barang_m', 'kategori_m', 'satuan_m']);
	}

	function get_ajax() {
        $list = $this->barang_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $barang) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $barang->barcode.'<br><a href="'.site_url('barang/barcode/'.$barang->id_barang).'" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
            $row[] = $barang->nama;
            $row[] = $barang->nama_kategori;
            $row[] = $barang->nama_satuan;
            $row[] = indo_currency($barang->harga);
            $row[] = $barang->stok;
            $row[] = '<a href="'.site_url('barang/ubah/'.$barang->id_barang).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil-alt"></i> Ubah</a>
                    <a href="'.site_url('barang/hapus/'.$barang->id_barang).'" id="btn-hapus"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->barang_m->count_all(),
                    "recordsFiltered" => $this->barang_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

	public function index()
	{	
		$barang = $this->barang_m->get();
		$cek = $this->barang_m->cek_stok()->result();
		$data = array(
				'row'=> $barang,
				'cek' => $cek
			);
		$this->template->load('template', 'produk/barang/barang_data', $data);
	}

	public function tambah()
	{	
		$barang = new stdClass();
		$barang->id_barang = null;
		$barang->barcode = null;
		$barang->nama = null;
		$barang->harga = null;

		$query_kategori = $this->kategori_m->get();
		$kategori[null] = '- Pilih -';
		foreach($query_kategori->result() as $ktg){
			$kategori[$ktg->id_kategori] = $ktg->nama;
		}

		$query_satuan = $this->satuan_m->get();
		$satuan[null] = '- Pilih -';
		foreach($query_satuan->result() as $stn){
			$satuan[$stn->id_satuan] = $stn->nama;
		}

		$data = array(
			'page'=> 'tambah',
			'row'=> $barang,
			'kategori'=> $kategori, 'selectedkategori' => null,
			'satuan'=> $satuan, 'selectedsatuan' => null,
			'nobarcode' => $this->barang_m->no_barcode()
		);
		$this->template->load('template', 'produk/barang/barang_form', $data);
	}

	public function ubah($id)
	{
		$query = $this->barang_m->get($id);
		if($query->num_rows() > 0) {
			$barang = $query->row();
			$query_kategori = $this->kategori_m->get();

			$kategori[null] = '- Pilih -';
			foreach($query_kategori->result() as $ktg){
				$kategori[$ktg->id_kategori] = $ktg->nama;
			}

			$query_satuan = $this->satuan_m->get();
			$satuan[null] = '- Pilih -';
			foreach($query_satuan->result() as $stn){
				$satuan[$stn->id_satuan] = $stn->nama;
			}

			$data = array(
				'page'=> 'ubah',
				'row'=> $barang,
				'kategori'=> $kategori, 'selectedkategori' => $barang->id_kategori,
				'satuan'=> $satuan, 'selectedsatuan' => $barang->id_satuan
			);
			$this->template->load('template', 'produk/barang/barang_form', $data);
		} else {
			$this->session->set_flashdata('kesalahan', 'Data tidak ditemukan');
			redirect('barang');
		}
	}

	public function proses()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['tambah'])){
			if ($this->barang_m->cek_barcode($post['barcode'])-> num_rows() > 0){
				$this->session->set_flashdata('peringatan', "Barcode $post[barcode] sudah digunakan");
				redirect('barang/tambah');
			} else {
				$this->barang_m->tambah($post);
			}
		} elseif (isset($_POST['ubah'])){
			if ($this->barang_m->cek_barcode($post['barcode'], $post['id'])-> num_rows() > 0){
				$this->session->set_flashdata('peringatan', "Barcode $post[barcode] sudah digunakan");
				redirect('barang/ubah/'.$post['id']);
			} else {
				$this->barang_m->ubah($post);
			}
		}
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
		}
		redirect('barang');
		
	}

	public function hapus($id)
	{
		$this->barang_m->hapus($id);
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('peringatan', 'Data masih digunakan tidak dapat dihapus');
		}
		redirect('barang');
	}

	function barcode($id)
	{
		$data['row'] = $this->barang_m->get($id)->row();
		$this->template->load('template', 'produk/barang/barcode', $data);
	}

	function cetak_barcode($id)
	{
		$data['row'] = $this->barang_m->get($id)->row();
		$html = $this->load->view('produk/barang/barcode_print', $data, TRUE);
		$this->fungsi->pdf_generator($html,'barcode-'.$data['row']->barcode, 'A4', 'landscape');
	}

}
