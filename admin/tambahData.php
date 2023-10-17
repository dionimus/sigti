<?php 
session_start();

if (!isset($_SESSION['login'])) {
	header("location: login.php");
	exit;
}

require "../koneksi.php";

// ambil inisial
$inisial = $_GET["inisial"];
$us = $_SESSION['username'];

$kategori = query ("SELECT * FROM tb_kategori WHERE inisial = '$inisial'")[0];
$nama = query ("SELECT * FROM tb_admin WHERE username = '$us'")[0];



// -----------------------------------------------------------------------------------------------

// mengambil kode dengan kode terbesar
		// $query = mysqli_query($koneksi, "SELECT MAX(id) AS kode_terbesar FROM tb_tempat_ibadah");
		// $hasil = mysqli_fetch_array($query);
		// $kode = $hasil['kode_terbesar'];
		// $id = $kode + 1;	

		// // ambil angka terbesar dari kode
		// $urutan = (int)substr($kode, 2, 3);
		// $urutan++;
		// $huruf = $kategori["inisial"];
		// $kodeti = $huruf . sprintf ('%03s', $urutan);

// ------------------------------------------------------------------------------------------------


//apakah tombol submit sudah ditekan
if (isset ($_POST["submit"])) {
	
	if (tambah ($_POST) > 0) {
		if (upload ($_POST) > 0) {
			
		}
			echo "
			<script>
			alert ('data berhasil ditambahkan')
			document.location.href='kelola.php'
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
	<title>Tambah Data Tempat Ibadah</title>


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
	<link rel="stylesheet" type="text/css" href="css/style.css?=3.5">
	
</head>
<body>
	<div class="container-tambah-data">
		<h1>Tambah Data Tempat Ibadah</h1>
		<form action="" method="post" enctype="multipart/form-data" id="formTambahData">
			<input type="hidden" name="id" id="id"  value="">
			<input type="hidden" name="inisial" id="inisial"  value="<?php echo $kategori["inisial"]; ?>">
			<div class="input-group">
				<input type="hidden" name="kode" id="kode" placeholder="Kode" required value="<?php echo $kodeti; ?>" readonly>
			</div>

			<div class="input-group">
				<input type="text" name="nama" id="nama" placeholder="Nama" required>
			</div>
			<div class="input-group-alamat">
				<div class="input-group-alamat">
					<select id="kecamatan" name="kecamatan">
					<option>-- pilih kecamatan --</option>

					<?php $kecamatan = query ("SELECT * FROM tb_kecamatan"); 
					?>
					<?php foreach ($kecamatan as $kec) : ?>
					<option value="<?php echo $kec["kecamatan"]; ?>"><?php echo $kec["kecamatan"]; ?></option>
					<?php endforeach; ?>
					</select>
							
				</div>
				<div class="input-group-alamat">
					<select id="kelurahan" name="kelurahan">
					<option>-- pilih kelurahan --</option>
					<option></option>
					</select>
				</div>
			</div>
			<div class="input-group-alamat-jalan">
				<textarea type="text" name="jalan" id="jalan" placeholder="Jalan" required></textarea>
			</div>
			<div class="input-group-desc">
				<textarea type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi" required></textarea>
			</div>
			<div class="input-group">
				<input type="text" name="longitude" id="longitue" placeholder="Longitude" required>
			</div>
			<div class="input-group">
				<input type="text" name="latitude" id="latitude" placeholder="Latitude" required>
			</div>

			<div class="input-group">
				<label>PilihFoto:</label>
				<input type="file" id="foto" name="foto[]"  onchange="preview()" multiple>
				<p id="number">No Files Chosen</p>
			</div>
			<div class="input-group-img">
				<div id="images"></div>
			</div>
			<input type="hidden" name="add" id="add"  value="<?php
					date_default_timezone_set('Asia/Jakarta');
					echo date('l, d F Y / H:i:s'); ?>">
			<input type="hidden" name="edit" id="edit"  value="-">
			<input type="hidden" name="addBy" id="addBy"  value="<?php echo $nama["nama"]; ?>">
			<input type="hidden" name="editBy" id="editBy"  value="-">
			<input type="hidden" name="verify" id="verify"  value="
			<?php if ($nama['level'] ==='SA') {
				echo "1";
			};?>">
			<input type="hidden" name="verifiedBy" id="verifiedBy"  value="
			<?php if ($nama['level'] ==='SA') {
				echo $nama['nama'];
			};?>">
			<div>
				<button type="submit" name="submit" id="tambahData">Simpan</button>
			</div>

	</form>
	</div>

<!-- script js -->
<script src="js/script.js"></script>
</body>
</html>  