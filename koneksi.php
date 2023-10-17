<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sigti";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// if (mysqli_connect_errno()) {
//     echo "Koneksi database mysqli gagal!!! : " . mysqli_connect_error();
// }

function query ($query) {
    global $koneksi;

    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[]=$row;
        }
    return $rows;
}


//mysqli_select_db($name, $koneksi) or die("Tidak ada database yang dipilih!");//


// TAMBAH DATA TEMPAT IBADAH

function tambah ($data) {

    global $koneksi;

    $kode = htmlspecialchars($data["kode"]) ;
    $inisial = htmlspecialchars ($data["inisial"]);
    $nama = htmlspecialchars ($data["nama"]);
    $jalan = htmlspecialchars ($data["jalan"]);
    $kelurahan = htmlspecialchars ($data["kelurahan"]);
    $kecamatan = htmlspecialchars ($data["kecamatan"]);
    $deskripsi = htmlspecialchars ($data["deskripsi"]);
    $longitude = htmlspecialchars ($data["longitude"]);
    $latitude = htmlspecialchars ($data["latitude"]);
    $add = htmlspecialchars ($data["add"]);
    $edit = htmlspecialchars ($data["edit"]);
    $addBy = htmlspecialchars ($data["addBy"]);
    $editBy = htmlspecialchars ($data["editBy"]);
    $verify = htmlspecialchars ($data["verify"]);
    $verifiedBy = htmlspecialchars ($data["verifiedBy"]);

    // upload foto
    // $foto1 = uploadA ();
    // if (!$foto1) {
    //     return false;
    // }

    // $foto2 = uploadB ();
    // if (!$foto2) {
    //     return false;
    // }
    // $foto3 = uploadC ();
    // if (!$foto3) {
    //     return false;
    // }

    $query = "INSERT INTO tb_tempat_ibadah VALUES
                ('','$kode','$inisial','$nama','$jalan', '$kelurahan', '$kecamatan','$deskripsi','$longitude','$latitude','foto1','foto2','foto3', '$add', '$edit',
                    '$addBy','$editBy', '$verify', '$verifiedBy'
            )";
                mysqli_query($koneksi, $query);

                return mysqli_affected_rows($koneksi);
}

function foto () {

    global $koneksi;
    
    // upload foto
    $foto = upload ();
    if (!$foto) {
        return false;
    }
    $count = count ($_FILES['foto']['name']);
    for ($i=0; $i < $count ; $i++) {

    $query = mysqli_query($koneksi, "SELECT MAX(id) AS kode_terbesar FROM tb_tempat_ibadah");
    $hasil = mysqli_fetch_array($query);
    $kode = $hasil['kode_terbesar'];

    $query = "INSERT INTO tb_foto VALUES
            ('','$foto', $kode)";
            mysqli_query($koneksi, $query);       
}

// return mysqli_affected_rows($koneksi); 
}

function upload ()  {
    global $koneksi;
    $count = count ($_FILES['foto']['name']);
        for ($i=0; $i < $count ; $i++) {
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
                if ($ukuranFile > 5000000) {
                    echo "<script>
                        alert('ukuran gambar terlalu besar')
                    </script>";
                    return false;
                }

            // lolos pengeckan gambar

            // generate nama baru
                $namaFileBaru = uniqid();
                $namaFileBaru .= '.';
                $namaFileBaru .= $ekstensiGambar;
                
                move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
                // return $namaFileBaru;
                

                // upload foto
                // $foto = upload ();
                // if (!$foto) {
                //     return false;
                // }

                $query = mysqli_query($koneksi, "SELECT MAX(id) AS kode_terbesar FROM tb_tempat_ibadah");
                $hasil = mysqli_fetch_array($query);
                $kode = $hasil['kode_terbesar'];

                $query = "INSERT INTO tb_foto VALUES
                    ('','$namaFileBaru', $kode)";
                    mysqli_query($koneksi, $query);

                            // return mysqli_affected_rows($koneksi);
            }
            
        }


function ubahUpload ()  {
    global $koneksi;

    $ide = $_POST['id']; 
    $count = $_POST ['count'];
    $namaFileLama = $_POST['fotolama'];
        for ($i=0; $i < $count ; $i++) {
            $namaFile = $_FILES['fotoubah']['name'][$i];
            $ukuranFile = $_FILES['fotoubah']['size'][$i];
            $error = $_FILES['fotoubah']['error'][$i];
            $tmpName = $_FILES['fotoubah']['tmp_name'][$i];

    // apkah tidak ada gambar yang diupload
        if ($error===4) {
            $query = "UPDATE tb_foto SET
                    foto = '$namaFileLama[$i]'
                    WHERE id = $ide[$i]";
             mysqli_query($koneksi, $query);
        } else {
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
                if ($ukuranFile > 5000000) {
                    echo "<script>
                        alert('ukuran gambar terlalu besar')
                    </script>";
                    return false;
                }

        // lolos pengeckan gambar

        // generate nama baru
                $namaFileBaru = uniqid();
                $namaFileBaru .= '.';
                $namaFileBaru .= $ekstensiGambar;
                
                move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
                // return $namaFileBaru;
                      

                $query = "UPDATE tb_foto SET
                        foto = '$namaFileBaru'
                    WHERE id = $ide[$i]";

                    mysqli_query($koneksi, $query);

                            // return mysqli_affected_rows($koneksi);  

                 }   
            }

        $count = count ($_FILES['foto']['name']);
        $id_ti = $_POST['id_ti'];

        for ($i=0; $i < $count ; $i++) {
            $namaFile = $_FILES['foto']['name'][$i];
            $ukuranFile = $_FILES['foto']['size'][$i];
            $error = $_FILES['foto']['error'][$i];
            $tmpName = $_FILES['foto']['tmp_name'][$i];

             // apkah tidak ada gambar yang diupload
             if ($error===4) {
             echo "<script>
                    alert('tidak ada foto baru yang ditambahkan')
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
                if ($ukuranFile > 5000000) {
                    echo "<script>
                        alert('ukuran gambar terlalu besar')
                    </script>";
                    return false;
                }

            // lolos pengeckan gambar

            // generate nama baru
                $namaFileBaru = uniqid();
                $namaFileBaru .= '.';
                $namaFileBaru .= $ekstensiGambar;
                
                move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
                // return $namaFileBaru;
                

                // upload foto
                // $foto = upload ();
                // if (!$foto) {
                //     return false;
                // }


                $query = "INSERT INTO tb_foto VALUES
                    ('','$namaFileBaru', $id_ti)";
                    mysqli_query($koneksi, $query);

                            // return mysqli_affected_rows($koneksi);
            }
            
        }

// TAMABH DATA ADMIN
function regis ($regis) {

    global $koneksi;

    $level = htmlspecialchars($regis["level"]) ;
    $nama = htmlspecialchars($regis["nama"]) ;
    $username = strtolower (stripslashes($regis["username"])) ;
    $password = mysqli_real_escape_string ($koneksi, $regis["password"]);
    $konfirmasi = mysqli_real_escape_string ($koneksi, $regis["konfirmasi"]);
// 

// cek username
   $result = mysqli_query($koneksi, "SELECT username FROM tb_admin WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "
         <script>
         alert('username sudah terdaftar!')
         </script>";
        return false;
    }

// cek konfirmasi password
    if ($password !== $konfirmasi) {
        echo "<script>
                alert ('konfirmasi password tidak sesuai')
                </script>";
        return false;
    }
// enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

// tambah admin baru
    $query = "INSERT INTO tb_admin VALUES
                ('', '$level', '$nama','$username','$password'
            )";
                mysqli_query($koneksi, $query);

                return mysqli_affected_rows($koneksi);
}


// UBAH DATA TEPAT IBADAH

function ubah ($data) {
    global $koneksi;

    $id = $data["id_ti"];
    $inisial = htmlspecialchars ($data["inisial"]);
    $nama = htmlspecialchars ($data["nama"]);
    $jalan = htmlspecialchars ($data["jalan"]);
    $kelurahan = htmlspecialchars ($data["kelurahan"]);
    $kecamatan = htmlspecialchars ($data["kecamatan"]);
    $deskripsi = htmlspecialchars ($data["deskripsi"]);
    $longitude = htmlspecialchars ($data["longitude"]);
    $latitude = htmlspecialchars ($data["latitude"]);
    // $fotoLama1 = htmlspecialchars ($data["fotoLama1"]);
    // $fotoLama2 = htmlspecialchars ($data["fotoLama2"]);
    // $fotoLama3 = htmlspecialchars ($data["fotoLama3"]);
    $add = htmlspecialchars ($data["add"]);
    $edit = htmlspecialchars ($data["edit"]);
    $addBy = htmlspecialchars ($data["addBy"]);
    $editBy = htmlspecialchars ($data["editBy"]);

    // // cek apakah user piih gambar baru atau tidak
    // if ($_FILES['foto1']['error']===4) {
    //     $foto1 = $fotoLama1;
    // } else {
    //     $foto1 = uploadA();
    // }
    
    // if ($_FILES['foto2']['error']===4) {
    //     $foto2 = $fotoLama2;
    // } else {
    //     $foto2 = uploadB();
    // }
    // if ($_FILES['foto3']['error']===4) {
    //     $foto3 = $fotoLama3;
    // } else {
    //     $foto3 = uploadC();
    // }

    $query = "UPDATE tb_tempat_ibadah SET
                    -- inisial = '$inisial',
                    nama = '$nama',
                    jalan = '$jalan',
                    kelurahan = '$kelurahan',
                    kecamatan = '$kecamatan',
                    deskripsi = '$deskripsi',
                    longitude = '$longitude',
                    latitude = '$latitude',
                    -- add = '$add',
                    edit = '$edit',
                    -- addBy = '$addBy',
                    editBy = '$editBy'

              WHERE id = $id
              ";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function ubahver ($data) {
    global $koneksi;

    $id = $data["id"];
    $inisial = htmlspecialchars ($data["inisial"]);
    $nama = htmlspecialchars ($data["nama"]);
    $jalan = htmlspecialchars ($data["jalan"]);
    $kelurahan = htmlspecialchars ($data["kelurahan"]);
    $kecamatan = htmlspecialchars ($data["kecamatan"]);
    $deskripsi = htmlspecialchars ($data["deskripsi"]);
    $longitude = htmlspecialchars ($data["longitude"]);
    $latitude = htmlspecialchars ($data["latitude"]);
    $fotoLama1 = htmlspecialchars ($data["fotoLama1"]);
    $fotoLama2 = htmlspecialchars ($data["fotoLama2"]);
    $fotoLama3 = htmlspecialchars ($data["fotoLama3"]);
    $add = htmlspecialchars ($data["add"]);
    $edit = htmlspecialchars ($data["edit"]);
    $addBy = htmlspecialchars ($data["addBy"]);
    $editBy = htmlspecialchars ($data["editBy"]);

    // // cek apakah user piih gambar baru atau tidak
    if ($_FILES['foto1']['error']===4) {
        $foto1 = $fotoLama1;
    } else {
        $foto1 = uploadA();
    }
    
    if ($_FILES['foto2']['error']===4) {
        $foto2 = $fotoLama2;
    } else {
        $foto2 = uploadB();
    }
    if ($_FILES['foto3']['error']===4) {
        $foto3 = $fotoLama3;
    } else {
        $foto3 = uploadC();
    }

    $query = "UPDATE tb_tempat_ibadah SET
                    -- inisial = '$inisial',
                    nama = '$nama',
                    jalan = '$jalan',
                    kelurahan = '$kelurahan',
                    kecamatan = '$kecamatan',
                    deskripsi = '$deskripsi',
                    longitude = '$longitude',
                    latitude = '$latitude',
                    foto1 = '$foto1',
                    foto2 = '$foto2',
                    foto3 = '$foto3',
                    -- add = '$add',
                    edit = '$edit',
                    -- addBy = '$addBy',
                    editBy = '$editBy',
                    verify = 0,
                    verifiedBy = '-'

              WHERE id = $id
              ";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// UBAH DATA ADMIN

function ubahadmin ($regis) {
    global $koneksi;

    $id = $regis["id"];
    $nama = htmlspecialchars ($regis["nama"]);
    $username = htmlspecialchars ($regis["username"]);
    $password = htmlspecialchars ($regis["password"]);
    $konfirmasi = htmlspecialchars ($regis["konfirmasi"]);
    $query = "UPDATE tb_admin SET
                    nama = '$nama',
                    username = '$username',
                    password = '$password',
              WHERE id = $id
              ";

                mysqli_query($koneksi, $query);

                return mysqli_affected_rows($koneksi);

}

// HAPUS DATA TEMPAT IBADAH

function hapus ($id) {
    
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_tempat_ibadah WHERE id = $id");
    mysqli_query($koneksi, "DELETE FROM tb_foto WHERE id_ti = $id");

    return mysqli_affected_rows($koneksi);
}


function hapusfoto ($id) {
    
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_foto WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}

// HAPUS DATA TEMPAT IBADAH

function hapusadmin ($id) {
    
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_admin WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}


// cari data
function cari ($keyword) {
    $query =   "SELECT * FROM tb_tempat_ibadah 
                    WHERE
                kode LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR
                jalan LIKE '%$keyword%' OR
                kelurahan LIKE '%$keyword%' OR
                kecamatan LIKE '%$keyword%' OR
                addBy LIKE '%$keyword%' OR
                editBy LIKE '%$keyword%'

    ";
    return query ($query);
}

// alamat cobobox

function verify ($id) {
global $koneksi;

    mysqli_query($koneksi, "UPDATE tb_tempat_ibadah 
        SET
            verify = 1

        WHERE id = $id
        ");

    return mysqli_affected_rows($koneksi);
}

// function ubahfoto ($data) {
//     global $koneksi;

//     $fotoLama = htmlspecialchars ($data["fotoLama"]);


//  // cek apakah user piih gambar baru atau tidak
//     if ($_FILES['foto']['error']===4) {
//         $foto = $fotoLama;
//     } else {
//         $foto = upload();
//     }


// $query = "UPDATE tb_foto SET
//                     foto = '$foto'
//               WHERE id = $idfoto
//               ";

//     mysqli_query($koneksi, $query);
//     return mysqli_affected_rows($koneksi);
// }


?>


