<?php 


require 'koneksi.php';
$kategori = query ("SELECT * FROM tb_kategori");

	?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tempat Ibadah</title>

<!-- MyFonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

<!--Feather Icon-->
	<script src="js/script.js" defer></script>
	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://kit.fontawesome.com/e22a92f17f.js" crossorigin="anonymous"></script>

<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=9.5">

</head>
<body>
	<!-- navbar start -->
	<?php require "header.php"; ?>
	<!-- navbar end -->


	<section id="menu" class="menu">
		<h2><span>Tempat </span>Ibadah</h2>
		<p>Tempat Ibadah enam agama besar di Indonesia yaitu Islam dengan Masjid, Katolik dan Protestan dengan Gereja, Hindu dengan Pura, Buddha dengan Vihara, serta Konghucu dengan Klenteng.</p>

		<div class="row">
			<?php foreach ($kategori as $row) : ?>
			<div class="menu-card">
				<a href="daftar.php?inisial=<?php echo $row["inisial"]; ?>">
					<img src="img/menu/<?php echo $row["gambar"]; ?>" alt="menu" class="menu-card-img">
					<h3 class="menu-card-title"><?php echo $row["kategori"]; ?></h3>
				</a>
			</div>
			<?php endforeach; ?>
		</div>
</section>


<!-- footer start-->
<?php require "footer.php"; ?>
<!-- footer end -->
<!-- feather icon -->
	<script>
		feather.replace()
	</script>
<!-- my javascript -->
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>