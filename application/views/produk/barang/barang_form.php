		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Barang</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><i class="fas fa-home"></i></li>
							<li class="breadcrumb-item">Produk</li>
							<li class="breadcrumb-item">Barang</li>
							 <li class="breadcrumb-item active"><?=ucfirst($page)?></li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">

		    <!-- Alert Flashdata -->
		    <div id="alert">   
		       <?php $this->view('pesan')?>
		    </div>
		    <script> 
		         setTimeout(function() {
		            $('#alert').fadeOut('slow');
		        }, 2500);
		    </script>

				<div class="card">

					<div class="card-header">
						<h3 class="card-title">
						 <?=ucfirst($page)?> Barang
						</h3>
						<div class="card-tools">
							<ul class="nav nav-pills ml-auto">
								<li class="nav-item">
									<a href="<?=site_url('barang')?>" class="btn btn-warning">
										<i class="fa fa-chevron-left"></i> Kembali</a>
								</li>
							</ul>
						</div>
					</div>
					
					<form action="<?=site_url('barang/proses')?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6 offset-md-3">
								<div class="col-sm-7 offset-sm-5">
									<small>(barcode otomatis, ganti jika tidak digunakan)</small>
								</div>
								<div class="form-group row">
									<label class="col-sm-5 col-form-label" for="barcode">Barcode *</label>
									<div class="col-sm-7">
									<input type="hidden" name="id" value="<?=$row->id_barang?>">
									<input type="text" name="barcode" class="form-control" id="barcode" value="<?=$row->barcode == '' ? $nobarcode : $row->barcode?>" maxlength="50" required autofocus>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-5 col-form-label" for="nama">Nama Barang *</label>
									<div class="col-sm-7">
									<input type="text" name="nama" id="a" class="form-control" id="nama" value="<?=$row->nama?>" maxlength="50" required>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-5 col-form-label" for="kategori">Kategori *</label>
									<div class="col-sm-7">
									<?= form_dropdown('kategori', $kategori, $selectedkategori, ['class' => 'form-control custom-select', 'required' => 'required' ])?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-5 col-form-label" for="satuan">Satuan *</label>
									<div class="col-sm-7">
										<?= form_dropdown('satuan', $satuan, $selectedsatuan, ['class' => 'form-control custom-select', 'required' => 'required' ])?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-5 col-form-label" for="harga">Harga *</label>
									<div class="col-sm-7 input-group">
					                  	<div class="input-group-prepend">
					                    	<span class="input-group-text">Rp</span>
					                  	</div>
					                  	<input type="number" name="harga" class="form-control" id="harga" value="<?=$row->harga?>" required>
					                </div>
								</div>
								<div class="form-group row">
									<label class="col-sm-5 col-form-label" for="retur">Bisa Retur</label>
									<div class="col-sm-7 input-group">
					                  	<select name="retur" class="form-control custom-select"  id="retur">
					                  		<?php if($this->uri->segment(2) == 'tambah') { ?>
											<option value="1" <?=set_value('retur') == 1 ? "selected" : null?>>Ya</option>
											<option value="2" <?=set_value('retur') == 2 ? "selected" : null?>>Tidak</option>
											<?php } else if($this->uri->segment(2) == 'ubah') { ?>

											<?php $retur = $this->input->post('retur') ?? $row->retur?>
											<option value="1">Ya</option>
											<option value="2"<?=$retur == 2 ? 'selected' : null ?>>Tidak</option>
											<?php }?>
										</select>
					                </div>
								</div>
							</div>
						</div>
					</div>

					<div class="card-footer">
		                <div class="text-center">                      
		                      <button class="btn btn-success" type="submit" name="<?=$page?>">
		                      <i class="fas fa-save"></i> Simpan</button>

		                      <button class="btn btn-danger" type="reset">
		                      <i class="fa fa-undo"></i> Batal</button>
		                </div>
		          	</div>
		          	</form>

				</div>
			</div>
		</section>
