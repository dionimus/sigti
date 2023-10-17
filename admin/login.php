<?php 
session_start();


require "../koneksi.php";


if (isset($_SESSION['login'])) {
	header("location: dashboard.php");
}

if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '$username'");
	$nama = query ("SELECT * FROM tb_admin WHERE username = '$username'");

	// cek username
	if(mysqli_num_rows($result)===1){

		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row['password'])) {
			// set session
			$_SESSION['login'] = true;

			header("location : dashboard.php");
			
			// kirim username
			$_SESSION['username'] = $username;
			exit;
		}
	}
	$error = true;
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Admin</title>

<!-- MyFonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

	<!--MyStyle-->
	<link rel="stylesheet" type="text/css" href="css/login_style.css">

</head>
<body>
	<div class="container-login">
		<h1>Log In</h1>	
		<?php if (isset($error)) : ?>
			<p style="color: red; font-style: italic;">Username / Password yang dimasukan salah!</p>
		<?php endif; ?>
		<form action="" method="post">
					<div class="input-group">
						<input type="text" name="username" id="username" placeholder="Username">
					</div>
					<div class="input-group">
						<input type="password" name="password" id="password" placeholder="Password">
					</div>
					<button type="submit" name="login" class="btnlogin">Log In</button>
		</form>
	</div>
	</section>

</body>
</html>