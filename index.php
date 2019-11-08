
<?php

// Memulai Session
session_start();

if (!isset($_SESSION['Login'])) { 
	
	header("Location: login.php");
	exit;
}


require 'functions.php';

// ambil data dari database 

$squad = query("SELECT * FROM squad");

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
	<link rel="stylesheet" type="text/css" href="CSS/dex_style.css">

</head>
<body>
<div id="header">
	<div id="header-container">
		<nav>
			<a class="current" href="index.php">Home</a>
			<a href="tambah.php">Tambah Data</a>
			<a href="logout.php" onClick="return confirm ('Anda Yakin Mau Keluar?')">Log Out</a>
		</nav>
	</div>
</div>
<h2>Halaman Administrator</h2>
	<br>
<form action="" method="post">
			
			<input type="text" name="keyword" size="50" autocomplete="off" placeholder="Masukkan Identitas Data User" autofocus>
			<button type="submit" name="cari">GO</button>
			
		</form>
	<div class="data">
	
	<table border="2" cellspacing="0" cellpadding="7">
		<tr>
		<th>No.</th>
		<th>Action</th>
		<th>Image</th>
		<th>Nama User</th>
		<th>Jenis Kelamin</th>
		<th>Alamat</th>
		</tr>

		<?php $i = 1;  ?>
		<?php foreach( $squad as $row ) : ?>
		<tr>
			<td><?= $i; ?></td>
			<td>
				<a href="ubah.php?id=<?= $row["id"]; ?>">EDIT</a> |
				<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Admin Yakin ?');">DELETE</a>
			</td>
			<td><a hreflang="id" href="#">
				<img src="img/<?= $row["gambar"]; ?>" width="100"></a>
			</td>
			<td><?= $row["nama"]; ?></td>
			<td><?= $row["gender"]; ?></td>
			<td><?= $row["alamat"]; ?></td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>

		<div class="clear"></div>
	</table>
</div>

<footer>
		<div id="connect">
			<strong>ConnectAdmin :</strong>
				<a href="https://facebook.com/Adiknya.Situmorang"><img src="thumbs/fb.PNG"/></a>
				<a href="https://instagram.com/dharma_situmorang"><img src="thumbs/logo-IG.jpg"></a>
		</div>
</footer>
</body>
</html>