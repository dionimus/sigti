<?php 
session_start()
require "../koneksi.php";



if (!isset($_SESSION['login'])) {
	header("location: login.php");
	exit;
}


//apakah tombol submit sudah ditekan

// ambil data di URL
$id = $_GET["id"];

// query data tempat ibadash berdasarkan id
$admin = query ("SELECT * FROM tb_admin WHERE id = $id")[0];

if (isset ($_POST["submit"])) {

	if (ubahadmin ($_POST) > 0) {
		echo "
		<script>
		 alert ('data berhasil ditambahkan')
		 document.location.href='tambahAdmin.php'
		</script>
		";
	} else {
		echo "
		<script>
		 alert ('data gagal ditambahkan')
		 document.location.href='tambahAdmin.php'
		</script>
		";
	}
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ubah Data Admin</title>

<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
</head>
<body>
	<h1>Ubah Data Admin</h1>
	<div class="container-tambah-data">
		<form action="" method="post">
			<input type="hidden" name="id" value="<?php echo $admin ["id"]; ?>">
			<div class="input-group">
				<label>Nama</label>
				<input type="text" name="nama" id="nama" required value="<?php echo $admin ["nama"]; ?>">
			</div>
			<div class="input-group">
				<label>username</label>
				<input type="text" name="username" id="username" required value="<?php echo $admin ["username"]; ?>">
			</div>
			<div class="input-group">
				<label>password</label>
				<input type="text" name="password" id="password" required >
			</div>
			<div class="input-group">
				<label>konfirmasi</label>
				<input type="text" name="konfirmasi" id="konfirmasi" required >
			</div>
			<div>
				<button type="submit" name="submit" id="ubah">Ubah</button>
			</div>

	</form>
	</div>
</body>
</html>