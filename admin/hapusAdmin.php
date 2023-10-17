<?php 
// session_start()

// if (!isset($_SESSION['login'])) {
// 	header("location: login.php");
// 	exit;
// }

require "../koneksi.php";

$id = $_GET ["id"];

if (hapusadmin ($id) > 0) {
	echo "
		<script>
		 alert ('data berhasil dihapus')
		 document.location.href='tambahAdmin.php'
		</script>
		";
	} else {
		echo "
		<script>
		 alert ('data gagal dihapus')
		 document.location.href='tambahAdmin.php'
		</script>
		";
}

 ?>