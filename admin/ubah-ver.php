<?php 
   session_start();

if (!isset($_SESSION['login'])) {
	header("location: login.php");
	exit;
}

   
require "../koneksi.php";


// ambil data di URL
$id = $_GET['id'];
$us = $_SESSION['username'];

// query data tempat ibadash berdasarkan id
$ti = query ("SELECT * FROM tb_tempat_ibadah WHERE id = $id")[0];
$nama = query ("SELECT * FROM tb_admin WHERE username = '$us'")[0];

//apakah tombol submit sudah ditekan
if (isset ($_POST["submit"])) {

	if (ubahver ($_POST) > 0) {
			if (ubahUpload ($_POST) > 0) {

		}
		echo "
		<script>
		 alert ('data berhasil diubah')
		 document.location.href='kelola.php'
		</script>
		";
	} else {
		echo "
		<script>
		 alert ('data gagal diubah')
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
	<title>Ubah Data Tempat Ibadah</title>

<!-- script JQuery -->
<script src="js/jquery.js"></script>

<script>
	$(document).ready(function() {
		$('#kecamatan').change(function() {
			var kecamatan_id = $(this).val();

			$.ajax ({
				type:'POST',
				url: 'alamat.php',
				data: 'id_kec='+kecamatan_id,
				success: function(response) {
					$('#kelurahan').html(response);
				}
			});

		});
	});
</script>

<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/style.css?=5.7">
	
</head>
<body>
	
	<div class="container-tambah-data">
		<h1>Ubah Data Tempat Ibadah</h1>
		<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id_ti" value="<?php echo $ti ["id"]; ?>">
			<input type="hidden" name="inisial" value="<?php echo $ti ["inisial"]; ?>">
			
			<div class="input-group">
				<label>Nama</label>
				<input type="text" name="nama" id="nama" required value="<?php echo $ti ["nama"]; ?>">
			</div>

			<div class="input-group-alamat">
				<div class="input-group-alamat">
					<select id="kecamatan" name="kecamatan">
					<option><?php echo $ti["kecamatan"]; ?></option>

					<?php $kecamatan = query ("SELECT * FROM tb_kecamatan"); 
					?>
					<?php foreach ($kecamatan as $kec) : ?>
					<option value="<?php echo $kec["kecamatan"]; ?>"><?php echo $kec["kecamatan"]; ?></option>
					<?php endforeach; ?>
					</select>
							
				</div>
				<div class="input-group-alamat">
					<select id="kelurahan" name="kelurahan">
					<option><?php echo $ti["kelurahan"]; ?></option>
					<option></option>
					</select>
				</div>
			</div>


			<div class="input-group-alamat-jalan">
				<label>Alamat</label>
				<input type="text" name="jalan" id="jalan" required value="<?php echo $ti ["jalan"]; ?>">
			</div>
			<div class="input-group-desc">
				<label>Deskripsi</label>
				
				<textarea type="text" name="deskripsi" id="deskripsi" required ><?php echo $ti ["deskripsi"]; ?></textarea>
			</div>
			<div class="input-group">
				<label>Longitude</label>
				<input type="text" name="longitude" id="longitude" required value="<?php echo $ti ["longitude"]; ?>">
			</div>
			<div class="input-group">
				<label>Latitude</label>
				<input type="text" name="latitude" id="latitude" required value="<?php echo $ti ["latitude"]; ?>">
			</div>
			
			<!-- foto start -->
				<?php foreach ($foto as $ft) : ?>
			<div class="input-group">
				<img src="img/<?php echo $ft ["foto"];?>" id='ubah-img'>
				<input type="hidden" name="fotolama[]" value="<?php echo $ft ["foto"];?>">
				<input type="hidden" name="id[]" value="<?php echo $ft ["id"];?>">
				<input type="file" name="fotoubah[]">
				<a href="hapus-foto.php?id=<?php echo $ft["id"]; ?>" class="btn_hapus_x" onclick='window.location.reload();'>X</a>
			</div>
			<?php endforeach; ?>
			
			<div class="input-group">
				<input type="file" id="foto" name="foto[]"  onchange="preview()" multiple>
				<p id="number">No Files Chosen</p>
			</div>
			<div class="input-group-img">
				<div id="images"></div>
			</div>
			<!-- foto end -->

			<input type="hidden" name="count" value="<?php echo $count;?>">

			<input type="hidden" name="add" id="add"  value="<?php echo $ti ["add"]; ?>">
			<input type="hidden" name="edit" id="edit"  value="<?php
					date_default_timezone_set('Asia/Jakarta');
					echo date('l, d F Y / H:i:s'); ?>">
			<input type="hidden" name="addBy" id="addBy"  value="<?php echo $ti ["addBy"]; ?>">
			<input type="hidden" name="editBy" id="editBy"  value="<?php echo $nama ["nama"]; ?>">
			<div>
				<button type="submit" name="submit" id="ubah">Ubah</button>
			</div>

	</form>
	</div>
	<script src="js/script.js"></script>
</body>
</html>