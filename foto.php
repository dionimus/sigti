<?php 

require "koneksi.php";

$host = "localhost";
$user = "root";
$pass = "";
$db = "sigti";

$koneksi = new mysqli($host, $user, $pass, $db);

if (isset ($_POST["submit"])) {

	$fileCount = count ($_FILES['foto']['name']);
		for ($i=0; $i < $fileCount ; $i++) { 

			$namaFile = $_FILES['foto']['name'][$i];
    		$ukuranFile = $_FILES['foto']['size'][$i];
   			$error = $_FILES['foto']['error'][$i];
  			$tmpName = $_FILES['foto']['tmp_name'][$i];

			// apkah tidak ada gambar yang diupload
			if ($error===4) {
			        echo "<script>
			            alert('Pilih gambar terlebih dahulu')
			        </script>";
			        return false;
			    }


			//cek apakah yang diupload adalah gambar
			    $ekstensiGambarValid = ['jpg','png','jpeg','webp'];
			    $ekstensiGambar = explode('.', $namaFile);
			    $ekstensiGambar = strtolower(end($ekstensiGambar));
			    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
			        echo "<script>
			            alert('format gambar tidak sesuai')
			        </script>";
			        return false;
			    }

			// cek ukuran gambar
			    // if ($ukuranFile > 500) {
			    //     echo "<script>
			    //         alert('ukuran gambar terlalu besar')
			    //     </script>";
			    //     return false;
			    // }

   			// lolos pengeckan gambar

			// generate nama baru
			    $namaFileBaru = uniqid();
			    $namaFileBaru .= '.';
			    $namaFileBaru .= $ekstensiGambar;

				move_uploaded_file($tmpName, 'img/'. $namaFileBaru);

  			$sql = "INSERT INTO tb_foto VALUES (
				'','$namaFileBaru',1 
				)";


		if ($koneksi -> query($sql) === TRUE) {
				echo "file upload succsess";
			} else {
				echo 'ERORR';
			}
	}
}
		
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>
 		foto
 	</title>
 </head>
 <body>
 		<form action="" method="post" enctype="multipart/form-data" id="formTambahData">
 			<input type="file" name="foto[]" multiple>
 			<button type="submit" name="submit">simpan</button>
 		</form>
 </body>
 </html>