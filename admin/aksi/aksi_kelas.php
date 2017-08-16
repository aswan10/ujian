<?php
error_reporting(0);
include "../koneksi.php";
include "../fungsi/fungsi_library.php";
include "../fungsi/fungsi_injection.php";

$id = $_POST['id_kelas'];
$kelas = $injection->antiinjection($_POST['kelas']);
$status = $_POST['status'];


if ($_GET['mod']=='edit') {
		$query = $db->db_query("UPDATE t_kelas SET kelas ='$kelas', status ='$status', modified_kelas ='$waktu_sekarang $jam_sekarang' 
		WHERE id_kelas ='$id' ");
		echo "<script language='JavaScript'>alert('Data berhasil di Edit');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../kelas'>";
}


elseif ($_GET['mod']=='add'){
	$db->db_query("INSERT INTO t_kelas (kelas, status, created_kelas) VALUES ('$kelas', '$status', '$waktu_sekarang $jam_sekarang') ");
	echo "<script language='JavaScript'>alert('Data berhasil di Tambah');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../kelas'>";
}


elseif ($_GET['mod']=='delete'){
	$id = $_GET['id'];
	$db->db_query("DELETE FROM t_kelas WHERE id_kelas ='$id' ");
	echo "<script language='JavaScript'>alert('Data berhasil di Hapus');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../kelas'>";
}