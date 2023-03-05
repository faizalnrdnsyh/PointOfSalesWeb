    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-home"></i></li>
              <li class="breadcrumb-item">Laporan</li>
              <li class="breadcrumb-item active">Penjualan</li>
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
                      <label class="col-sm-5 col-form-label text-center">Pelanggan</label>
                      <div class="col-sm-7">
                        <select name="pelanggan" class="form-control custom-select">
                      <option value="">- Semua -</option>
                      <option value="null" <?=@$post['pelanggan'] == 'null' ? 'selected' : '' ?>>Umum</option>
                      <?php foreach ($pelanggan as $p => $data) { ?>
                        <option value="<?=$data->id_pelanggan?>" <?=@$post['pelanggan'] == $data->id_pelanggan ? 'selected' : ''?>><?=ucfirst($data->nama)?></option>
                      <?php }?>
                    </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                      <label class="col-sm-5 col-form-label text-center">Invoice</label>
                      <div class="col-sm-7">
                        <input type="text" value="<?=@$post['invoice']?>" name="invoice" class="form-control">
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
                  <th>Invoice</th>
                  <th>Tanggal</th>
                  <th>Pelanggan</th>
                  <th>Total</th>
                  <th>Diskon</th>
                  <th>Total Akhir</th>
                  <th width="200px">Tindakan</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = $this->uri->segment(3) ? $this->uri->segment(3) + 1 : 1 ;
                foreach($row->result() as $key => $data) {?>
                  <tr>
                    <td class="text-center"><?=$no++?></td>
                    <td><?=$data->invoice?></td>
                    <td class="text-center"><?=indo_date($data->tanggal)?></td>
                    <td class="text-center"><?=$data->id_pelanggan == null ? "Umum" : ucfirst($data->nama_pelanggan)?></td>
                    <td class="text-right"><?=indo_currency($data->total_harga)?></td>
                    <td class="text-right"><?=indo_currency($data->diskon)?></td>
                    <td class="text-right"><?=indo_currency($data->total_akhir)?></td>
                    <td class="text-center">
                        <button id="detail" data-toggle="modal" data-target="#modal-detail" 
                        data-invoice="<?=$data->invoice?>"
                        data-tanggal="<?=$data->tanggal?>"
                        data-waktu="<?=substr($data->penjualan_dibuat, 11, 5)?>"
                        data-pelanggan="<?=$data->id_pelanggan == null ? "Umum" : ucfirst($data->nama_pelanggan)?>"
                        data-total="<?=indo_currency($data->total_harga)?>"
                        data-diskon="<?=indo_currency($data->diskon)?>"
                        data-totalakhir="<?=indo_currency($data->total_akhir)?>"
                        data-bayar="<?=indo_currency($data->bayar)?>"
                        data-kembali="<?=indo_currency($data->kembali)?>"
                        data-catatan="<?=$data->catatan == "" ? "-" : $data->catatan?>"
                        data-kasir="<?=ucfirst($data->namapengguna)?>"
                        data-idpenjualan="<?=$data->id_penjualan?>"
                        class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Detail</button>

                        <a href="<?=site_url('penjualan/cetak/'.$data->id_penjualan)?>" target="_blank" class="btn btn-xs btn-primary">
                        <i class="fa fa-print"></i> Print</a>
                        <?php if($this->fungsi->user_login()->level == 1) { ?>
                        <a href="<?=site_url('penjualan/hapus/'.$data->id_penjualan)?>" id="btn-hapus" class="btn btn-xs btn-danger">
                        <i class="fa fa-trash"></i> Hapus</a>
                        <?php }?>
                    </td>      
                  </tr>
                <?php
                }?>
                  <tr class="text-right">
                    <th colspan="4">Total</th>
                    <td><?=indo_currency($sum->sum_total)?></td>
                    <td><?=indo_currency($sum->sum_diskon)?></td>
                    <td><?=indo_currency($sum->sum_akhir)?></td>
                    <td></td>
                  </tr>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>         
        </button>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered no-margin">
          <tbody>
            <tr>
              <th style="width: 20%">Invoice</th>
              <td style="width: 30%"><span id="invoice"></span></td>
              <th style="width: 20%">Pelanggan</th>
              <td style="width: 30%"><span id="pelanggan"></span></td>
            </tr>
            <tr>
              <th>Tanggal Jam</th>
              <td><span id="waktutanggal"></span></td>
              <th>Kasir</th>
              <td><span id="kasir"></span></td>
            </tr>
            <tr>
              <th>Total</th>
              <td><span id="total"></span></td>
              <th>Bayar</th>
              <td><span id="bayar"></span></td>
            </tr>
            <tr>
              <th>Diskon</th>
              <td><span id="diskon"></span></td>
              <th>Kembali</th>
              <td><span id="kembali"></span></td>
            </tr>
            <tr>
              <th>Total Akhir</th>
              <td><span id="totalakhir"></span></td>
              <th>Catatan</th>
              <td><span id="catatan"></span></td>
            </tr>
            <tr>
              <th>Produk</th>
              <td colspan="3"><span id="produk"></span></td>
            </tr>
          </tbody>
        </table>              
      </div>
    </div>
  </div>
</div>

<script>

  $(document).on('click','#detail', function(){
    $('#invoice').text($(this).data('invoice'))
    $('#pelanggan').text($(this).data('pelanggan'))
    $('#waktutanggal').text($(this).data('tanggal') + ' ' + $(this).data('waktu'))
    $('#kasir').text($(this).data('kasir'))
    $('#total').text($(this).data('total'))
    $('#bayar').text($(this).data('bayar'))
    $('#diskon').text($(this).data('diskon'))
    $('#kembali').text($(this).data('kembali'))
    $('#totalakhir').text($(this).data('totalakhir'))
    $('#catatan').text($(this).data('catatan'))

    var produk = '<table class="table no-margin">'
    produk += '<tr class="text-center"><th>Barang</th><th>Harga</th><th>Qty</th><th>Diskon</th><th>Total</th></tr>'
    $.getJSON('<?=site_url('laporan/produk_penjualan/')?>'+$(this).data('idpenjualan'), function(data){
      $.each(data, function(key, val) {
        produk += '<tr><td>'+val.nama+
        '</td><td class="text-right">'+val.harga+
        '</td><td class="text-center">'+val.qty+
        '</td><td class="text-right">'+val.diskon+
        '</td><td class="text-right">'+val.total+'</td></tr>'
      })
      produk += '</table>'
      $('#produk').html(produk)
    })
  })


</script>