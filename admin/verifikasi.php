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
$verifiedBy = $nama ["nama"];

//apakah tombol submit sudah ditekan

if (verify ($id) > 0) {
	mysqli_query($koneksi, "UPDATE tb_tempat_ibadah 
        SET
            verifiedBy = '$verifiedBy'

        WHERE id = $id
        ");
	echo "
		<script>
		 alert ('data berhasil divalidasi')
		 document.location.href='kelola-verify.php'
		</script>
		";
	} else {
		echo "
		<script>
		 alert ('data gagal divalidasi')
		 document.location.href='kelola-verify.php'
		</script>
		";
}
 ?>		
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $ti ["id"]; ?>">
	<input type="hidden" name="verifiedBy" value="<?php echo $nama ["nama"]; ?>">

</form>
