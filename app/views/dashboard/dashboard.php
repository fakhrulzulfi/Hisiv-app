<?php 
  if( !isset($_SESSION['user']) ) {
    header('Location: '.BASE_URL.'/login');
    exit;
  }
  require_once '../app/views/templates/header.php'; 
?>

    <div class="col-md-10 p-5 pt-2">
      <h3>
        <i class="fa fa-area-chart mr-2" aria-hidden="true"></i>Dashboard
      </h3>
      <hr>
      <div class="row text-white">

        <div class="card bg-info m-auto" style="width: 18rem;">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-clipboard mr-2" aria-hidden="true"></i>
            </div>
            <h5 class="card-title">Total Barang Masuk Bulan Ini</h5>
            <div class="display-4">
              <?php 
                if( is_null($data['total_product_in']['qty']) ) {
                  echo 0;
                } else {
                  echo $data['total_product_in']['qty'];
                }
              ?>
            </div>
            <a href="<?= BASE_URL; ?>/barang_masuk">
              <p class="card-text text-white">Lihat Detail<i class="fa fa-angle-double-right ml-1"
                  aria-hidden="true"></i>
              </p>
            </a>
          </div>
        </div>

        <div class="card bg-danger m-auto" style="width: 18rem;">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-home mr-2" aria-hidden="true"></i>
            </div>
            <h5 class="card-title">Jumlah Barang Keluar Bulan Ini</h5>
            <div class="display-4">
              <?php 
                if( is_null($data['total_product_out']['qty']) ) {
                  echo 0;
                } else {
                  echo $data['total_product_out']['qty'];
                }
              ?>
            </div>
            <a href="<?= BASE_URL; ?>/barang_keluar">
              <p class="card-text text-white">Lihat Detail<i class="fa fa-angle-double-right ml-1"
                  aria-hidden="true"></i>
              </p>
            </a>
          </div>
        </div>

        <div class="card bg-success m-auto" style="width: 18rem;">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-sitemap mr-2" aria-hidden="true"></i>
            </div>
            <h5 class="card-title">Jumlah Stock Barang Tersimpan</h5>
            <div class="display-4">
              <?php 
                if( is_null($data['total_product_stock']['stock']) ) {
                  echo 0;
                } else {
                  echo $data['total_product_stock']['stock'];
                }
              ?>
            </div>
            <a href="<?= BASE_URL; ?>/barang">
              <p class="card-text text-white">Lihat Detail<i class="fa fa-angle-double-right ml-1"
                  aria-hidden="true"></i>
              </p>
            </a>
          </div>
        </div>

        <div class="col-md-12 mt-5 justify-content-md-center">
          <div class="card">
            <div class="card-body">
              <h3 class="text-dark text-center"><b>Grafik Jumlah Barang Masuk & Keluar Setiap Bulan</h3>
              </p>
              <hr>
            </div>
            <div class="card-body">
              <canvas id="myChart"></canvas>
            </div>
          </div>
        </div>

      </div>

        <script script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

        <script type="text/javascript">
          var ctx = document.getElementById('myChart').getContext('2d');
          var chart = new Chart(ctx, {

            type: 'bar',

            data: {
              labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
              ],
              datasets: [{
                label: "Barang Masuk",
                backgroundColor: 'rgb(30, 144, 255)',
                borderColor: 'rgb(105, 105, 105)',
                data: [140, 130, 145, 160, 150, <?= $data['total_product_in']['qty']; ?>, 130, 190, 180, 120, 140, 145],
                borderWidth: 2,
                hoverBorderWidth: 3,
                hoverBorderColor: '#000'
              }, {
                label: "Barang Keluar",
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(105, 105, 105)',
                data: [150, 125, 115, 150, 148, <?= $data['total_product_out']['qty']; ?>, 130, 150, 179, 119, 130, 140],
                borderWidth: 2,
                hoverBorderWidth: 3,
                hoverBorderColor: '#000'
              }]
            },

            // Configuration options go here
            options: {}
          });
        </script>
<?php require_once '../app/views/templates/footer.php'; ?>

