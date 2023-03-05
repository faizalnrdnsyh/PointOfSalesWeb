    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-home"></i></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

    <!-- Alert Flashdata -->
    <div id="flash" data-flash="<?=$this->session->flashdata('sukses');?>"></div>
    <div id="flash-error" data-flash="<?=$this->session->flashdata('kesalahan');?>"></div>

        <div class="card">

          <div class="card-header">
            <h3 class="card-title">
              Data Profil
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a href="<?=site_url('dashboard')?>" class="btn btn-warning">
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
            <input type="hidden" name="id" value="<?=$row->id_pengguna?>">
            <input type="text" name="namalengkap" class="form-control <?=form_error('namalengkap') ? 'is-invalid' : null?>" id="namalengkap" value="<?=$this->input->post('namalengkap') ?? $row->nama?>" autofocus>
            <span id="exampleInputEmail1-error" class="error invalid-feedback"><?=form_error('namalengkap')?></span>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="namapengguna">Nama Pengguna *</label>
            <div class="col-sm-7">
            <input type="text" name="namapengguna" class="form-control <?=form_error('namapengguna') ? 'is-invalid' : null?>" id="namapengguna" value="<?=$this->input->post('namapengguna') ?? $row->nama_pengguna?>">
            <span id="exampleInputEmail1-error" class="error invalid-feedback"><?=form_error('namapengguna')?></span>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="katasandi">Kata Sandi</label>
            <div class="col-sm-7">
            <input type="password" name="katasandi" class="form-control <?=form_error('katasandi') ? 'is-invalid' : null?>" id="katasandi" value="<?=$this->input->post('katasandi')?>">
            <small>(Biarkan kosong jika tidak diganti)</small>
            <span id="exampleInputEmail1-error" class="error invalid-feedback"><?=form_error('katasandi')?></span>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="konfsandi">Konfirmasi Kata Sandi</label>
            <div class="col-sm-7">
            <input type="password" name="konfsandi" class="form-control <?=form_error('konfsandi') ? 'is-invalid' : null?>" id="konfsandi" value="<?=$this->input->post('konfsandi')?>">
            <span id="exampleInputEmail1-error" class="error invalid-feedback"><?=form_error('konfsandi')?></span>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="alamat">Alamat</label>
            <div class="col-sm-7">
              <textarea id="alamat" type="text" name="alamat" class="form-control"><?=$this->input->post('alamat') ?? $row->alamat?></textarea>
            </div>
          </div>
          
         <?php if($this->fungsi->user_login()->level == 1) { ?>
         <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="level">Level</label>
            <div class="col-sm-7">
              <select name="level" class="form-control custom-select" id="level">
                <?php $level = $this->input->post('level') ?? $row->level?>
                <option value="1">Admin</option>
                <option value="2" <?=$level == 2 ? 'selected' : null ?>> Kasir </option>
              </select>
            </div>
          </div>
           <?php } else { ?>
          <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="level">Level</label>
            <div class="col-sm-7">
            <input type="hidden" name="level" class="form-control" id="level" value="2">
            <input type="text" class="form-control" value="Kasir" readonly>
            </div>
          </div>
           <?php } ?>

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