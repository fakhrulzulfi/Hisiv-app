
<?php 
  if( !isset($_SESSION['user']) ) {
    header('Location: '.BASE_URL.'/login');
    exit;
  }
  require_once '../app/views/templates/header.php'; 
?>

    <div class="col-md-10 p-5 pt-2">
      <h3>
      	<i class="fa fa-clipboard mr-2" aria-hidden="true"></i>Stok Barang
      </h3>
      <hr>

      <div class="input-group mb-3">
      <div class="col-sm-10">
          <form action="<?= BASE_URL; ?>/barang/cari" method="POST">
            <div class="row">
              <div class="col-sm-11">
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Keyword">
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-outline-secondary">Cari</button>
              </div>
            </div>
          </form>
        </div>
        
        <div class="col-sm-2">
          <a href="<?= BASE_URL; ?>/barang/laporan" class="btn btn-outline-secondary ml-3">
            <i class="fa fa-print mr-2" aria-hidden="true"></i>Print
          </a>
        </div>
      </div>


      <table class="table text-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Pengaturan</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $i = 1;
            foreach($data['product'] as $product) : 
          ?>
          <tr>
            <td><?= $i; ?></td>  
            <td><?= $product['name']; ?></td>
            <td><?= $product['stock']; ?></td>
            <td>
              <a href="<?= BASE_URL; ?>/detail_barang/<?= $product['id']; ?>" class="btn btn-outline-primary">Detail</a>  <!-- harusnya masuk ke listnya Barang masuk! -->
              
              <?php if( $product['stock'] < 50 ) : ?>
                <span class="badge badge-danger" data-toggle="tooltip" data-placement="bottom" title="Barang Hampir Habis">!</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php
            $i++; 
            endforeach; 
          ?>
        </tbody>
      </table>
      <hr>
      <?php if( empty($data['product']) ) : ?>
         <!-- KETIKA PENCARIAN KOSONG  -->
          <div class="alert alert-dark" role="alert">
            No Result Found.
          </div>
      <?php endif; ?>
    </div>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>

<?php require_once '../app/views/templates/footer.php'; ?>
