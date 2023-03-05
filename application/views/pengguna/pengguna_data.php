    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-home"></i></li>
              <li class="breadcrumb-item active">Pengguna</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">

   <!-- Alert Flashdata -->
    <div id="flash" data-flash="<?=$this->session->flashdata('sukses');?>"></div>
    <div id="flash-warning" data-flash="<?=$this->session->flashdata('peringatan');?>"></div>
    <div id="flash-error" data-flash="<?=$this->session->flashdata('kesalahan');?>"></div>
    
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Data Pengguna
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a href="<?=site_url('pengguna/tambah')?>" class="btn btn-success">
                    <i class="fa fa-plus"></i> Tambah</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="table1">
              <thead>
                <tr class="text-center">
                  <th width="5%">#</th>
                  <th>Nama Pengguna</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Level</th>
                  <th width="160px">Tindakan</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach($row->result() as $key => $data) {?>
                  <tr>
                    <td class="text-center"><?=$no++?></td>
                    <td><?=$data->nama_pengguna?></td>
                    <td><?=$data->nama?></td>
                    <td><?=$data->alamat?></td>
                    <td class="text-center"><?=$data->level == 1 ? "Admin" : "Kasir"?></td> 
                    <td class="text-center">
                        <a href="<?=site_url('pengguna/ubah/'.$data->id_pengguna)?>" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil-alt"></i> Ubah</a>

                        <a href="<?=site_url('pengguna/hapus/'.$data->id_pengguna)?>" id="btn-hapus" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash-alt"></i> Hapus</a>
                    </td>      
                  </tr>
                <?php
                }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>