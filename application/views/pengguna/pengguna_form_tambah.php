    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-home"></i></li>
              <li class="breadcrumb-item">Pengguna</li>
              <li class="breadcrumb-item active">Tambah</li>
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
              Tambah Pengguna
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a href="<?=site_url('pengguna')?>" class="btn btn-warning">
                    <i class="fa fa-chevron-left"></i> Kembali</a>
                </li>
              </ul>
            </div>
          </div>

          <form action="" method="post">
          <div class="card-body">
            <div class="row">
				<div class="col-md-6 offset-md-3">
					<div class="form-group row">
						<label class="col-sm-5 col-form-label" for="namalengkap">Nama *</label>
						<div class="col-sm-7">
						<input type="text" name="namalengkap" class="form-control <?=form_error('namalengkap') ? 'is-invalid' : null?>" id="namalengkap" value="<?=set_value('namalengkap')?>" maxlength="50" autofocus>
						<span id="exampleInputEmail1-error" class="error invalid-feedback"><?=form_error('namalengkap')?></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-5 col-form-label" for="namapengguna">Nama Pengguna *</label>
						<div class="col-sm-7">
						<input type="text" name="namapengguna" class="form-control <?=form_error('namapengguna') ? 'is-invalid' : null?>" id="namapengguna" value="<?=set_value('namapengguna')?>" maxlength="50">
						<span id="exampleInputEmail1-error" class="error invalid-feedback"><?=form_error('namapengguna')?></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-5 col-form-label" for="katasandi">Kata Sandi *</label>
						<div class="col-sm-7">
						<input type="password" name="katasandi" class="form-control <?=form_error('katasandi') ? 'is-invalid' : null?>" id="katasandi" value="<?=set_value('katasandi')?>" maxlength="50">
						<span id="exampleInputEmail1-error" class="error invalid-feedback"><?=form_error('katasandi')?></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-5 col-form-label" for="konfsandi">Konfirmasi Kata Sandi *</label>
						<div class="col-sm-7">
						<input type="password" name="konfsandi" class="form-control <?=form_error('konfsandi') ? 'is-invalid' : null?>" id="konfsandi" value="<?=set_value('konfsandi')?>">
						<span id="exampleInputEmail1-error" class="error invalid-feedback"><?=form_error('konfsandi')?></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-5 col-form-label" for="alamat">Alamat</label>
						<div class="col-sm-7">
							<textarea id="alamat" type="text" name="alamat" class="form-control" maxlength="200"><?=set_value('alamat')?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-5 col-form-label" for="level">Level*</label>
						<div class="col-sm-7">
							<select name="level" class="form-control  custom-select <?=form_error('level') ? 'is-invalid' : null?>" id="level">
								<option value="">- Pilih -</option>
								<option value="1" <?=set_value('level') == 1 ? "selected" : null?>>Admin</option>
								<option value="2" <?=set_value('level') == 2 ? "selected" : null?>>Kasir</option>
							</select>
							<span id="exampleInputEmail1-error" class="error invalid-feedback"><?=form_error('level')?></span>
						</div>
					</div>
				</div>
			</div>
          </div>
          
          <div class="card-footer">
                <div class="text-center">                      
                    <button class="btn btn-success" type="submit">
              		<i class="fas fa-save"></i> Simpan</button>

              		<button class="btn btn-danger" type="reset">
              		<i class="fa fa-undo"></i> Batal</button>
                </div>
          </div>
          </form>

        </div>
      </div>
    </section>
