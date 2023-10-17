<?php 
require '../koneksi.php';
session_start();

if (!isset($_SESSION['login'])) {
	header("location: login.php");
	exit;
}

// ambil usernamse session
$us = $_SESSION['username'];
$level = query ("SELECT * FROM tb_admin WHERE username = '$us'")[0];
$nama = $level ['nama'];


// menampilkan daftar tempat ibadah
$kategori = query ("SELECT * FROM tb_kategori ORDER BY INISIAL ASC");

$tempat_ibadah = query ("SELECT * FROM tb_tempat_ibadah WHERE verify = true"); 
$ti_admin = query ("SELECT * FROM tb_tempat_ibadah WHERE addBy = '$nama' AND verify = true");
 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard Admin</title>

	<!-- MyFonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

<!--Feather Icon-->
<script src="js/script.js" ></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://kit.fontawesome.com/e22a92f17f.js" crossorigin="anonymous"></script>


<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=6.8">
	
</head>

<body>
	<div>
		<?php require "sidebar.php"; ?>
		<?php require "navbar-admin.php"; ?>
	</div>
	<div class="container">
		<div>
			<h2>Selamat Datang <span><?php echo $nama; ?></span></h2>
		</div>
		<div class="count">
			<div class="count-ti">
				<h3>Masjid</h3>
				<?php
				$count = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='MJ' AND verify=1";
				$sql = mysqli_query($koneksi, $count);
				$ver= mysqli_fetch_array($sql);
				$nocount = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='MJ' AND verify=0";
				$nosql = mysqli_query($koneksi, $nocount);
				$nover= mysqli_fetch_array($nosql);
				?>
				<P class="ver"><?php echo $ver['count']; ?></P>
				<P class="nover"><?php echo $nover['count']; ?></P>
			</div>
			<div class="count-ti">
				<h3>Gereja Katolik</h3>
				<?php
				$count = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='GK' AND verify=1";
				$sql = mysqli_query($koneksi, $count);
				$ver= mysqli_fetch_array($sql);
				$nocount = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='GK' AND verify=0";
				$nosql = mysqli_query($koneksi, $nocount);
				$nover= mysqli_fetch_array($nosql);
				?>
				<P class="ver"><?php echo $ver['count']; ?></P>
				<P class="nover"><?php echo $nover['count']; ?></P>
			</div>
			<div class="count-ti">
				<h3>Gereja Protestan</h3>
				<?php
				$count = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='GP' AND verify=1";
				$sql = mysqli_query($koneksi, $count);
				$ver= mysqli_fetch_array($sql);
				$nocount = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='GP' AND verify=0";
				$nosql = mysqli_query($koneksi, $nocount);
				$nover= mysqli_fetch_array($nosql);
				?>
				<P class="ver"><?php echo $ver['count']; ?></P>
				<P class="nover"><?php echo $nover['count']; ?></P>
			</div>
			<div class="count-ti">
				<h3>Pura</h3>
				<?php
				$count = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='PR' AND verify=1";
				$sql = mysqli_query($koneksi, $count);
				$ver= mysqli_fetch_array($sql);
				$nocount = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='PR' AND verify=0";
				$nosql = mysqli_query($koneksi, $nocount);
				$nover= mysqli_fetch_array($nosql);
				?>
				<P class="ver"><?php echo $ver['count']; ?></P>
				<P class="nover"><?php echo $nover['count']; ?></P>
			</div>
			<div class="count-ti">
				<h3>Vihara</h3>
				<?php
				$count = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='VH' AND verify=1";
				$sql = mysqli_query($koneksi, $count);
				$ver= mysqli_fetch_array($sql);
				$nocount = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='VH' AND verify=0";
				$nosql = mysqli_query($koneksi, $nocount);
				$nover= mysqli_fetch_array($nosql);
				?>
				<P class="ver"><?php echo $ver['count']; ?></P>
				<P class="nover"><?php echo $nover['count']; ?></P>
			</div>
			<div class="count-ti">
				<h3>Klenteng</h3>
				<?php
				$count = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='KL' AND verify=1";
				$sql = mysqli_query($koneksi, $count);
				$ver= mysqli_fetch_array($sql);
				$nocount = "SELECT COUNT(*) AS count FROM  tb_tempat_ibadah WHERE inisial='KL' AND verify=0";
				$nosql = mysqli_query($koneksi, $nocount);
				$nover= mysqli_fetch_array($nosql);
				?>
				<P class="ver"><?php echo $ver['count']; ?></P>
				<P class="nover"><?php echo $nover['count']; ?></P>
			</div>
		</div>
		<div >
			<a href="../index.php"><button class="btn-back">Kembali ke utama</button></a>
		</div>
		
	</div>
	
	

</body>
</html>