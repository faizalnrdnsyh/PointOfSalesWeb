    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Stok</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-home"></i></li>
              <li class="breadcrumb-item">Laporan</li>
              <li class="breadcrumb-item active">Stok</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

<!-- Main content -->
    <section class="content">

      <div id="flash" data-flash="<?=$this->session->flashdata('sukses');?>"></div>
      <div id="flash-error" data-flash="<?=$this->session->flashdata('kesalahan');?>"></div>

       <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
                 Filter Data
            </h3>
          </div>
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="col-md-3">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label text-center">Tgl</label>
                      <div class=" input-group col-sm-9">
                        <?php foreach($cek as $i => $data) { ?>
                        <input type="hidden" id="nama" value="<?=$data->nama?>">
                        <?php } ?>
                        <input type="date" value="<?=@$post['tanggal1']?>" name="tanggal1" class="form-control">
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label text-center">s/d</label>
                      <div class=" input-group col-sm-9">
                        <input type="date" value="<?=@$post['tanggal2']?>" name="tanggal2" class="form-control">
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                      <label class="col-sm-5 col-form-label text-center">Pemasok</label>
                      <div class="col-sm-7">
                        <select name="pemasok" class="form-control custom-select">
                      <option value="">- Semua -</option>
                      <?php foreach ($pemasok as $p => $data) { ?>
                        <option value="<?=$data->id_pemasok?>" <?=@$post['pemasok'] == $data->id_pemasok ? 'selected' : ''?>><?=ucfirst($data->nama)?></option>
                      <?php }?>
                    </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                      <label class="col-sm-5 col-form-label text-center">Mutasi</label>
                      <div class="col-sm-7">
                        <select name="mutasi" class="form-control custom-select">
                          <option value="">- Semua -</option>
                          <option value="masuk" <?=@$post['mutasi'] == 'masuk' ? 'selected' : ''?>>Masuk</option>
                          <option value="keluar" <?=@$post['mutasi'] == 'keluar' ? 'selected' : ''?>>Keluar</option>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="text-right">
                      <button class="btn btn-success" type="submit" name="filter">
                      <i class="fas fa-filter"></i> Filter</button>

                      <button class="btn btn-warning" type="submit" name="reset">
                      <i class="fa fa-undo"></i> Reset</button>
                    </div>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>

      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Data Laporan Penjualan
            </h3>
          </div>
          <div class="card-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr class="text-center">
                  <th width="5%">#</th>
                  <th>Tanggal</th>
                  <th>Barang</th>
                  <th>Keterangan</th>
                  <th>Mutasi</th>
                  <th>Qty</th>
                  <th>Stok Akhir</th>
                  <th width="200px">Tindakan</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 1 ;
                foreach($row->result() as $key => $data) {?>
                  <tr class="text-center">
                    <td><?=$no++?></td>
                    <td><?=indo_date($data->tanggal)?></td>
                    <td class="text-left"><?=$data->nama_barang?></td>
                    <td class="text-left"><?=$data->keterangan?></td>
                    <td><?=$data->tipe?></td>
                    <td class="text-right"><?=$data->qty?></td>
                    <td class="text-right"><?=$data->stok?></td>
                    <td>
                        <button id="detail" data-toggle="modal" data-target="#modal-detail" 
                        data-tanggal="<?=$data->tanggal?>"
                        data-waktu="<?=substr($data->stok_dibuat, 11, 5)?>"
                        data-pemasok="<?=$data->nama_pemasok == "" ? "-" : ucfirst($data->nama_pemasok)?>"
                        data-pengguna="<?=$data->pengguna == "" ? "-" : ucfirst($data->pengguna)?>"
                        data-barang="<?=$data->nama_barang?>"
                        data-keterangan="<?=ucfirst($data->keterangan)?>"
                        data-tipe="<?=ucfirst($data->tipe)?>"
                        data-qty="<?=$data->qty?>"
                        data-stok="<?=$data->stok?>"
                        class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Detail</button>
                        
                        <!-- <a href="<?=site_url('stok/'.$data->tipe.'/hapus/'.$data->id_stok.'/'.$data->id_barang)?>" id="btn-hapus" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i> Hapus</a> -->
                    </td>    
                  </tr>
                <?php
                }?>
              </tbody>
            </table>
          </div>

          <div class="card-footer clearfix">
            <ul class="pagination float-right">
              <?=$pagination?>
            </ul>
          </div>
        </div>
      </div>
    </section>

<div class="modal fade show" id="modal-detail">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>         
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped no-margin">
          <tbody>
            <tr>
              <th>Tanggal Jam</th>
              <td><span id="waktutanggal"></span></td>
            </tr>
            <tr>
              <th>Barang</th>
              <td><span id="barang"></span></td>
            </tr>
            <tr>
              <th>Mutasi</th>
              <td><span id="tipe"></span></td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td><span id="keterangan"></span></td>
            </tr>
            <tr>
              <th>Qty</th>
              <td><span id="qty"></span></td>
            </tr>
            <tr>
              <th>Stok</th>
              <td><span id="stok"></span></td>
            </tr>
            <tr>
              <th>Pemasok</th>
              <td><span id="pemasok"></span></td>
            </tr>
            <tr>
              <th>Operator</th>
              <td><span id="pengguna"></span></td>
            </tr>
          </tbody>
        </table>              
      </div>
    </div>
  </div>
</div>

<script>

  $(document).on('click','#detail', function(){
    $('#waktutanggal').text($(this).data('tanggal') + ' ' + $(this).data('waktu'))
    $('#pemasok').text($(this).data('pemasok'))
    $('#tipe').text($(this).data('tipe'))
    $('#barang').text($(this).data('barang'))
    $('#qty').text($(this).data('qty'))
    $('#stok').text($(this).data('stok'))
    $('#keterangan').text($(this).data('keterangan'))
    $('#pengguna').text($(this).data('pengguna'))
  });

  $(document).ready(function() {
  $('#nama').val($(this).data('nama'))
    var nama = $('#nama').val()

    if(nama != null){
    swal({
        type: "warning",
        title: "Stok Hampir Habis",
        text: "Ada stok barang yang hampir habis",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Tambah Stok",
        cancelButtonText: "Nanti",
        closeOnConfirm: true,
      },
       function(isConfirm) {
      if (isConfirm) {
          window.open('<?=site_url('stok/masuk/tambah/restok')?>')
      } 
    });
    }
  });


</script>