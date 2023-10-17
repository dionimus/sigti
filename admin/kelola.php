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
$tempat_ibadah = query ("SELECT * FROM tb_tempat_ibadah WHERE verify = true"); 
$ti_admin = query ("SELECT * FROM tb_tempat_ibadah WHERE addBy = '$nama' AND verify = true");
$kategori = query ("SELECT * FROM tb_kategori");


// tombol cari di klik
	if (isset($_POST["cari"])) {
		$tempat_ibadah = cari ($_POST["keyword"]);
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>kelola data tempat ibadah</title>

		<!-- MyFonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

<!--Feather Icon-->
<script src="js/script.js" defer></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://kit.fontawesome.com/e22a92f17f.js" crossorigin="anonymous"></script>


<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/kelola.css?v=9.7">
</head>
<body>


<div class="container">
		<?php require "navbar-admin.php"; ?>
		<?php require "sidebar.php"; ?>

	<div id="kelola" class="kelola">
			<div class="title">
				<h2>Kelola Data</h2>
			</div>
			<div class="kategori">
				<?php foreach ($kategori as $row) : ?>
				<a href="tambahData.php?inisial=<?php echo $row["inisial"]; ?>"><?php echo $row["kategori"]; ?></a>
				<?php endforeach; ?>
			</div>
			
		<form action="" method="post" class="search">
			<input type="search" name="keyword" autofocus placeholder="Masukan Keyword" autocomplete="off">
			<button type="submit" name="cari">Cari</button>
		</form>
 		<table>
 		<thead>
 			<tr>
	 			<th class="tno">No.</th>
	 			<!-- <th class="tkode">Kode</th> -->
	 			<th class="tnama">Nama</th>
	 			<th class="talamat">Jalan</th>
	 			<th class="talamat">Kelurahan</th>
	 			<th class="talamat">Kecamatan</th>
	 			<th class="tdesc">Deskripsi</th>
	 			<th class="tkor">Longitude</th>
	 			<th class="tkor">Latitude</th>
	 			<th class="tfoto">Foto</th>
	 			<th class="add">Ditambah</th>
	 			<th class="edit">Diubah</th>
	 			<th class="taksi">Aksi</th>
 			</tr>
 		</thead>
 		<tbody>		
 			<?php if ($level['level'] ==='SA'): ?>
	 			<?php $i = 1; ?>
	 			<?php foreach ($tempat_ibadah as $row) : ?>
 			<tr>
 				<td class="tno"><?php echo $i ?></td>
 				
 				<td class="tnama"><?php echo $row["nama"]; ?></td>
 				<td class="tjalan"><?php echo $row["jalan"]; ?></td>
 				<td class="tkelurahan"><?php echo $row["kelurahan"]; ?></td>
 				<td class="tkecamatan"><?php echo $row["kecamatan"]; ?></td>
 				<td class="tdesc"><a href="modal.php?id=<?php echo $row["id"]; ?>" class="btn_modal">Detail</a></td>
 				<td class="tkor"><?php echo $row["longitude"]; ?></td>
 				<td class="tkor"><?php echo $row["latitude"]; ?></td>
 				<td class="tfoto"><img src="img/<?php echo $row["foto1"]; ?>" class='kelola-img'></td>
 				<td class="add"><?php echo $row["add"]; ?> / <?php echo $row["addBy"]; ?></td>
 				<td class="edit"><?php echo $row["edit"]; ?> / <?php echo $row["editBy"]; ?></td>
 				<td class="taksi">
 					<a href="ubah.php?id=<?php echo $row["id"]; ?>" class="btn_ubah">Ubah</a>
 					<a href="hapus.php?id=<?php echo $row["id"]; ?>" class="btn_hapus" onclick="return confirm('yakin?');">Hapus</a>
 				</td>
 			</tr>
 				<?php $i ++; ?>
 				<?php endforeach; ?>

 			<?php elseif ($level['level'] ==='AD') : ?>
 				<?php $i = 1; ?>
 				<?php foreach ($ti_admin as $row) : ?>
 			<tr>
 				<td class="tno"><?php echo $i ?></td>
 				
 				<td class="tnama"><?php echo $row["nama"]; ?></td>
 				<td class="tjalan"><?php echo $row["jalan"]; ?></td>
 				<td class="tkelurahan"><?php echo $row["kelurahan"]; ?></td>
 				<td class="tkecamatan"><?php echo $row["kecamatan"]; ?></td>
 				<td class="tdesc"><a href="modal.php?id=<?php echo $row["id"]; ?>" class="btn_modal">Detail</a></td>
 				<td class="tkor"><?php echo $row["longitude"]; ?></td>
 				<td class="tkor"><?php echo $row["latitude"]; ?></td>
 				<td class="tfoto"><img src="img/<?php echo $row["foto1"]; ?>" class='kelola-img'></td>
 				<td class="add"><?php echo $row["add"]; ?> / <?php echo $row["addBy"]; ?></td>
 				<td class="edit"><?php echo $row["edit"]; ?> / <?php echo $row["editBy"]; ?></td>
 				<td class="taksi">
 					<a href="ubah-ver.php?id=<?php echo $row["id"]; ?>" class="btn_ubah">Ubah</a>
 					<a href="hapus.php?id=<?php echo $row["id"]; ?>" class="btn_hapus" onclick="return confirm('yakin?');">Hapus</a>
 				</td>
 			</tr>
 				<?php $i ++; ?>
 				<?php endforeach; ?>
	 		<?php endif; ?>
	 			
 		
 		</tbody>
 		</table>




		</div>


	</div>

</div>




</body>
</html>