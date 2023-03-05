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
              <li class="breadcrumb-item active">Barang</li>
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
              Data Barang
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a href="<?=site_url('barang/tambah')?>" class="btn btn-success">
                    <i class="fa fa-plus"></i> Tambah</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered text-center" id="table_barang">
              <thead>
                <tr>
                  <th>#</th>
                  <th width="100px">Barcode</th>
                  <th>Nama</th>
                  <th>Kategori</th>
                  <th>Satuan</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th width="150px">Tindakan</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach($cek as $i => $data) { ?>
               <input type="hidden" id="nama" value="<?=$data->nama?>">
               <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

<script>
  $(document).ready(function() {
    $('#table_barang').DataTable({
      "processing": true,
      "serverSide": true,
      "responsive": true,
      "autoWidth": false,
      "ajax": {
        "url" : "<?=site_url('barang/get_ajax')?>",
        "type" : "POST"
      },
      "columnDefs": [
        {
          "targets":[5, 6],
          "className": 'text-right'
        },
        {
          "targets":[2, 3],
          "className": 'text-left'
        },
        {
         "targets":[-1],
          "orderable": false
        }
      ]
    });

    
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
