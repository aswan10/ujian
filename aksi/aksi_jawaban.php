<?php
	error_reporting(0);
	session_start();
	
	include "../koneksi.php";
	include "../fungsi/fungsi_library.php";

	$query1 = $db->db_query("SELECT * FROM t_user WHERE username = '$_SESSION[username]' ");
	$user = $db->db_fetch_array($query1);

	/* $query2 = $db->db_query("SELECT * FROM t_soal WHERE mapel_id = '$_POST[id_mapel]' AND id_soal ='$_POST[id]");
	$jml = $db->db_num_rows($query2); */

	$id_user = $user['id_user'];
	$id_mapel = $_POST['id_mapel'];
	$jawaban = @$_POST['jawaban'];
	$id_soal = $_POST['id'];
	$jumlah = $_POST['jumlah'];

	$query2 = $db->db_query("SELECT * FROM t_matapelajaran WHERE id_mapel ='$id_mapel' ");
	$data2 = $db->db_fetch_array($query2);

	if (isset($_POST['submit'])) {

		// jika jawaban kosong
		if (count($jawaban) =='0') {
			echo "<script>alert('Upss SEMUA soal belum dikerjakan, ulangi lagi..')</script>";
			echo "<script>document.location.href='../$id_mapel-soal-$data2[nama_mapel]-$data2[keterangan]'</script>";
		}

		// jika jawaban masih ada yang blm di isi
		elseif (count($jawaban) < $jumlah) {
			$kosong = $jumlah - (count($jawaban)); 
			echo "<script>alert('Upss ada $kosong soal belum dikerjakan, Lihat nilai..')</script>";

				$benar=0;
				$salah=0;
				$kosong=0;

				// simpan detail nilai
				for ($i = 0; $i < $jumlah; $i++){
				//id nomor soal
				$nomor = $id_soal[$i];
				$jawab = $jawaban[$nomor];
				$db->db_query("INSERT INTO t_detail_nilai (user_id, soal_id, jawaban, created_dtl_nilai) VALUES ('$id_user', '$nomor', '$jawab', '$waktu_sekarang $jam_sekarang')");	
				
					//jika user tidak memilih jawaban
					if (empty($jawab)){
					$kosong++; }
					
					//cocokan jawaban user dengan jawaban di database
					$query2 = $db->db_query("SELECT * FROM t_soal WHERE id_soal = '$nomor' AND kunci_jawaban = '$jawab' ");
					
					$cek = $db->db_num_rows($query2);
					
					if($cek){
						//jika jawaban cocok (benar)
						$benar++;
					}else{
						//jika salah
						$salah++;
					}
				}

				$score = ($benar * 10) / $jumlah;
				$nilai = substr($score,0,3);
				
				$db->db_query("INSERT INTO t_nilai (user_id, mapel_id, nilai, benar, salah, created_nilai) VALUES ('$id_user', '$id_mapel', '$nilai', '$benar', '$salah', '$waktu_sekarang $jam_sekarang')");

				
				echo "<script>document.location.href='../hasil-mengerjakan-soal&id=$id_mapel'</script>";
			} 
		
		// jika jawaban sudah diisi semua
		elseif (count($jawaban) == $jumlah) {
			echo "<script>alert('Soal sudah dikerjakan semua, Lihat nilai..')</script>";

				$benar=0;
				$salah=0;
				$kosong=0;
				// simpan detail nilai
				for ($i = 0; $i < $jumlah; $i++) {
				//id nomor soal
				$nomor = $id_soal[$i];
				$jawab = $jawaban[$nomor];
				$db->db_query("INSERT INTO t_detail_nilai (user_id, soal_id, jawaban, created_dtl_nilai) VALUES ('$id_user', '$nomor', '$jawab', '$waktu_sekarang $jam_sekarang')");	
			
					//jika user tidak memilih jawaban
					if (empty($jawab)){
					$kosong++; }
					
					//cocokan jawaban user dengan jawaban di database
					$query2 = $db->db_query("SELECT * FROM t_soal WHERE id_soal = '$nomor' AND kunci_jawaban = '$jawab' ");
					
					$cek = $db->db_num_rows($query2);
					
					if($cek){
						//jika jawaban cocok (benar)
						$benar++;
					}else{
						//jika salah
						$salah++;
					}
					
				 }

				$score = ($benar * 10) / $jumlah;
				$nilai = substr($score,0,3);
				
				$db->db_query("INSERT INTO t_nilai (user_id, mapel_id, nilai, benar, salah, created_nilai) VALUES ('$id_user', '$id_mapel', '$nilai', '$benar', '$salah', '$waktu_sekarang $jam_sekarang')");

				
				echo "<script>document.location.href='../hasil-mengerjakan-soal&id=$id_mapel'</script>";
			}
		}
	?>
