<?php
	session_start();
	include "cek_login.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Copyright" content="edi sutanto">
		<meta name="Author" content="edi sutanto">
		<title>Halaman Administrator</title>
		<link rel='stylesheet' href='css/style.css' type='text/css'>
	</head>

	<body>
		<div id='container'>
			<div id='header'>
				<div class='list-right'>
					<p>Hello <?php echo $_SESSION['Username'];?> <img src='images/user.png' class='icon'> </p> 
					<p><a href='logout' title='logout'>Logout</a></p>
				</div>
				<div class='list-left'>
					<p>Aplikasi Ujian Online | Administrator</p>
				</div>
				<div class='clear'></div>
			</div>

			<div id='content'>
				<div id='content-left'>
					<?php include "sidebar_left.php";?>
				</div>
				<div class='clear'></div>

				<div id='content-right'>
					<div class='grid-right'>
						<?php include "content.php";?>
					</div>
				</div>
				<div class='clear'></div>
			</div>

			<div id='footer'>
				<p><b>&copy;</b> Copyright Edi Sutanto 2015 bersama <a href='http://www.e-sutanto.blogspot.co.id' target='_blank'>www.e-sutanto.blogspot.co.id</p>
			</div>
		</div>

	</body>
</html>