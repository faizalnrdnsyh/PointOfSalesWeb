    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pelanggan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-home"></i></li>
              <li class="breadcrumb-item">Pelanggan</li>
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
             <?=ucfirst($page)?> Pelanggan
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a href="<?=site_url('pelanggan')?>" class="btn btn-warning">
                    <i class="fa fa-chevron-left"></i> Kembali</a>
                </li>
              </ul>
            </div>
          </div>

          <form action="<?=site_url('pelanggan/proses')?>" method="post">
          <div class="card-body">
                <div class="row">
      				<div class="col-md-6 offset-md-3">
						<div class="form-group row">
							<label class="col-sm-5 col-form-label" for="nama">Nama Pelanggan *</label>
							<div class="col-sm-7">
              				<input type="hidden" name="id" value="<?=$row->id_pelanggan?>">
							<input type="text" name="nama" class="form-control" id="nama" value="<?=$row->nama?>" maxlength="50" required autofocus>
							</div>
  						</div>
  						<div class="form-group row">
  							<label class="col-sm-5 col-form-label" for="jenkel">Jenis Kelamin *</label>
  							<div class="col-sm-7">
  							<select name="jenkel" class="form-control custom-select" required="">
  								<option>- Pilih -</option>
  								<option value="L" <?=$row->jenkel == 'L' ? 'selected' : null?>>Laki-laki</option>
  								<option value="P" <?=$row->jenkel == 'P' ? 'selected' : null?>>Perempuan</option>	
  							</select>
  							</div>
  						</div>
  						<div class="form-group row">
  							<label class="col-sm-5 col-form-label" for="telp">No. Telp *</label>
  							<div class="col-sm-7">
  							<input type="text" name="telp" class="form-control" id="telp" value="<?=$row->no_telp?>" maxlength="15" required>
  							</div>
  						</div>
  						<div class="form-group row">
  							<label class="col-sm-5 col-form-label" for="alamat" maxlength="200">Alamat</label>
  							<div class="col-sm-7">
  							<textarea name="alamat" class="form-control" id="alamat"><?=$row->alamat?></textarea>
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
