<?php
session_start();

if (!isset($_SESSION['Login'])) { 
	
	header("Location: login.php");
	exit;
}


require 'functions.php';

// apakah tombol submit sudah ditekan ?
if (isset($_POST['tambah'])) {
	


	// apakah data berhasil ditambahkan ?
	if (tambah($_POST) > 0) {
		
		echo "<script>
		alert('Berhasil Menambahkan Data Baru');
		document.location.href = 'index.php';
		</script>";

	} else {
		echo "<script>
		alert('Data Gagal Ditambahkan');
			document.location.href = 'index.php';
		</script";
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Menambahkan Data</title>
	<link rel="stylesheet" type="text/css" href="CSS/reset.css">
	<link rel="stylesheet" type="text/css" href="CSS/add_style.css">
	<?php include 'icon.php'; ?>
</head>
<body>
	<h2>Input Database</h2>
	
<form action="" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend>Tambah Data Baru</legend>
	
	<table>
		<tr>
			<td>Username</td>
			<td colspan="2"><input type="text" name="nama" required autocomplete="off" autofocus placeholder="Masukkan Username" size="30"></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td colspan="3"><input value="Laki-Laki" type="radio" name="gender" required>Male <br>  <input value="Perempuan" type="radio" name="gender" required>Female <br>
			</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td colspan="2"><input type="text" name="alamat" required autocomplete="off" placeholder="Masukkan Alamat Anda" size="30"></td>
		</tr>
		<tr>
			<td>Upload Gambar</td>
			<td><input type="file" name="gambar" required></td>
		</tr>
		<tr>
			<td colspan="4">
				<button type="submit" name="tambah">Tambahkan</button>
			</td>
		</tr>
	</table>
	<a href="index.php">Kembali Ke Home</a>
</fieldset>
</form>
	
</body>
</html>