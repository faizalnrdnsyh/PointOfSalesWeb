    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-home"></i></li>
              <li class="breadcrumb-item">Transaksi</li>
              <li class="breadcrumb-item active">Penjualan</li>
            </ol>
       	  </div>
      </div>
    </section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
  	
    <div class="row"> 
      <div class="col-lg-4">
        <div class="card" style="height: 160px">
          <div class="card-body">
          	<table width="100%">
          		<tr>
          			<td >
          			<label for="tanggal">Tanggal</label>
          			</td>
          			<td>
						<input type="tanggal" id="tanggal" name="tanggal" value="<?=date('Y-m-d')?>" class="form-control">
          			</td>
          		</tr>
          		<tr>
          			<td>
          			<label for="kasir">Kasir</label>
          			</td>
          			<td>
						<input type="text" id="kasir" value="<?=$this->fungsi->user_login()->nama?>" class="form-control" readonly>
          			</td>
          		</tr>
          		<tr>
          			<td >
          			<label for="pelanggan">Pelanggan</label>
          			</td>
          			<td>
						<select id="pelanggan" name="pelanggan" class="form-control custom-select">
							<option value="">Umum</option>
  
            <?php foreach($pelanggan as $plgn => $value) {
                echo '<option value="'.$value->id_pelanggan.'">'.$value->nama.'</option>';
              } ?>

						</select>
          			</td>
          		</tr>
          	</table>
          </div>
        </div>
      </div>
    
    <div class="col-lg-4">
        <div class="card" style="height: 160px">
          <div class="card-body">
          	<table width="100%">
          		<tr>
          			<td>
          				<label for="barcode">Barcode</label>
          			</td>
          			<td>
    						<div class="input-group"> 
                  <input type="hidden" id="id_barang">
                  <input type="hidden" id="harga">
                  <input type="hidden" id="stok">
                  <input type="hidden" id="qty_keranjang">
                  <div class="input-group">
                    <input type="text" id="barcode" class="form-control"  autofocus>
                    <div class="input-group-append" >
                      <button type="button" class="btn btn-info input-group-btn" data-toggle="modal" data-target="#modal-barang"> 
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
    						</div>
    					</td>
          		</tr>
          		<tr>
          			<td>
          			<label for="qty">Qty</label>
          			</td>
          			<td>
						<input type="number" id="qty" value="1" min="1" class="form-control">
          			</td>
          		</tr>
          		<tr>
          			<td >
          			
          			</td>
          			<td>
						<button  type="button" class="btn btn-primary" id="tambah_keranjang">
						<i class="fas fa-shopping-cart"></i> Tambah</button>
          			</td>
          		</tr>
          	</table>
          </div>
        </div>
      </div>
    
     <div class="col-lg-4">
        <div class="card" style="height: 160px">
          <div class="card-body">
          	<div align="right">
          		<h4>Invoice <b><span id="invoice"><?=$invoice?></span></b></h4>
          		<h1><b><span id="grand_total2" style="font-size: 45pt">0</span></b></h1>
          	</div>
          </div>
        </div>
      </div>
    
	</div>
	<!-- row -->

	<div class="row">
     
      <div class="col-lg-12">
        <div class="card table-responsive">
          <div class="card-body">
          	<table width="100%" class="table table-striped table-bordered text-center">
          		<thead>
	          		<tr>
	          			 <th width="50px">#</th>
	          			 <th width="200px">Barcode</th>
	          			 <th>Barang</th>
	          			 <th width="130px">Harga</th>
	          			 <th width="80px">Qty</th>
	          			 <th width="130px">Diskon</th>
	          			 <th width="130px">Total</th>
	          			 <th width="160px">Tindakan</th>
	          		</tr>
          		</thead>
          		<tbody id="tabel_keranjang">
                <?php $this->view('transaksi/penjualan/keranjang_data')?>
          		</tbody>
          	</table>
          </div>
        </div>
      </div>
    
	</div>
	<!-- row -->

	<div class="row">
     
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
          	<table width="100%">
          		<tr>
          			<td>
          			<label for="subtotal">Subtotal</label>
          			</td>
                <td width="10px"></td>
          			<td>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
						<input type="number" id="subtotal" value="0" min="0" class="form-control" readonly>
        	</div>
                </td>
          		</tr>
          		<tr>
          			<td>
          			<label for="discount">Diskon</label>
          			</td>
                <td width="10px"></td>
          			<td>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
						<input type="number" id="diskon" value="0" min="0" class="form-control">
          </div>
                </td>
          		</tr>
          		<tr>
          			<td >
          			<label for="grand_total">Total</label>
          			</td>
                <td width="10px"></td>
          			<td>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
						<input type="number" id="grand_total" value="0" min="0" class="form-control" readonly>
          </div>
                </td>
          		</tr>
          	</table>
          </div>
        </div>
      </div>
    
    <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
          	<table width="100%">
          		<tr>
          			<td >
          			<label for="bayar">Bayar</label>
          			</td>
                <td width="10px"></td>
          			<td>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
						<input type="number" id="bayar" value="0" min="0" class="form-control">
          </div>
          			</td>
          		</tr>
          		<tr>
          			<td>
          			<label for="kembalian">Kembali</label>
          			</td>
                <td width="10px"></td>
          			<td>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
						<input type="number" id="kembalian" value="0" min="0"  class="form-control" readonly>
          </div>
          			</td>
          		</tr>
          	</table>
          </div>
        </div>
      </div>
    
     <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
          	<table width="100%">
          		<tr>
          			<td for=catatan style="vertical-align: top">
          				<label>Catatan</label>
          			</td>
              </tr>
              <tr>
          			<td>
          				<textarea type="text" id="catatan" name="catatan" class="form-control"></textarea>
          			</td>
          		</tr>
          	</table>
          </div>
        </div>
      </div>

      <div class="col-lg-2">
        <div>
          <table width="100%">
            <tr>
              <td >
                <button class="btn btn-block btn-danger btn-sm" id="batal_transaksi"><i class="fas fa-undo"></i> Batal</button>
              </td>
            </tr><td></td><tr>
              <td>
                <button class="btn btn-block btn-success btn-lg" id="proses_pembayaran"><i class="fas fa-credit-card"></i> Proses</button>
              </td>
            </tr>
          </table>
        </div>
      </div>
    
	</div>
	<!-- row -->
	</div>
</section>

<!-- Modal Tambah Barang -->
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
        <table class="table table-striped table-bordered text-center" id="table1">
          <thead>
            <tr>
              <th>Barcode</th>
              <th>Barang</th>
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
                      <button class="btn btn-outline-info btn-xs" id="pilih"
                        data-id="<?=$data->id_barang?>"
                        data-harga="<?=$data->harga?>"
                        data-stok="<?=$data->stok?>"
                        data-barcode="<?=$data->barcode?>">
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

<!-- Modal Ubah Barang -->
<div class="modal fade show" id="modal-ubah-barang">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah Produk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>         
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idkeranjang">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label" for="barang">Barang</label>
            <div class="col-sm-4">
              <input type="text" id="barcode_barang" class="form-control" readonly>
            </div>
            <div class="col-sm-5">
              <input type="text" id="nama_barang" class="form-control" readonly>
            </div>    
        </div>
         <div class="form-group row">
          <label class="col-sm-3 col-form-label" for="harga_barang">Harga</label>
          <div class="col-sm-9 input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input type="number"  min="1" id="harga_barang" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label" for="qty_barang">Qty</label>
            <div class="col-sm-3">
              <input type="number" min="1" id="qty_barang" class="form-control">
            </div> 
          <label class="col-sm-2  offset-sm-1 col-form-label" for="stok_barang">Stok</label>
            <div class="col-sm-3">
              <input type="number" id="stok_barang" class="form-control" readonly="">
            </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label" for="total_awal">Total Awal</label>
          <div class="col-sm-9 input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input type="number" id="total_awal" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label" for="diskon_barang">Diskon</label>
          <div class="col-sm-9 input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp</span>
              </div>
            <input type="text" id="diskon_barang" class="form-control">
          </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="total_barang">Total</label>
            <div class="col-sm-9 input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp</span>
                </div>
                <input type="number" class="form-control" id="total_barang">
            </div>
          </div>
      </div>

      <div class="modal-footer">
        <div>
          <button type="button" id="simpan_ubah_keranjang" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
//Tambah keranjang
  $(document).on('click','#pilih', function(){
    $('#id_barang').val($(this).data('id'))
    $('#harga').val($(this).data('harga'))
    $('#stok').val($(this).data('stok'))
    $('#barcode').val($(this).data('barcode'))
    $('#modal-barang').modal('hide')
    get_qty_keranjang($(this).data('barcode'))
  })

  function get_qty_keranjang(barcode){
    $('#tabel_keranjang tr').each(function() {
      var qty_keranjang = $("#tabel_keranjang td.barcode:contains('"+barcode+"')").parent().find("td").eq(4).html()

      if(qty_keranjang != null){
        $('#qty_keranjang').val(qty_keranjang)  
      } else {
        $('#qty_keranjang').val(0)  
      }
      
    })
  }

  $(document).on('click','#tambah_keranjang', function(){
    var id_barang = $('#id_barang').val()
    var harga = $('#harga').val()
    var stok = $('#stok').val()
    var qty = $('#qty').val()
    var qty_keranjang = $('#qty_keranjang').val()

    if(id_barang == ''){
      swal({
        type: "warning",
        title: "Produk belum diplih",
        onAfterClose: $('#barcode').focus()
      })
    } else if(stok < 1 || (parseInt(stok) - parseInt(qty_keranjang)) < parseInt(qty)){
      swal({
        type: "warning",
        title: "Qty melebihi stok tersedia",
        onAfterClose: $('#qty').focus()
      })
      $('#qty').val(stok-qty_keranjang)
    } else {
      $.ajax({
        type: 'POST',
        url: '<?=site_url('penjualan/proses')?>',
        data: {
          'tambah_keranjang' : true,
          'id_barang' : id_barang,
          'harga' : harga,
          'qty' : qty},
        dataType: 'json',
        success: function(result){
          if(result.success == true){
            $('#tabel_keranjang').load('<?=site_url('penjualan/keranjang_data')?>', function(){
              kalkulasi()
            })
            $('#id_barang').val('')
            $('#harga').val('')
            $('#barcode').val('')
            $('#qty').val('1')
            $('#stok').val('')
            $('#barcode').focus()
          } else {
            swal("Gagal tambah keranjang", "", "error")
          }
        }
      })
    }
  })

//Hapus keranjang
$(document).on('click','#hapus_keranjang', function(){
  var total = $('#grand_total').val()
  var id_keranjang = $(this).data('id')
  if (total > 0){
    swal({
      title: "Yakin menghapus barang ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Hapus!",
      cancelButtonText: "Tidak",
      closeOnConfirm: true,
    },
    function(isConfirm) {
      if (isConfirm) {
          $.ajax({
            type: 'POST',
            url:'<?=site_url('penjualan/hapus_keranjang')?>',
            data: {'id_keranjang' : id_keranjang},
            dataType: 'json',
            success: function(result){
              if(result.success == true){
                $('#tabel_keranjang').load('<?=site_url('penjualan/keranjang_data')?>', function(){
                  kalkulasi()
                })
              } 
            }
          })
      }
    });
  } else {
    swal({
        type: "warning",
        title: "Belum ada produk yang dipilih",
        onAfterClose: $('#barcode').focus()
    })
  }
 })

//Ubah keranjang
  $(document).on('click','#ubah_keranjang', function(){
    $('#idkeranjang').val($(this).data('id'))
    $('#stok_barang').val($(this).data('stok'))
    $('#barcode_barang').val($(this).data('barcode'))
    $('#nama_barang').val($(this).data('barang'))
    $('#harga_barang').val($(this).data('harga'))
    $('#qty_barang').val($(this).data('qty'))
    $('#total_awal').val($(this).data('qty') * $(this).data('harga'))
    $('#diskon_barang').val($(this).data('diskon_barang'))
    $('#total_barang').val(($(this).data('harga') - $(this).data('diskon_barang'))* $(this).data('qty'))
  })

  function hitung_ubah(){
    var harga = $('#harga_barang').val()
    var qty = $('#qty_barang').val()
    var diskon_barang = $('#diskon_barang').val()

    total_awal = harga * qty
    $('#total_awal').val(total_awal)

    total = (harga - diskon_barang) * qty
    $('#total_barang').val(total)

    if(diskon_barang < 0){
      $('#diskon_barang').val(0)
    }
  }

  $(document).on('keyup mouseup', '#harga_barang, #qty_barang, #diskon_barang', function(){
    hitung_ubah()
  })

  function hitung_diskon(){
    var harga = $('#harga_barang').val()
    var qty = $('#qty_barang').val()
    var total = $('#total_barang').val()

    diskon_barang = harga - (total / qty)
    $('#diskon_barang').val(diskon_barang)

  }

  $(document).on('keyup mouseup', '#total_barang', function(){
    hitung_diskon()
  })

  function hitung_qty(){
    var harga = $('#harga_barang').val()
    var total_awal = $('#total_awal').val()
    var diskon_barang = $('#diskon_barang').val()

    qty = total_awal / harga
    $('#qty_barang').val(qty)

    total = (harga - diskon_barang) * qty
    $('#total_barang').val(total)

  }

  $(document).on('keyup mouseup', '#total_awal', function(){
    hitung_qty()
  })

 $(document).on('click','#simpan_ubah_keranjang', function(){
  var id_keranjang = $('#idkeranjang').val()
  var harga = $('#harga_barang').val()
  var qty = $('#qty_barang').val()
  var diskon_barang = $('#diskon_barang').val()
  var total = $('#total_barang').val()
  var stok = $('#stok_barang').val()

  if(harga == '' || harga < 1){
    swal({
        type: "warning",
        title: "Harga tidak boleh kosong",
        onAfterClose: $('#harga_barang').focus()
    })
  } else if(qty == '' || qty < 1){
    swal({
        type: "warning",
        title: "Qty tidak boleh kosong",
        onAfterClose: $('#qty_barang').focus()
    })
  } else if(parseInt(qty) > parseInt(stok)){
    swal({
        type: "warning",
        title: "Qty melebihi stok tersedia",
        onAfterClose: $('#qty_barang').focus()
    })
     $('#qty_barang').val(stok)

  } else {
    if(diskon_barang == ''){
      $('#diskon_barang').val(0)
    }
    $.ajax({
      type: 'POST',
      url: '<?=site_url('penjualan/proses')?>',
      data: {
        'simpan_ubah_keranjang' : true,
        'id_keranjang' : id_keranjang,
        'harga' : harga,
        'qty' : qty,
        'diskon': diskon_barang,
        'total' : total },
      dataType: 'json',
      success: function(result){
        if(result.success == true){
          $('#tabel_keranjang').load('<?=site_url('penjualan/keranjang_data')?>', function(){
            kalkulasi()
          })
          $('#modal-ubah-barang').modal('hide')
        } else {
          swal({
              type: "warning",
              title: "Barang di keranjang tidak terubah",
              showConfirmButton: false,
              timer: 1500,
              onAfterClose: $('#modal-ubah-barang').modal('hide')
          })
          
        }
      }
    })
  }
})

function kalkulasi(){
  var subtotal = 0
  $('#tabel_keranjang tr').each(function(){
    subtotal += parseInt($(this).find('#total').text())
  })
  isNaN(subtotal) ? $('#subtotal').val(0) : $('#subtotal').val(subtotal)

  var diskon = $('#diskon').val()
  var grand_total = subtotal - diskon

  if(isNaN(grand_total)){
    $('#grand_total').val(0)
    $('#grand_total2').text(0)
  } else {
    $('#grand_total').val(grand_total)
    $('#grand_total2').text(grand_total)
  }

  var bayar = $('#bayar').val()
  bayar != 0 ? $('#kembalian').val(bayar - grand_total) : $('#kembalian').val(0)

  if(diskon < 0){
    $('#diskon').val(0)
  }
  if(bayar < 0){
    $('#bayar').val(0)
  }
}

$(document).ready(function(){
  kalkulasi()
})

$(document).on('keyup mouseup', '#diskon, #bayar', function(){
  kalkulasi()
})

//Proses pembayaran
 $(document).on('click','#proses_pembayaran', function(){
  var id_pelanggan = $('#pelanggan').val()
  var subtotal = $('#subtotal').val()
  var diskon = $('#diskon').val()
  var grandtotal = $('#grand_total').val()
  var bayar = $('#bayar').val()
  var kembali = $('#kembalian').val()
  var catatan = $('#catatan').val()
  var tanggal = $('#tanggal').val()

  if(subtotal < 1){
    swal({
        type: "warning",
        title: "Belum ada produk yang dipilih",
        onAfterClose: $('#barcode').focus()
    })
  } else if(bayar == '' || bayar < 1){
    swal({
        type: "warning",
        title: "Uang pembayaran belum diinput",
        onAfterClose: $('#bayar').focus()
    })
  } else if(kembali < 0){
    swal({
        type: "warning",
        title: "Jumlah uang pembayaran kurang",
        onAfterClose: $('#bayar').focus()
    })
  } else {
    if(diskon == ''){
      $('#diskon').val(0)
    }
    // if(confirm('Yakin proses transaksi ini ?')){
      // swal({
      // title: "Yakin proses transaksi ini ?",
      // type: "warning",
      // showCancelButton: true,
      // confirmButtonClass: "btn-primary",
      // confirmButtonText: "Ya, Proses",
      // cancelButtonText: "Tidak",
      // closeOnConfirm: true,
      // },
      // function(isConfirm) {
      //   if (isConfirm) {
            $.ajax({
            type: 'POST',
            url: '<?=site_url('penjualan/proses')?>',
            data: {
              'proses_pembayaran' : true,
              'id_pelanggan' : id_pelanggan,
              'subtotal' : subtotal,
              'diskon': diskon,
              'grandtotal' : grandtotal,
              'bayar' : bayar,
              'kembali' : kembali,
              'catatan' : catatan,
              'tanggal' : tanggal
            },
            dataType: 'json',
            success: function(result){
              if(result.success){
                swal({
                    title: "Transaksi Berhasil",
                    text: "Cetak nota?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Cetak",
                    cancelButtonText: "Tidak",
                    closeOnConfirm: true,
                    closeOnCancel: true
                  },
                  function(isConfirm) {
                    if (isConfirm) {
                      var popup = window.open('<?=site_url('penjualan/cetak/')?>' + result.id_penjualan, '_blank')
                      popup.blur();
                    } 
                    window.focus('<?=site_url('penjualan')?>')
                    location.href='<?=site_url('penjualan')?>'
                  });
              } else {
                swal("Transaksi Gagal", "", "error")
              }
              
            }
            })
      //    }
      // });
  }
})

 //Proses batal
 $(document).on('click','#batal_transaksi', function(){
  var total = $('#grand_total').val()
  if (total > 0){
    swal({
      title: "Yakin membatalkan transaksi?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, batal!",
      cancelButtonText: "Tidak",
      closeOnConfirm: true,
    },
    function(isConfirm) {
      if (isConfirm) {
         $.ajax({
          type: 'POST',
          url: '<?=site_url('penjualan/hapus_keranjang')?>',
          data: { 'batal_transaksi' : true },
          dataType: 'json',
          success: function(result){
            if(result.success == true){
              $('#tabel_keranjang').load('<?=site_url('penjualan/keranjang_data')?>', function(){
                kalkulasi()
              })
              $('#pelanggan').val('').change()
              $('#id_barang').val('')
              $('#harga').val('')
              $('#barcode').val('')
              $('#qty').val('1')
              $('#diskon').val(0)
              $('#bayar').val(0)
              $('#catatan').val('')
              $('#barcode').focus()
            }
          }
        })
      }
    });
  } else {
    swal({
        type: "warning",
        title: "Belum ada produk yang dipilih",
        onAfterClose: $('#barcode').focus()
    })
  }
 })

// barcode scanner enter
 $('#barcode').keypress(function(e){
  var key = e.which
  var barcode = $(this).val()
  if(key == 13){
    if(barcode == ''){
      swal({
        type: "warning",
        title: "Produk belum diplih",
        onAfterClose: $('#barcode').focus()
      })
    }
    else{
      $.ajax({
        type: 'POST',
        url: '<?=site_url('penjualan/get_barang')?>',
        data: {
          'barcode' : barcode},
        dataType: 'json',
        success: function(result){
          if(result.success == true){
            $('#id_barang').val(result.barang.id_barang)
            $('#harga').val(result.barang.harga)
            $('#stok').val(result.barang.stok)
            $('#barcode').val(barcode)
            
            $('#tambah_keranjang').click()
          } else {
            swal({
                type: "error",
                title: "Produk tidak ditemukan",
                onAfterClose: $('#barcode').focus()
            })
            $('#barcode').val('')
           
          }
        }
      })
    }
  }
 })


</script>

