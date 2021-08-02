<?php 
  if( !isset($_SESSION['user']) ) {
    header('Location: '.BASE_URL.'/login');
    exit;
  }
  require_once '../app/views/templates/header.php' 

?>
    <div class="col-md-10 p-5 pt-2">
      <div class="row">
        <div class="col-md-10">
          <?php Flasher::flash(); ?>
        </div>  
      </div>
      <h3>
        <i class="fa fa-minus-square mr-2" aria-hidden="true"></i>Daftar Barang Keluar
      </h3>
      <hr>

      <a href="#" data-toggle="modal" data-target="#Tambah-barang-keluar"><button type="button" class="btn btn-primary justify-content-center mb-3"><i class="fa fa-minus mr-2"></i>Tambah Barang Keluar</button></a>

      <div class="row mb-3">
        <div class="col-sm-10">
          <form action="<?= BASE_URL; ?>/barang_keluar/cari" method="POST">
            <div class="row">
              <div class="col-sm-3">
                <select name="bulan" id="bulan" class="form-control">
                    <option value="<?= date('m'); ?>" selected>Bulan Sekarang</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
              </div>
              <div class="col-sm-8">
                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Keyword">
              </div>
              <div class="col-sm-1">
                <button type="submit" class="btn btn-outline-secondary">Cari</button>
              </div>
            </div>
          </form>
        </div>
        
        <div class="col-sm-2">
          <a href="<?= BASE_URL; ?>/barang_keluar/laporan" class="btn btn-outline-secondary ml-3">
            <i class="fa fa-print mr-2" aria-hidden="true"></i>Print
          </a>
        </div>
        
      </div>

      <table class="table text-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Jumlah Barang</th>
            <th scope="col">Tanggal Keluar</th>
            <th scope="col">Harga</th>
            <th scope="col">Pengaturan</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach( $data['product_out'] as $product_out ) : ?>
          <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $product_out['name']; ?></td>
            <td><?= $product_out['qty']; ?></td>
            <td><?= $product_out['date']; ?></td>
            <td><?= $product_out['price']; ?></td>
            <td>
              <a href="<?= BASE_URL; ?>/detail_barang/<?= $product_out['product_id']; ?>" class="btn btn-outline-primary">Detail</a>
              <a href="<?= BASE_URL; ?>/barang_keluar/hapus/<?= $product_out['product_out_id']; ?>/<?= $product_out['product_id']; ?>/<?= $product_out['qty']; ?>" class="btn btn-outline-danger">Hapus</a>
            </td>
          </tr>
          <?php $i++; endforeach; ?>
        </tbody>
      </table>
      <hr>
      <?php if( empty($data['product_out']) ) : ?>
         <!-- KETIKA PENCARIAN KOSONG  -->
          <div class="alert alert-dark" role="alert">
            No Result Found.
          </div>
      <?php endif; ?>
    </div>

<!-- MODAL FORM BARANG KELUAR -->
  <div class="modal fade" id="Tambah-barang-keluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLongTitle">Tambah Barang Keluar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="<?= BASE_URL; ?>/barang_keluar/keluar" method="POST">
            <label for="identifier_product">Nama Barang</label>
            <div class="form-group">
              <select class="custom-select" id="identifier_product" name="identifier_product">
                <option selected disabled>Pilih Nama Barang</option>
                <?php foreach( $data['product'] as $namaBarang ) : ?>
                  <option value="<?= $namaBarang['id']; ?>"><?= $namaBarang['name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            
            <div class="form-group">
              <label for="price">Harga Barang</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan Harga Barang..." required>  
            </div>

            <div class="row">
              <div class="form-group col-md-7 mr-auto">
                <label for="jumlah_barang">Jumlah Barang</label>
                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="Masukkan Jumlah Barang..." required>
              </div>
              
              <div class="form-group col-md-5 ml-auto">
                <label for="tanggal">Tanggal Keluar</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
              </div>
            </div>

            <div class="row">
              <div class="col"></div>
              <button type="submit" class="btn btn-danger text-white mt-3 mr-3">
                <i class="fa fa-floppy-o mr-2" aria-hidden="true"></i>Tambah
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php require_once '../app/views/templates/footer.php' ?>
