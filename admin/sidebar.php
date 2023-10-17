<?php 
	$us = $_SESSION['username'];
	$level = query ("SELECT * FROM tb_admin WHERE username = '$us'")[0];
?>
	<div class="sidebar">
		<div class="brand">
			<h1>Administrator</h1>
		</div>
		<ul>
			<li><a href="dashboard.php"><span>Dashboard</span></a></li>
			<li><a href="kelola.php"><span>Kelola Tempat Ibadah</span></a></li>

			<!-- otorisasi verifikasi data -->
			<?php if ($level['level'] === "SA") : ?>
				<li><a href="kelola-verify.php"><span>Validasi Data</span></a></li>
				
			<?php elseif ($level['level'] === "AD") : ?> 
				<li><a href="kelola-verify.php"><span> Menunggu Validasi</span></a></li>
			<?php endif; ?>

			<!-- otorisasi tambah admin -->
			<?php if ($level['level'] === "SA") : ?>
				<li>
					<a href="registrasi.php">Tambah Admin</a>
				</li>
			<?php endif; ?>
			<li><a href="logout.php">Log Out</a></li>
		</ul>	
	</div>