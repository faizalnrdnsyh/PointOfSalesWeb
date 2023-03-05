    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stok Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-home"></i></li>
              <li href="" class="breadcrumb-item">Transaksi</li>
              <li class="breadcrumb-item active">Stok Masuk</li>
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

      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Data Stok Masuk
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a href="<?=site_url('stok/masuk/tambah')?>" class="btn btn-success">
                    <i class="fa fa-plus"></i> Tambah</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered text-center" id="table1">
              <thead>
                <tr class="text-center">
                  <th width="5%">#</th>
                  <th>Barcode</th>
                  <th>Barang</th>
                  <th>Qty</th>
                  <th>Tanggal</th>
                  <th width="160px">Tindakan</th>
                </tr>
              </thead>
              <tbody>
                      <?php $no = 1;
                      foreach($row as $key => $data) { ?>
                      <tr>
                        <td><?=$no++?></td>
                        <td><?=$data->barcode?></td>
                        <td><?=$data->nama_barang?></td>
                        <td class="text-right"><?=$data->qty?></td>
                        <td><?=indo_date($data->tanggal)?></td>
                        <td width="160px">
                        <a href="" id="set_detail" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-detail"
                          data-barcode="<?=$data->barcode?>"
                          data-barang="<?=$data->nama_barang?>"
                          data-keterangan="<?=$data->keterangan?>"
                          data-pemasok="<?=$data->nama_pemasok?>"
                          data-qty="<?=$data->qty?>"
                          data-tanggal="<?=indo_date($data->tanggal)?>">
                          <i class="fas fa-eye"></i> Detail</a>
                          
                          <a href="<?=site_url('stok/masuk/hapus/'.$data->id_stok.'/'.$data->id_barang)?>" id="btn-hapus" class="btn btn-xs btn-danger">
                          <i class="fa fa-trash-alt"></i> Hapus</a>
                        </td>
                      </tr>
                    <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <div class="modal fade show" id="modal-detail">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>         
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-striped table-bordered no-margin">
          <tbody>
            <tr>
              <th style="width: 30%">Barcode</th>
              <td><span id="barcode"></span></td>
            </tr>
            <tr>
              <th>Barang</th>
              <td><span id="nama_barang"></span></td>
            </tr>
            <tr>
              <th>Keterangan</th>
              <td><span id="keterangan"></span></td>
            </tr>
            <tr>
              <th>Pemasok</th>
              <td><span id="nama_pemasok"></span></td>
            </tr>
            <tr>
              <th>Qty</th>
              <td><span id="qty"></span></td>
            </tr>
            <tr>
              <th>Tanggal</th>
              <td><span id="tanggal"></span></td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(document).on('click','#set_detail', function(){
      var barcode = $(this).data('barcode');
      var namabarang = $(this).data( 'barang');
      var keterangan = $(this).data('keterangan');
      var namapemasok = $(this).data('pemasok');
      var qty = $(this).data('qty');
      var tanggal= $(this).data('tanggal');
      $('#barcode').text(barcode);
      $('#nama_barang').text(namabarang);
      $('#keterangan').text(keterangan);
      $('#nama_pemasok').text(namapemasok == '' ? '-' : namapemasok );
      $('#qty').text(qty);
      $('#tanggal').text(tanggal);
    })
  })
</script>
