<?php
	session_start();
	error_reporting(0);
	include "../koneksi.php";
	include "../fungsi/fungsi_injection.php";
	include "../fungsi/fungsi_library.php";

	$nama = $injection->antiinjection($_POST['username']);
	$old_pass = $injection->antiinjection(md5($_POST['old_password']));
	$new_pass = $injection->antiinjection(md5($_POST['new_password']));

	// UPLOAD EDIT GAMBAR
	$namafolder = "../images/"; // images (folder penyimpanan)
	// $maxsize    = " 1024 * 100";
	if (!empty($_FILES["image"]["tmp_name"])){
	$jenis_gambar = $_FILES['image']['type'];
	$jenis_gambar =="jpeg" || $jenis_gambar=="jpg" || $jenis_gambar=="gif" || $jenis_gambar=="png";
	$gambar = $namafolder.basename($_FILES['image']['name']);
	move_uploaded_file($_FILES['image']['tmp_name'], $gambar);
	}
	// END UPLOAD

	$query = $db->db_query("SELECT * FROM t_admin WHERE username ='$_SESSION[username]' ");
	$data = $db->db_fetch_array($query);

	if (isset($_POST['submit'])) {
		if ($old_pass != $data['password']) {
		echo "<script language='JavaScript'>alert('Old Password salah. Mohon koreksi ulang !!');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../profile'>";
		}
		if ($old_pass == $data['password'] AND $nama!='0' AND $gambar!='0') {
		$db->db_query("UPDATE t_admin SET username ='$nama', password ='$new_pass', foto ='$gambar', modified_admin ='$waktu_sekarang $jam_sekarang' ");
		echo "<script language='JavaScript'>alert('Data Profile berhasil di ubah.');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../profile'>"; 
		}

		if ($old_pass == $data['password'] AND $nama=='0' AND $gambar=='0') {
		$db->db_query("UPDATE t_admin SET password ='$new_pass', modified_admin ='$waktu_sekarang $jam_sekarang' ");
		echo "<script language='JavaScript'>alert('Data Profile berhasil di ubah.');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../profile'>"; 
		}



	}
?>