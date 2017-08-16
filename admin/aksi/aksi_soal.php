<?php
error_reporting(0);
include "../koneksi.php";
include "../fungsi/fungsi_library.php";

$id_soal = $_POST['id_soal'];
$id_mapel = $_POST['id_mapel'];
$soal = $_POST['soal'];
$pilihanA = $_POST['pilihanA'];
$pilihanB = $_POST['pilihanB'];
$pilihanC = $_POST['pilihanC'];
$pilihanD = $_POST['pilihanD'];
$pilihanE = $_POST['pilihanE'];
$kunci_jawaban = $_POST['kunci_jawaban'];


		
		
							

	if ($_GET['mod']=='edit') {
		$db->db_query("UPDATE t_soal SET soal ='$soal', pilihanA ='$pilihanA', pilihanB ='$pilihanB', pilihanC ='$pilihanC', pilihanD ='$pilihanD', pilihanE ='$pilihanE', kunci_jawaban ='$kunci_jawaban', modified_soal ='$waktu_sekarang $jam_sekarang' 
		WHERE id_soal ='$id_soal' ");
		echo "<script language='JavaScript'>alert('Data berhasil di Edit');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../detail-soal&id=$id_mapel'>";
	}


	elseif ($_GET['mod']=='add') {
		$db->db_query("INSERT INTO t_soal(mapel_id,soal,pilihanA,pilihanB,pilihanC,pilihanD,pilihanE,kunci_jawaban,created_soal) 
		VALUES ('$id_mapel', '$soal', '$pilihanA', '$pilihanB', '$pilihanC', '$pilihanD', '$pilihanE', '$kunci_jawaban', '$waktu_sekarang $jam_sekarang') ");
		echo "<script language='JavaScript'>alert('Data berhasil di Tambah');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../detail-soal&id=$id_mapel'>";
	}


	elseif ($_GET['mod']=='add-master') {
		$db->db_query("INSERT INTO t_soal(mapel_id,soal,pilihanA,pilihanB,pilihanC,pilihanD,pilihanE,kunci_jawaban,created_soal) 
		VALUES ('$id_mapel', '$soal', '$pilihanA', '$pilihanB', '$pilihanC', '$pilihanD', '$pilihanE', '$kunci_jawaban', '$waktu_sekarang $jam_sekarang') ");
		echo "<script language='JavaScript'>alert('Data berhasil di Tambah');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../detail-soal&id=$id_mapel'>";
	}
	

	elseif ($_GET['mod']=='delete') {
		$id = $_GET['id'];
		$m = $_GET['m'];
		$db->db_query("DELETE FROM t_soal WHERE id_soal ='$id' ");
		echo "<script language='JavaScript'>alert('Data berhasil di Hapus');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../detail-soal&id=$m'>";
	}


	else { echo "<meta http-equiv='refrash' content='0; url=../soal'>"; } 


?>