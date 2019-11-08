<?php

require 'functions.php';


// ambil data dari database

// // pagination 
// // konfigurasi

// $jumlahDataPerHalaman = 10;
// $jumlahData = count(query("SELECT * FROM squad"));
// $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

// $halamanAktif =  ( isset( $_GET['halaman'])) ? $_GET['halaman'] : 1;

$squad = query("SELECT * FROM squad ");

// search form

if (isset($_POST["cari"])) {
	
	$squad = cari($_POST["keyword"]);
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Just4FUN | D.S</title>
	<?php include 'icon.php'; ?>
	<link rel="stylesheet" type="text/css" href="CSS/dex_style_guest.css">
	<style> 

		@media print {
			#header, .form-cari, h2 {
				display: none;
			}
		}

	</style>
</head>
<body>
<div id="header">
	<div id="header-container">
		<nav>
			<a class="current" href="index.php">Home</a>
			<a href="pendaftaran.php">Buat Akun</a>
			<a href="login.php">Login Admin</a>
		</nav>
	</div>
</div>

	<h2>Halaman Guest</h2>

		<form action="" method="post" class="form-cari">
			<center>
			<input type="text" name="keyword" size="50" autocomplete="off" placeholder="Masukkan Identitas Data User" autofocus>
			<button type="submit" name="cari">GO</button>
			</center>
		</form>



	<div class="data">

	<table border="2" cellspacing="0" cellpadding="10">
		<tr>
		<th>No.</th>
		<th>Gambar</th>
		<th>Nama User</th>
		<!-- <th>Jenis Kelamin</th> -->
		<th>Alamat</th>
		</tr>

		<?php $i = 1;  ?>
		<?php foreach( $squad as $row ):?>
		<tr>
			<td><?= $i; ?></td>
			<td>
				<a hreflang="id" href="img/<?= $row["gambar"]; ?>">
				<img src="img/<?= $row["gambar"]; ?>" width="100">
			</a>
			</td>
			<td><?= $row["nama"]; ?></td>
			<!-- <td> <?= $row["gender"]; ?> </td> --> 
			<td><?= $row["alamat"]; ?></td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>
	</table>
	<?= "<h3>*Halaman ini hanya bagi Guest(Tamu) Kecuali jika Anda 
login Sebagai Administrator !!!</h3>"; ?>
	<?= "<h3>*Jika Ada Error Atau Bermasalah Dengan Web Silakan Chat Ke Admin Dibawah Ini Contactnya !!!</h3>"; ?>

</div>

<footer>
		<div id="connect">
			<strong>Talk With Admin :</strong>
				<a href="https://facebook.com/Adiknya.Situmorang"><img src="thumbs/fb.PNG"/></a>
				<a href="https://instagram.com/dharma_situmorang"><img src="thumbs/logo-IG.jpg"></a>
		</div>
</footer>
</body>
</html>