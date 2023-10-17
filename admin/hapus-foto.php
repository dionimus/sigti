<?php 
session_start();

if (!isset($_SESSION['login'])) {
	header("location: login.php");
	exit;
}

require "../koneksi.php";

$id = $_GET ["id"];

$query = mysqli_query($koneksi, "SELECT id_ti AS it FROM tb_foto WHERE id=$id");
$hasil = mysqli_fetch_array($query);
$kode = $hasil['it'];

if (hapusfoto ($id) > 0) {
	header("location: ubah.php?id=$kode");
	exit;
	} 
	
 ?>