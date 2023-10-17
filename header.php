<?php 


// tombol cari di klik
	if (isset($_POST["cari"])) {
		$keyword = $_POST["keyword"];
		header("location: daftar-search.php");
		}
?>
		

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>header</title>

<!-- MyFonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

<!--Feather Icon-->
	<script src="js/script.js" defer></script>
	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://kit.fontawesome.com/e22a92f17f.js" crossorigin="anonymous"></script>

<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<nav class="navbar">
		<a href="#" class="navbar-logo">SIG<span>TI</span>.</a>

		<div class="navbar-nav">
			<a href="index.php">Beranda</a>
			<a href="tempat-ibadah.php">Tempat Ibadah</a>
			<a href="about.php">Tentang</a>
		</div>
		<div class="navbar-extra">
			<a href="#" id="search-button"><i data-feather="search"></i></a>
			<a href="admin/login.php" id="admin"><i data-feather="user"></i></a>
			<a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
		</div>
<!-- search form start -->
		
		<div class="search-form">
			<form action="daftar-search.php" method="post">
				<input type="search" id="search-box" name="keyword" placeholder="Cari....">
				<label for="search-box" name="cari"><i data-feather="search" ></i></label>
			</form>	
		</div>
		
<!-- search form end -->
	</nav>


<!-- feather icon -->
	<script>
		feather.replace()
	</script>
<!-- my javascript -->
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>