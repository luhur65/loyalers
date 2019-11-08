<?php

session_start();
if (isset($_SESSION['Login'])) {
 unset ($_SESSION);
 session_destroy();
 
  echo "<script>
  	alert('Log Out Berhasil');
  </script>";
} 
// destroy cookie
setcookie ('id','', time() -3600);
setcookie('key','',time() -3600);

  header("Location: login.php");
  exit;

?>