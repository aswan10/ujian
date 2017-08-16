<?php
error_reporting(0);
include "../koneksi.php";
include "../fungsi/fungsi_library.php";

$id = $_POST['id_nilai'];
$nilai = $_POST['nilai'];

if ($_GET['mod']=='edit') {

	$db->db_query("UPDATE t_nilai SET nilai ='$nilai', modified_nilai ='$waktu_sekarang $jam_sekarang' 
	WHERE id_nilai ='$id' ");
	echo "<script language='JavaScript'>alert('Data berhasil di Edit');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../nilai'>";
}


elseif ($_GET['mod']=='delete'){
	$id = $_GET['id'];
	$db->db_query("DELETE FROM t_nilai WHERE id_nilai ='$id' ");
	echo "<script language='JavaScript'>alert('Data berhasil di Hapus');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../nilai'>";
}


else { echo "<meta http-equiv='refrash' content='0; url=../nilai'>"; }

?>