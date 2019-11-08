<?php

require 'functions.php';

if (isset($_POST['input'])) {
	
	if (input($_POST) > 0) {
		echo "<script>
		alert('Akun Berhasil Dibuat');
		</script";

		header("Location: login.php");
		exit;
	} else {
		echo mysqli_error($conn);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Create An Account - By : D.S</title>
	<link rel="stylesheet" type="text/css" media="screen" href="CSS/dftr_style.css">
	<link rel="stylesheet" type="text/css" href="CSS/reset.css">
	<?php include 'icon.php'; ?>
</head>
<body>

	<h1>Create An Account</h1>

<form action="" method="post" enctype="multipart/form-data">

	<fieldset><legend>Create Your Account Now</legend>

	<table>
		<tr>
			<td>Nama Akun</td>
			<td><input id="input" type="text" name="username" size="40" autocomplete="off" autofocus placeholder="Masukkan Username" required></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td colspan="3"><input value="Laki-laki" type="radio" name="sex" required> Laki-laki  <br>
 	<input  value="Perempuan" type="radio" name="sex" required> Perempuan</td>
		</tr>
		<tr>
			<td>Tanggal Lahir</td>
			<td><input  id="input" type="date" name="tanggalLahir"  size="40"  required></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input id="input" type="email" name="email" size="40" autocomplete="off" placeholder="ex : google@gmail.com" required></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input id="input" type="password" name="password" size="40" placeholder="Masukkan Password" required maxlength="8"></td>
		</tr>
			<td>Konfirmasi Password</td>
			<td><input id="input" type="password" name="password2" size="40" placeholder="Ulangi Password" required></td>
		<tr>
			<td>Upload Foto Profil</td>
			<td><input type="file" name="foto" required></td>
		</tr>
		<tr>
			<td colspan="4">
				<input type="checkbox" name="agree" required>I Agree to Terms & Conditions</td>
		</tr>
		<tr>
			<td colspan="2">
				<button type="submit" name="input" onClick="return confirm ('Data Anda Akan Kami SIMPAN !! Selesai ?')">Daftar</button>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<p>Have An Account ? <a href="login.php">LOGIN</a></p>
			</td>
		</tr>
		<tr>
			<td colspan="3">
			<a href="index.php">Kembali Ke Halaman Login</a>
			</td>
		</tr>
	</table>
</fieldset>
</form>

</body>
</html>
