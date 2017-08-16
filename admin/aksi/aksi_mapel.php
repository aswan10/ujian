<?php
error_reporting(0);
include "../koneksi.php";
include "../fungsi/fungsi_library.php";

$id = $_POST['id_mapel'];
$mapel = $_POST['mapel'];
$ket = $_POST['ket'];
$kelas = $_POST['kelas'];
$status = $_POST['status'];

if ($_GET['mod']=='edit') {

	$db->db_query("UPDATE t_matapelajaran SET nama_mapel ='$mapel', keterangan ='$ket', kelas_id ='$kelas', status ='$status', modified_mapel ='$waktu_sekarang $jam_sekarang' 
	WHERE id_mapel ='$id' ");
	echo "<script language='JavaScript'>alert('Data berhasil di Edit');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../mata-pelajaran'>";
}


elseif ($_GET['mod']=='add'){
	$db->db_query("INSERT INTO t_matapelajaran (nama_mapel, keterangan, kelas_id, status, created_mapel) VALUES ('$mapel', '$ket', '$kelas', '$status', '$waktu_sekarang $jam_sekarang') ");
	echo "<script language='JavaScript'>alert('Data berhasil di Tambah');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../mata-pelajaran'>";
}


elseif ($_GET['mod']=='delete'){
	$id = $_GET['id'];
	$db->db_query("DELETE FROM t_matapelajaran WHERE id_mapel ='$id' ");
	echo "<script language='JavaScript'>alert('Data berhasil di Hapus');</script>";
	echo "<meta http-equiv='refresh' content='0; url=../mata-pelajaran'>";
}


else { echo "<meta http-equiv='refrash' content='0; url=../mata-pelajaran'>"; }

?>