<?php
session_start();

require 'functions.php';

// cek cookie

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ammbil username berdasarkan id

	$result = mysqli_query($conn,"SELECT username FROM identitas WHERE IdAccount = $id");

	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username

	if ( $key === hash('sha256', $row['username'])) {
		

		$_SESSION['Login'] = true;
	}

}

if ( isset($_SESSION['Login'])) {
	header("Location: index.php");
	exit;

}


// session aktif



if (isset($_POST['Login'])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];
 
	$hasil = mysqli_query($conn,"SELECT * FROM identitas WHERE username
		= '$username'");

	// cek username 
	
	if (mysqli_num_rows($hasil) === 1) {

		// cek passwordnya 

		$row = mysqli_fetch_assoc($hasil);
		 if ( password_verify($password,$row['password'])) {

		 	// set session 

		 	$_SESSION['Login'] = $username;

		 	// set cookie 

		 	if (isset($_POST['remember'])) {
		 		
		 		// buat cookie

		 		setcookie('id',$row['idAccount'],time() +60);
		 		setcookie('key',hash('sha256',$row['username']),time()+60);
		 	}

		 	header("Location: index.php");
			exit;
		 }
	}

		$error = true;
	
 } 
 	

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page - By : D.S</title>
	<?php include 'icon.php'; ?>
	<link rel="stylesheet" type="text/css" href="CSS/log_style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
</head>
<script src="https://maxcdn.bootstrapcdn.com/3.3.7/js/bootstrap.min.js">
</script>
<body style="background-color: #31f0f2">

	<div class="container">
		
		<form action="" method="post" id="form">
			<h2>Login Admin</h2>
			<?php if (isset($error)) : echo "<font color='red' size='1'>Username / Password Yang Anda Masukkkan Salah</font>"?>  
			<?php endif; ?><br>
			<!-- Username  -->
				<input type="text" name="username" size="45" required autocomplete="off" autofocus placeholder="Enter Your Username"> 			
				<!-- Password  -->
			 	<input type="Password" name="password" size="45" required placeholder="Your Password" maxlength="8"> <br> 
		<button type="submit" name="Login">Login</button> 
	<!--  onClick="confirm ('Aku Mau Kita PUTUS !!! Kamu JAHAT !!!')" -->
		<br><hr>
				
				<strong>Atau</strong>
			
			<div class="login1">
			<nav>
				<a href="index2.php" class="guest"><!-- <img src="thumbs/naruto.jpg" alt="Login Sebagai Guest"> -->
					<span>
						Login Sebagai Guest
					</span>
				</a> 
			</nav>
		</div>
			<p>
				Belum Punya Sebuah Akun ?? .Klik Disini (<a href="pendaftaran.php"><font color="red">
					 REGISTER 
				</a></font>)
			</p>
	</form>

	<div class="clear"></div>

</div>
</body>
</html>

