<?php 
	require "../koneksi.php";
	$id = $_POST['id_kec'];
?>
	<option>-- pilih kelurahan --</option>
	<?php $kelurahan = query ("SELECT * FROM tb_kelurahan WHERE idKec ='$id'"); ?>
	<?php foreach ($kelurahan as $kel) : ?>
	<option value="<?php echo $kel["kelurahan"]; ?>"><?php echo $kel["kelurahan"]; ?></option>
	<?php endforeach; ?>

