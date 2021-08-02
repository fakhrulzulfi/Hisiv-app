<?php 
	if( isset($_SESSION['user']) ) {
		header('Location: '.BASE_URL);
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>/css/login.css">
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>/css/style.css">
</head>
<body>
	<div class="container">
		<!-- FLASH MESSAGE -->
		<!-- <div class="row">
			<div class="col-md-10">
				<?php Flasher::flashLogin(); ?>
			</div>  
		</div> -->
		<form action="<?= BASE_URL; ?>/login/verify" method="POST">
		<h1>Login</h1>
			<div class="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type="text" id="Username" name="username" placeholder="Username" required>
			</div>
            <div class="textbox">
            	<i class="fa fa-lock" aria-hidden="true"></i>
            	<input type="password" id="password" name="password" placeholder="Password" required>
            </div>
           <button type="submit" name="submit" class="btn">Log In</button>
		</form>
	</div>
</body>
</html>