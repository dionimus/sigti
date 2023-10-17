<?php 
require "koneksi.php";

// ambil data di URL
$id = $_GET['id'];

// query data tempat ibadash berdasarkan id
$ti = query ("SELECT * FROM tb_tempat_ibadah WHERE id = $id")[0];
$foto = query ("SELECT * FROM tb_foto WHERE id_ti = $id");

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Detail</title>
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
	<link rel="stylesheet" type="text/css" href="css/style.css?v=4.3">

<body>
<!-- navbar start -->
	<?php require "header.php"; ?>
<!-- navbar end -->

<section id="about" class="about">
	<div class="row">
		<!-- -----------------gambar--------------- -->
		<div class="about-img">
			<?php foreach ($foto as $row) : ?>
			<div class="imgslide">
                <img src="admin/img/<?php echo $row ["foto"]; ?>" alt="<?php echo $ti ["nama"]; ?>">
            </div>	
			<?php endforeach; ?>
			<a class="prev" onClick="nextslide(-1)">&#10094;</a>
            <a class="next" onClick="nextslide(1)">&#10095;</a> 
		</div>
		<div class="page">
            
        </div>
		<!-- -------------------------------------- -->
		<div class="content">
			<h3><?php echo $ti ["nama"]; ?></h3>
			<p class="creator">Creator: <?php echo $ti ["add"];?> / <?php echo $ti ["addBy"];?></p>
			<label>Jalan</label>
			<p class="alamat"><?php echo $ti ["jalan"]; ?></p>
			<label>Kelurahan</label>
			<p class="alamat"><?php echo $ti ["kelurahan"]; ?></p>
			<label>Kecamatan</label>
			<p class="alamat"><?php echo $ti ["kecamatan"]; ?></p>
			<label>Kabupaten/Kota</label>
			<p class="alamat">Kota Pontianak</p>
			<label>Provinsi</label>
			<p class="alamat">Kalimantan Barat</p>
		</div>
	</div>
</section>

<!-- section deskripsi -->
<section class="deskripsi">
	<div class="row">
			<h3>Deskripsi</h3>
			<p><?php echo $ti["deskripsi"]; ?></p>
		</div>
</section>
	<section id="contact" class="contact">
		<h2><span>Peta </span>Wilayah</h2>
		<div class="row">
			<div id="map" class="map">
			</div>
			<script>
					function initMap() {

						let	mapOptions = {
							center: new google.maps.LatLng('<?php echo $ti["latitude"]; ?>', '<?php echo $ti["longitude"]; ?>'),
							zoom: 17
						}
						var map = new google.maps.Map(document.getElementById('map'), mapOptions);

						var marker=new google.maps.Marker({
					      position: new google.maps.LatLng('<?php echo $ti["latitude"]; ?>', '<?php echo $ti["longitude"]; ?>'),
					      map: map
					      });
					}
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbBuLE9zDjPvm7YVxsFf9sPi9HDDIi0w&callback=initMap"></script>
		</div>
	</section>
<!-- footer start -->
<?php require "footer.php"; ?>
<!-- footer end -->

<!-- feather icon -->
	<script>
		feather.replace()
	</script>
<!-- my javascript -->
<script type="text/javascript" src="js/script.js"></script>


<!---------------------script slide gambar--------------->
<script>
        var slideIndex = 1;
            showSlide(slideIndex);

        function nextslide(n){
            showSlide(slideIndex += n);
        }

        // function dotslide(n){
        //     showSlide(slideIndex = n);
        // }

        function showSlide(n) {
            var i;
            var slides = document.getElementsByClassName("imgslide");
            
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length;
            }
            for (i = 0; i < slides.length; i++) {
                
                slides[i].style.display = "none";
            }

            slides[slideIndex - 1].style.display = "block";
            


        }
    </script>
</body>
</html>
    