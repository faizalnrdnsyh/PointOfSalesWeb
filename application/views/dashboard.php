<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <!-- <li class="breadcrumb-item active"><a href="<?=site_url('dashboard')?>"><i class="fas fa-home"></i></a></li> -->
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?=$this->fungsi->hitung_barang()?></h3>

                  <p>Produk</p>
                </div>
                <div class="icon">
                  <i class="fas fa-archive"></i>
                </div>
                <a href="<?=site_url('barang')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?=$this->fungsi->hitung_pemasok()?></h3>

                  <p>Pemasok</p>
                </div>
                <div class="icon">
                  <i class="fas fa-truck"></i>
                </div>
                <a href="<?=site_url('pemasok')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?=$this->fungsi->hitung_pelanggan()?></h3>

                  <p>Pelanggan</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <a href="<?=site_url('pelanggan')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?=$this->fungsi->hitung_pengguna()?></h3>

                  <p>Pengguna</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
                <a href="<?=site_url('pengguna')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
            <!-- ./col -->

        <!-- AREA CHART -->
        <div class="card card-lightblue">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-chart-bar"></i> Pendapatan Harian 7 hari terakhir</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      <!-- BAR CHART -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-chart-bar"></i> Produk terlaris bulan ini</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">

              <p class="text-muted"><i class="fas fa-circle fa-xs"></i><small> Barang dalam satuan gram (bukan kemasan) tampil dalam satuan kilogram</small></p> 
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->



  </div>
</section>
<!-- /.content -->

<script>
  
$(function () {
    //-------------
    //- BAR CHART -
    //-------------
  var barChartData = {
      labels  : [<?php foreach ($product as $key => $data) {
        echo "'".$data->nama."',";
      } ?>],

      datasets: [
        {
          backgroundColor  : ['rgba(220, 53, 69, 1)',
                             'rgba(255, 193, 7, 1)',
                             'rgba(40, 167, 69, 1)',
                             'rgba(0, 123, 255, 1)',
                             'rgba(108, 117, 125, 1)',
                             'rgba(23, 162, 184, 1)',
                             'rgba(255, 133, 27, 1)',
                             'rgba(1, 255, 112, 1)',
                             'rgba(216, 27, 96, 1)',
                             'rgba(96, 92, 168, 1)'],
          pointRadius       : false,
          data              : [<?php foreach ($product as $key => $data) {
            echo "".$data->produk.",";} ?>]
        },
      ]
    }

  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChartData = jQuery.extend(true, {}, barChartData)
  var temp0 = barChartData.datasets[0]
  barChartData.datasets[0] = temp0

  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false,
    legend: {
        display: false
    },

    scales: {
        xAxes: [{
            // display: false,
            ticks: {
                fontSize: 8,
                callback: function (tick) {
                return tick.substring(0, 20);
            }
            }
        }],
    }
  }

  var barChart = new Chart(barChartCanvas, {
    type: 'bar', 
    data: barChartData,
    options: barChartOptions
  })

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : [<?php foreach ($sales as $key => $data) {
        echo "'".indo_date($data->tanggal)."',";
      } ?>],
      datasets: [
        {
          backgroundColor     : 'rgba(60, 141, 188, 0.3)',
          borderColor         : 'rgba(60, 141, 188, 1)',
          pointBackgroundColor: '#3c8dbc',
          lineTension         : false,
          data                : [<?php foreach ($sales as $key => $data) {
            echo "'".$data->omzet."',";} ?>]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },

      scales: {
        xAxes: [{
          gridLines : {
            // display : false,
          }
        }],

        yAxes: [{
          gridLines : {
            // display : false,
          },
          ticks: {

                    callback: function(label, index, labels) {
                        return 'Rp. '+label/1000000+' juta';
                    }
                },
        }],
      }
    }
       // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, { 
      type: 'line',
      data: areaChartData, 
      options: areaChartOptions
    })
})

    
</script>