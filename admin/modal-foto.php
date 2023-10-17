<?php 
   session_start();

if (!isset($_SESSION['login'])) {
	header("location: login.php");
	exit;
}

require "../koneksi.php";


$id = $_GET['id'];
$ti = query ("SELECT * FROM tb_tempat_ibadah WHERE id = $id")[0];
$foto = query ("SELECT * FROM tb_foto WHERE id_ti = $id");
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>modal
	</title>

<!--Feather Icon-->
<script src="js/script.js" defer></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://kit.fontawesome.com/e22a92f17f.js" crossorigin="anonymous"></script>


<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=4.7">

</head>
<body>
	<!--modal box detail start  -->
	<div id="item-detail-modal" class="modal">
		<div class="modal-container">
			<a href="kelola.php" class="close-icon"><i data-feather="x"></i></a>
			<div class="modal-content">
				<h3><?php echo $ti['nama']; ?></h3>
				<div class="modal-content-img">
					<?php foreach ($foto as $row) : ?>
						<div class="modal-img">
							<img src="img/<?php echo $row["foto"]; ?>">
						</div>
						<?php endforeach; ?>
					
				</div>
			</div>

		</div>

	</div>

	<!-- modal box detail end -->

	<script>
      feather.replace();
    </script>
</body>
</html>