		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Stok Keluar</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><i class="fas fa-home"></i></li>
							<li href="" class="breadcrumb-item">Transaksi</li>
							<li href="" class="breadcrumb-item">Stok Keluar</li>
							<li class="breadcrumb-item active">Tambah</li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">

	    <!-- Alert Flashdata -->
	    <div id="alert">   
	       <?php $this->view('pesan')?>
	    </div>
	    <script> 
	         setTimeout(function() {
	            $('#alert').fadeOut('slow');
	        }, 2500);
	    </script>
    
			<div class="container-fluid">
				<div class="card">

					<div class="card-header">
						<h3 class="card-title">
						Tambah Stok Keluar
						</h3>
						<div class="card-tools">
							<ul class="nav nav-pills ml-auto">
								<li class="nav-item">
									<a href="<?=site_url('stok/keluar')?>" class="btn btn-warning">
										<i class="fa fa-chevron-left"></i> Kembali</a>
								</li>
							</ul>
						</div>
					</div>
					<form action="<?=site_url('stok/proses')?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6 offset-md-3">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Tanggal*</label>
										<div class=" input-group col-sm-9">
											<div class="input-group-prepend" >
				                            <div class="input-group-text">
				                            	<i class="fa fa-calendar"></i>
				                        	</div>
				                        	</div>
											<input type="hidden" name="id_stok" value="">
											<input type="date" value="<?=date('Y-m-d')?>" name="tanggal" class="form-control" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label" for="barcode">Barcode*</label>
										<input type="hidden" name="id_barang" id="id_barang">
										<div class="input-group col-sm-9">
											<input type="text" name="barcode" id="barcode" class="form-control" required>
											<div class="input-group-append" >
												<button type="button" class="btn btn-info input-group-btn" data-toggle="modal" data-target="#modal-barang">	
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Nama Barang</label>
										<div class="col-sm-9">
											<input type="text" value="" name="nama" id="nama" class="form-control" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Satuan</label>
										<div class="col-sm-4">
											<input type="text" value="" name="satuan" id="satuan" class="form-control" readonly>
										</div>
										<label class="col-sm-2 offset-sm-1 col-form-label">Stok</label>
										<div class="col-sm-2">
											<input type="text" value="" name="stok" id="stok" class="form-control" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Keterangan*</label>
										<div class="col-sm-9">
											<input type="text" value="" name="keterangan" class="form-control" placeholder="kadaluwarsa / rusak / dll" maxlength="100" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Qty*</label>
										<div class="col-sm-9">
											<input type="number" min="1" value="1" name="qty" class="form-control" required>
										</div>
									</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="text-center">
							<button class="btn btn-success" type="submit" name="tambah_keluar">
                      		<i class="fas fa-save"></i> Simpan</button>

                      		<button class="btn btn-danger" type="reset">
                      		<i class="fa fa-undo"></i> Batal</button>
                      	</div>
					</div>
					</form>
				</div>
			</div>
		</section>

<div class="modal fade show" id="modal-barang">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Pilih Produk</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>					
				</button>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered text-center" id="table1">
					<thead>
						<tr>
							<th>Barcode</th>
							<th>Nama</th>
							<th>Satuan</th>
							<th>Harga</th>
							<th>Stok</th>
							<th>Tindakan</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
				          foreach($barang as $i => $data) { ?>
				          <tr>
				            <td><?=$data->barcode?></td>
				            <td><?=$data->nama?></td>
				            <td><?=$data->nama_satuan?></td>
				            <td class="text-right"><?=indo_currency($data->harga)?></td>
				            <td class="text-right"><?=$data->stok?></td>
				            <td width="100px">
				              <button class="btn btn-outline-primary btn-xs" id="pilih"
					              data-id="<?=$data->id_barang?>"
					              data-barcode="<?=$data->barcode?>"
					              data-nama="<?=$data->nama?>"
					              data-satuan="<?=$data->nama_satuan?>"
					              data-stok="<?=$data->stok?>">
				              <i class="fas fa-check"></i> Pilih
					          </button>
				            </td>
				          </tr>
				          <?php } ?> 
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(document).on('click','#pilih', function(){
			var id_barang = $(this).data('id');
			var barcode = $(this).data('barcode');
			var nama = $(this).data('nama');
			var satuan = $(this).data('satuan');
			var stok = $(this).data('stok');
			$('#id_barang').val(id_barang);
			$('#barcode').val(barcode);
			$('#nama').val(nama);
			$('#satuan').val(satuan);
			$('#stok').val(stok);
			$('#modal-barang').modal('hide');
		})
	})
</script>