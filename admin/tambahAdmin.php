<?php 
session_start();

if (!isset($_SESSION['login'])) {
	header("location: login.php");
	exit;
}

	require '../koneksi.php';
	$admin = query ("SELECT * FROM tb_admin");
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registrasi Admin</title>
</head>
<body>
	<h1>Registrasi Admin</h1>
	<a href="registrasi.php"><button type="submit" name="tambahadmin" class="tambahadmin">Tambah Admin</button></a>
 <table border="1" cellpadding="10" cellspacing="0">
 	
 		<tr>
 			<th>No.</th>
 			<th>Nama</th>
 			<th>Username</th>
 			<th>Password</th>
 			<th>Aksi</th>
 		</tr>
 		<?php $i = 1; ?>
 		<?php foreach ($admin as $row) : ?>
 			<tr>
 				<td><?php echo $i ?></td>
 				<td><?php echo $row["nama"]; ?></td>
 				<td><?php echo $row["username"]; ?></td>
 				<td><?php echo $row["password"]; ?></td>
 				<td>
 					<a href="ubahAdmin.php?id=<?php echo $row["id"]; ?>" class="btn_ubah">Ubah</a>
 					<a href="hapusAdmin.php?id=<?php echo $row["id"]; ?>" class="btn_hapus" onclick="return confirm('yakin?');">Hapus</a>
 				</td>
 			</tr>
 			<?php $i ++; ?>
 		<?php endforeach; ?>
 </table>
</body>
</html>