<?php
	session_start();
	error_reporting(0);
	include "../koneksi.php";
	include "../fungsi/fungsi_injection.php";
	include "../fungsi/fungsi_library.php";

	$id_user = $_POST['id_user'];
	$nama = $injection->antiinjection($_POST['username']);
	$old_pass = $injection->antiinjection(md5($_POST['old_password']));
	$new_pass = $injection->antiinjection(md5($_POST['new_password']));

	// UPLOAD EDIT GAMBAR
	$namafolder = "../images/"; // images (folder penyimpanan)
	// $maxsize    = " 1024 * 100";
	if (!empty($_FILES["img_user"]["tmp_name"])){
	$jenis_gambar = $_FILES['img_user']['type'];
	$jenis_gambar =="jpeg" || $jenis_gambar=="jpg" || $jenis_gambar=="gif" || $jenis_gambar=="png";
	$gambar = $namafolder.basename($_FILES['img_user']['name']);
	move_uploaded_file($_FILES['img_user']['tmp_name'], $gambar);
	}
	// END UPLOAD

	$query = $db->db_query("SELECT * FROM t_user WHERE username ='$_SESSION[username]' ");
	$data = $db->db_fetch_array($query);

	if (isset($_POST['submit'])) {
		if ($old_pass != $data['password']) {
		echo "<script language='JavaScript'>alert('Old Password salah. Mohon koreksi ulang !!');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../profile'>";
		}
		if ($old_pass == $data['password'] AND $gambar!='' AND $nama !='') {
		$db->db_query("UPDATE t_user SET username ='$nama', password ='$new_pass', foto ='$gambar', modified_user ='$waktu_sekarang $jam_sekarang' 
		WHERE id_user ='$id_user' ");
		echo "<script language='JavaScript'>alert('Data Profile berhasil di ubah.');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../login'>"; 
		}

		if ($old_pass == $data['password'] AND $gambar=='' AND $nama !='') {
		$db->db_query("UPDATE t_user SET username ='$nama', password ='$new_pass', modified_user ='$waktu_sekarang $jam_sekarang' 
		WHERE id_user ='$id_user' ");
		echo "<script language='JavaScript'>alert('Data Profile berhasil di ubah.');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../login'>"; 
		}

		if ($old_pass == $data['password'] AND $gambar!='' AND $nama =='') {
		$db->db_query("UPDATE t_user SET password ='$new_pass', foto ='$gambar', modified_user ='$waktu_sekarang $jam_sekarang' 
		WHERE id_user ='$id_user' ");
		echo "<script language='JavaScript'>alert('Data Profile berhasil di ubah.');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../login'>"; 
		}

		if ($old_pass == $data['password'] AND $gambar=='' AND $nama =='') {
		$db->db_query("UPDATE t_user SET password ='$new_pass', modified_user ='$waktu_sekarang $jam_sekarang' 
		WHERE id_user ='$id_user' ");
		echo "<script language='JavaScript'>alert('Data Profile berhasil di ubah.');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../login'>"; 
		}

	}
?>