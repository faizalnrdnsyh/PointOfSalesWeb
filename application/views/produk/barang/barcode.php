    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><i class="fas fa-home"></i></li>
              <li class="breadcrumb-item">Barang</li>
               <li class="breadcrumb-item active">Barcode</li>
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
             Barcode <?=ucfirst($row->nama)?>
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a href="<?=site_url('barang')?>" class="btn btn-warning">
                    <i class="fa fa-chevron-left"></i> Kembali</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="card-body text-center">
            <?php
            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128, 3, 100)) . '"style="width:300px">';
            ?><br>
            <?=$row->barcode?><br><br>
            <a href="<?=site_url('barang/cetak_barcode/'.$row->id_barang)?>" target="_blank" class="btn btn-sm btn-default">
            <i class="fa fa-print"></i> Print</a>
          </div>
        </div>
      </div>
    </section>
