<?php
session_start();

if (!isset($_SESSION['Login'])) { 
	
	header("Location: login.php");
	exit;
}


require 'functions.php';

// ambil data di url 

$id = $_GET['id'];

// query data mahasiswa 

$mhs = query("SELECT * FROM squad WHERE id = $id")[0];


// apakah tombol submit sudah ditekan ?
if (isset($_POST['ubah'])) {
	


	// apakah data berhasil ditambahkan ?
	if (ubah($_POST) > 0) {
		
		echo "<script>
		alert('Data Berhasil Diubah');
		document.location.href = 'index.php';
		</script>";

	} else {
		echo "<script>
		alert('Data Gagal Di Ubah');
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
	<link rel="stylesheet" type="text/css" href="CSS/edit_style.css">
	<?php include 'icon.php'; ?>
</head>
<body>
	<h2>Ubah Database</h2>

<form action="" method="post" enctype="multipart/form-data">

	<fieldset>
		<legend>
			Mengubah Database
		</legend>

	<input type="hidden" name="id" value="<?= $mhs['id']; ?>">
	<input type="hidden" name="gambarLama" value="<?= $mhs['gambar']; ?>">
	<table>
		<tr>
			<td>Nama User</td>
			<td><input class="send" type="text" name="nama" value="<?= $mhs['nama']; ?>" size="30"></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td colspan="3"><input value="<?= $mhs['gender']; ?>" type="radio" name="gender" required>Male <br>  <input value="<?= $mhs['gender']; ?>" type="radio" name="gender" required>Female <br>
			</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><input class="send" type="text" name="alamat" value="<?= $mhs['alamat']; ?>" size="30" ></td>
		</tr>
		<tr>
			<td>Upload Gambar</td>
			<td colspan="2"><img width="100" src="img/<?= $mhs['gambar']; ?>"> <br><br> <input type="file" name="gambar"></td>
							
		</tr>
		<tr>
			<td colspan="4">
				<button type="submit" name="ubah">EDIT</button>
			</td>
		</tr>
	</table>
</fieldset>
</form>
	<!-- <a href="index.php">Kembali Ke Home</a> -->
</body>
</html>