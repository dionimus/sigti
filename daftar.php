<?php 

require 'koneksi.php';


// ambil inisial dari kategori
$inisial = $_GET["inisial"];


// lakukan pengambilan
$tempat_ibadah = query ("SELECT * FROM tb_tempat_ibadah WHERE inisial = '$inisial' AND verify = '1'");



$kategori = query ("SELECT * FROM tb_kategori WHERE inisial = '$inisial'")[0];



?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daftar Tempat Ibadah</title>
</head>

<!-- MyFonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

<!--Feather Icon-->
	<script src="js/script.js" defer></script>
	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://kit.fontawesome.com/e22a92f17f.js" crossorigin="anonymous"></script>

<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=9.0">

<body>
<?php require "header.php"; ?>

<!-- product section start -->
<section id="products" class="products">
	<h2><?php echo $kategori["kategori"]; ?></h2>
	<div class="row">

		<?php foreach ($tempat_ibadah as $row) : ?>
		<a href="detail.php?id=<?php echo $row["id"]; ?>">
		<div class="product-card">
			<div class="product-img">
				<img src="admin/img/<?php echo $row["foto1"]; ?>">
			</div>
			<div class="product-content">
				<h3><?php echo $row["nama"]; ?></h3> 
			</div>
			<div class="product-address">
				<?php echo $row["kecamatan"]; ?>
			</div>
		</div>
		</a>
		<?php endforeach; ?>

	</div>
</section>
<!-- produk section end -->


<?php require "footer.php"; ?>
<!-- feather icon -->
	<script>
		feather.replace()
	</script>
<!-- my javascript -->
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
