<?php

// Koneksi Ke database 

$conn = mysqli_connect("sql109.epizy.com","epiz_24658790","444PxLeqsrZNHcS","epiz_24658790_users");
mysqli_select_db($conn,"epiz_24658790_users");

function query($query) {
	global $conn;
	$result = mysqli_query($conn,$query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}

	return $rows;

}

function input($data) {
	global $conn;

	$username = strtolower(stripslashes($data['username']));
	$sex = addslashes(strip_tags($data['sex']));
	$tanggalLahir = addslashes(strip_tags($data['tanggalLahir']));
	$email = addslashes(strip_tags(stripslashes($data['email'])));
	$password = mysqli_real_escape_string($conn,$data['password']);
	$password2 = mysqli_real_escape_string($conn,$data['password2']);
	$foto = addslashes(strip_tags($data['foto']));

	// cek username sudah terdaftar atau belom ?

	$result = mysqli_query($conn,"SELECT username FROM identitas WHERE username = '$username'");

	if ( mysqli_fetch_assoc($result) ) {
		
		echo "<script>
		alert('Username Sudah Terdaftar . Harap Ganti Username Anda!');
		</script>";

		return false;

	}

	// cek konfirmasi password

	if ($password !== $password2) {
		echo "<script>
		alert('Konfirmasi Password Tidak Sesuai');
		</script";

		return false;
	}

	// enkrypsi password 

	$password = password_hash($password, PASSWORD_DEFAULT);
	// var_dump($password);

	// menambahkan user ke database

	mysqli_query($conn,"INSERT INTO identitas VALUES ('','$tanggalLahir','$sex','$username','$email','$password','$foto')");

	return mysqli_affected_rows($conn);


}

 
function tambah($data) {

	global $conn;

	$nama = htmlspecialchars($data['nama']);
	$gender = htmlspecialchars($data['gender']);
	$alamat = htmlspecialchars($data['alamat']);
	
	// upload gmbr 

	$gambar = upload();
	if ( !$gambar ) {

		return false;

	}

	$query = "INSERT INTO squad 
					VALUES
					('','$nama','$gender','$alamat','$gambar')";

	mysqli_query($conn,$query);

	return mysqli_affected_rows($conn);
} 

function cari($keyword) {

	$query = "SELECT * FROM squad WHERE 

				nama LIKE '%$keyword%' OR
				gender LIKE '%$keyword%' OR
				alamat LIKE '%$keyword%' 
				";

			return query($query);
}

function upload() {
	
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah ada gambar diupload 

	if ( $error === 4) {
		echo "<script>
		alert('Gambar Belum Di Upload');
		</script>";

		return false;
	}

	// cek apakah gyg diupload adalah gambar 

	$ekstensiGambarValid = ['JPG','JPEG','PNG','png','jpg','jpeg','gif'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if ( !in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
		alert('Anda Bukan Mengupload gambar');
		</script>";

	}
	// cek jika ukurannya besar 

	if ($ukuranFile > 2000000 ) {
		echo "<script>
		alert('Ukuran Gambar Terlalu Besar');
		</script>";

	}

	// lolos pengecekan gambar siap di upload 

	// generate nama baru 

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.' ;
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

	return $namaFileBaru;

}

function hapus($id)  {

	global $conn;

	mysqli_query ( $conn , "DELETE FROM squad WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function ubah($data) {

	global $conn;

	$id = $data['id'];
	$nama = htmlspecialchars($data['nama']);
	$gender = htmlspecialchars($data['gender']);
	$alamat = htmlspecialchars($data['alamat']);
	$gambarLama = htmlspecialchars($data['gambarLama']);

	global $gambar;
	
	// upload gmbr 
 	if ( $_FILES['gambar'] === 4) {
 		$gambar === $gambarLama;
 	} else {
 		$gambar = upload();
 	}

	$query = "UPDATE squad SET
					nama = '$nama',
					gender = '$gender',
					alamat = '$alamat',
					gambar = '$gambar'
				WHERE id = $id
					";

	mysqli_query($conn,$query);

	return mysqli_affected_rows($conn);
} 


?>

<?php

// Jangan Coba  Coba Mengganti Code2 Diatas 
// Tanpa Anda Ketahui artinya Itu Semua 
// Jika Anda Telah Merubahnya 
// Pasti Sistem Akan Mendeteksi Error 

?>