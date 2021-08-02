<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dashboard</title>
	  <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>/css/style.css">

</head>

<body>
  <div class="row no-gutters">
    <div class="col-md-2 bg-dark pr-3 pt-4">
      <ul class="nav flex-column mb-3">
        <h1 class="display-3 text-white text-center mb-2 ">HISIV</h1>

        <div id="Profil" class="col text-white text-center">
          <hr class="bg-secondary">
          <img src="<?= BASE_URL; ?>/img/gd.jpg" style="width: 40%; border-radius: 50%; margin-bottom: 1em;">

          <a href="" data-toggle="modal" data-target="#ProfileModal" class="card-text text-white text-center mb-1">
          <p>Lihat Profil<i class="fa fa-angle-double-right ml-1" aria-hidden="true"></i></a>
          <hr class="bg-secondary">
        </div>

        <li class="nav-item">
          <a class="nav-link text-white" href="<?= BASE_URL; ?>/dashboard.php">
            <i class="fa fa-area-chart mr-2" aria-hidden="true"></i>Dashboard</a>
          <hr class="bg-secondary">
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="<?= BASE_URL; ?>/barang">
            <i class="fa fa-clipboard mr-2" aria-hidden="true"></i>Stok Barang</a>
          <hr class="bg-secondary">
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="<?= BASE_URL; ?>/barang_masuk">
            <i class="fa fa-plus-square mr-2" aria-hidden="true"></i>Barang Masuk</a>
          <hr class="bg-secondary">
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="<?= BASE_URL; ?>/barang_keluar">
            <i class="fa fa-minus-square mr-2" aria-hidden="true"></i>Barang Keluar</a>
          <hr class="bg-secondary">
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="" data-toggle="modal" data-target="#exampleModal1">
            <i class="fa fa-sign-out mr-2" aria-hidden="true"></i>keluar</a>
          <hr class="bg-secondary">
        </li>

      </ul>
    </div>
