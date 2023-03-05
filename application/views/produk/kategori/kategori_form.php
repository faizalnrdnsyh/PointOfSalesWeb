		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Kategori</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><i class="fas fa-home"></i></li>
							<li class="breadcrumb-item">Produk</li>
							<li class="breadcrumb-item">Kategori</li>
							 <li class="breadcrumb-item active"><?=ucfirst($page)?></li>
						</ol>
					</div>
				</div>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="card">

					<div class="card-header">
						<h3 class="card-title">
						 <?=ucfirst($page)?> kategori
						</h3>
						<div class="card-tools">
							<ul class="nav nav-pills ml-auto">
								<li class="nav-item">
									<a href="<?=site_url('kategori')?>" class="btn btn-warning">
										<i class="fa fa-chevron-left"></i> Kembali</a>
								</li>
							</ul>
						</div>
					</div>

					<form action="<?=site_url('kategori/proses')?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6 offset-md-3">
								<div class="form-group row">
									<label class="col-sm-5 col-form-label" for="nama">Nama Kategori *</label>
									<div class="col-sm-7">
									<input type="hidden" name="id" value="<?=$row->id_kategori?>">
									<input type="text" name="nama" class="form-control" id="nama" value="<?=$row->nama?>" maxlength="50" required autofocus>
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
