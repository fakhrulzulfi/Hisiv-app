<?php 
    if( !isset($_SESSION['user']) ) {
        header('Location: '.BASE_URL.'/login');
        exit;
    }

    require_once '../app/views/templates/header.php'; 
?>

    <div class="col-md-10 pt-3">

    <div class="container">
        <div class="shadow-sm p-3 mb-5 bg-light rounded border">
            <h3>
                <?= $data['title']['name']; ?>
            </h3>
        </div>
    </div>

	<div class="col-md-12 m-auto">
		<hr class="bg-dark">
		<h3 class="text-center text-dark">Barang Masuk</h3>
		<hr class="bg-dark">
	<table class="table text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jumlah Barang</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Supplier</th>
            </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($data['product_in'] as $barang) : ?>

                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $barang['name']; ?></td>
                    <td><?= $barang['qty']; ?></td>
                    <td><?= $barang['date']; ?></td>
                    <td><?= $barang['supplier']; ?></td>
                </tr>
                
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
        <hr>
        <?php if( empty($data['product_in']) ) : ?>
            <!-- KETIKA DATA KOSONG  -->
            <div class="alert alert-dark" role="alert">
                No Result Found.
            </div>
          <?php endif; ?>
    </div>

    <div class="col-md-12 m-auto">
    	<hr class="bg-dark">
    	<h3 class="text-center text-dark">Barang Keluar</h3>
    	<hr class="bg-dark">
	<table class="table text-center">
            <thead class="thead-dark">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jumlah Barang</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Harga</th>
            </tr>
            </thead>
            <tbody>
                <?php $j=1; foreach( $data['product_out'] as $product_out ) : ?>
                <tr>
                    <th scope="row"><?= $j; ?></th>
                    <td><?= $product_out['name']; ?></td>
                    <td><?= $product_out['qty']; ?></td>
                    <td><?= $product_out['date']; ?></td>
                    <td><?= $product_out['price']; ?></td>
                </tr>
                <?php $j++; endforeach; ?>
            </tbody>
        </table>
        <hr>
            <?php if( empty($data['product_out']) ) : ?>
                <!-- KETIKA DATA KOSONG  -->
                <div class="alert alert-dark" role="alert">
                    No Result Found.
                </div>
            <?php endif; ?>
        </div>
  </div>
<?php require_once '../app/views/templates/footer.php'; ?>
