<?php
	session_start();
	include "cek_login.php";
	include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Copyright" content="edi sutanto">
		<meta name="Author" content="edi sutanto">
		<title>Halaman User</title>
		<link rel='stylesheet' href='css/style.css' type='text/css'>
	</head>

	<body>
		<div id='container'>
			<div id='header'>
				<div class='list-right'>
					<?php 
						$sql = $db->db_query("SELECT * FROM t_kelas INNER JOIN t_user ON t_user.kelas_id = t_kelas.id_kelas WHERE id_kelas ='$_SESSION[kelas]' ");
						$data = $db->db_fetch_array($sql);
					?>
					<p>Hello, <?php echo $_SESSION['username'];?> | Kelas <?php echo $data['kelas'];?> &nbsp;
					<?php if ($data['foto']!=''){echo"<img src='..images/$data[foto]' class='icon'>";} else{echo"<img src='images/anak sekolah.jpg' class='icon'>";}?></p> 
					<p><a href='logout' title='logout'>Logout</a></p>
				</div>
				<div class='list-left'>
					<p>Aplikasi Ujian Online</p>
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
				</div>O
				<div class='clear'></div>
			</div>

			<div id='footer'>
				<p><b>&copy; </b>Copyright Edi Sutanto 2015 bersama <a href='http://www.e-sutanto.blogspot.co.id' target='_blank'>www.e-sutanto.blogspot.co.id</a></p>
			</div>
		</div>
			<?php $db->db_close(); ?>
	</body>
</html>