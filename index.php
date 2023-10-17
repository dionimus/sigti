<?php 	
require 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Informasi Geogerafis Tempat Ibadah</title>

<!-- MyFonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

<!--Feather Icon-->
	<script src="js/script.js" defer></script>
	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://kit.fontawesome.com/e22a92f17f.js" crossorigin="anonymous"></script>

<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=5.5">

</head>
<body>
<!-- navbar start -->
	<?php require "header.php"; ?>
<!-- navbar end -->

<!-- hero section strat -->
<section class="hero" id="hero">
	<main class="content">
		<h1>Selamat Datang di <span>SIGTI.</span></h1>
		<p>Sistem Informasi Geografis Tempat Ibadah
		</p>
		<!-- <a href="#" class="cta">Lihat Detail</a> -->
	</main>
</section>
<!-- hero section end -->


<!-- footer start -->
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