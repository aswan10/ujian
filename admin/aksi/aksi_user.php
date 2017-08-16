<?php
error_reporting(0);
include "../koneksi.php";
include "../fungsi/fungsi_library.php";
include "../fungsi/fungsi_injection.php";

$id = $_POST['id_user'];
$nama = $injection->antiinjection($_POST['nama']);
$pass = $injection->antiinjection(md5($_POST['password']));
$pass2 = $injection->antiinjection($_POST['pass2']);
$kelas = $_POST['kelas'];
$status = $_POST['status'];
	// UPLOAD EDIT GAMBAR
	$namafolder = "../../images/"; // images (folder penyimpanan)
	// $maxsize    = " 1024 * 100";
	if (!empty($_FILES["foto"]["tmp_name"])){
	$jenis_gambar = $_FILES['foto']['type'];
	$jenis_gambar =="jpeg" || $jenis_gambar=="jpg" || $jenis_gambar=="gif" || $jenis_gambar=="png";
	$gambar = $namafolder.basename($_FILES['foto']['name']);
	move_uploaded_file($_FILES['foto']['tmp_name'], $gambar);
	}
	// END UPLOAD

	// UPLOAD ADD GAMBAR
	$namafolder1 = "../../images/"; // images (folder penyimpanan)
	// $maxsize    = " 1024 * 100";
	if (!empty($_FILES["foto1"]["tmp_name"])){
	$jenis_gambar1 = $_FILES['foto1']['type'];
	$jenis_gambar1 =="jpeg" || $jenis_gambar1=="jpg" || $jenis_gambar1=="gif" || $jenis_gambar1=="png";
	$gambar1 = $namafolder1.basename($_FILES['foto1']['name']);
	move_uploaded_file($_FILES['foto1']['tmp_name'], $gambar1);
	}
	// END UPLOAD

if ($_GET['mod']=='edit') {
	if ($pass2 =='') {
		$query1 = $db->db_query("UPDATE t_user SET username ='$nama', kelas_id ='$kelas', status ='$status', modified_user ='$waktu_sekarang $jam_sekarang' 
		WHERE id_user ='$id' ");
		echo "<script language='JavaScript'>alert('Data berhasil di Edit');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../user'>";
		exit;
		}
	elseif ($pass2 !='') {
		$password = $injection->antiinjection(md5($pass));
		$query = $db->db_query("UPDATE t_user SET username ='$nama', password ='".md5($pass2)."', kelas_id ='$kelas', status ='$status', modified_user ='$waktu_sekarang $jam_sekarang' 
		WHERE id_user ='$id' ");
		echo "<script language='JavaScript'>alert('Data berhasil di Edit');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../user'>";
		}
}


elseif ($_GET['mod']=='add'){
	$db->db_query("INSERT INTO t_user (username, password, kelas_id, status, created_user) VALUES ('$nama', '$pass', '$kelas', '$status', '$waktu_sekarang $jam_sekarang') ");
	echo "<script language='JavaScript'>alert('Data berhasil di Tambah');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../user'>";
}


elseif ($_GET['mod']=='delete'){
	$id = $_GET['id'];
	$db->db_query("DELETE FROM t_user WHERE id_user ='$id' ");
	echo "<script language='JavaScript'>alert('Data berhasil di Hapus');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../user'>";
}


else { echo "<meta http-equiv='refresh' content='0; url=../user'>"; } 

?>