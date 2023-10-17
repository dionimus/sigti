<?php 
session_start();


require "../koneksi.php";


$us = $_SESSION['username'];
$level = query ("SELECT * FROM tb_admin WHERE username = '$us'")[0];	


if (!isset($_SESSION['login'])) {
	header("location: login.php");
	exit;
} elseif ($level['level'] !== "SA") {
	header("location: login.php");
	exit;
}

//apakah tombol submit sudah ditekan


if (isset ($_POST["regis"])) {


	if (regis ($_POST) > 0) {
		echo "
		<script>
		 alert ('data berhasil ditambahkan')
		 document.location.href='dashboard.php'
		</script>
		";
	} else {
		echo "
		<script>
		 alert ('data gagal ditambahkan')
		 document.location.href=''
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
	<title>Registrasi Admin</title>

<!-- MyFonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

	<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<div class="container-registrasi">
		<h1>Registrasi Admin</h1>	
		<form action="" method="post">
					<div class="input-group">
						<select id="level" name="level">
							<option>-- pilih level admin --</option>
							<?php $level = query ("SELECT * FROM tb_level_admin"); 
							?>
							<?php foreach ($level as $lev) : ?>
							<option value="<?php echo $lev["level"]; ?>"><?php echo $lev["keterangan"]; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="input-group">
						<input type="text" name="nama" id="nama" placeholder="nama" required>
					</div>
					<div class="input-group">
						<input type="text" name="username" id="username" placeholder="username" required>
					</div>
					<div class="input-group">
						<input type="password" name="password" id="password" placeholder="Password" required>
					</div>
					<div class="input-group">
						<input type="password" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password" required>
					</div>
					<button type="submit" name="regis" class="regis">Register</button>
		</form>
	</div>
	</section>

</body>
</html>