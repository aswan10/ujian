<?php
include "fungsi/fungsi_library.php";
include "fungsi/fungsi_indotgl.php";

	$query = $db->db_query("SELECT * FROM t_user WHERE username ='$_SESSION[username]' ");
	$user = $db->db_fetch_array($query);

if (isset($_GET['home'])){ ?>

		<div class='home'>
			<p><b>Selamat Datang di Aplikasi Ujian Online</b></p>
			<br>
			<p>Aplikasi ini dibuat untuk mempermudah Siswa atau Mahasiswa dalam mengerjakan soal ujian atau soal latihan.</p>
			<p>Pilih kanten ada di sebelah kiri.</p>
			<br>
			<p>- Sukses -</p> 
		</div>
		<div class='spasi'></div>
		login sebagai: <b><?php echo $user['username']?></b> | <?php echo "".substr($waktu_sekarang,8,2)." ".$format_tanggal->getBulan(substr($waktu_sekarang,5,2))." ".substr($waktu_sekarang,0,4).", $jam_sekarang ";?>
	<?php
}


elseif (isset($_GET['profile'])) {
		$query1 = $db->db_query("SELECT * FROM t_user 
		INNER JOIN t_kelas ON t_kelas.id_kelas = t_user.kelas_id WHERE username ='$_SESSION[username]' AND t_user.kelas_id ='$_SESSION[kelas]' ");
		$data1 = $db->db_fetch_array($query1);
		?>
		<div class='profile'>
			 <!-- Interktif Profile -->
			<script type="text/javascript">
	            $(document).ready(function(){

	                $("#Judul").click(function(){
	                    if ($(".isi").is(":hidden")){
	                        $(".isi").slideDown("slow");
	                    }
	                    else{
	                        $(".isi").slideUp("slow");
	                    }
	                });
	                
	            });
            </script>


 			<div class='img-profile'>
 				<?php if ($data1['foto']!=''){echo"<img src='..images/$data1[foto]' class='icon'>";} else{echo"<img src='images/anak sekolah.jpg' class='icon'>";}?>
			</div>

			<table class='table-profile'>
				<tr>
					<td><label>Username</label></td>
					<td>:</td>
					<td><?php echo $data1['username'];?></td>
				</tr>
				<tr>
					<td><label>Kelas</label></td>
					<td>:</td>
					<td><?php echo $data1['kelas'];?></td>
				</tr>
				<tr>
					<td><label>Password</label></td>
					<td>:</td>
					<td>*********</td>
				</tr>
			</table>

				<div id="Judul">
					<input type='submit' value='Ubah Profile' class='submit-profile'>
				</div>
				<div class='isi' style='display:none;'>
					<form method='POST' action='aksi/aksi_ubah_profile.php' name='ubah-profile' enctype='multipart/form-data'>
					<table class='table-ubah-profile'>
						<input type='hidden' name='id_user' value='<?php echo $data1['id_user'];?>'>
						<tr>
							<td><input type='text' name='username' placeholder='Username' maxlength='50'></td>
						</tr>
						<tr>
							<td><input type='text' name='old_password' placeholder='Old Password' maxlength='50' required> *)</td>
						</tr>
						<tr>
							<td><input type='text' name='new_password' placeholder='New Password' maxlength='50' required> *)</td>
						</tr>
						<tr>
							<td><label>Ganti gambar</label> <input type='file' name='img_user' id='img_user' class='edit-gambar'></td>
						</tr>
						<tr>
							<td><input type='submit' name='submit' value='Ubah' onClick="return confirm('Apakah Anda yakin ingin mengganti Profile?')"></td>
							<td>* Abaikan jika tidak di Ubah</td>
						</tr>
					</table>
					</form>
				</div>
		
			<div class='clear'></div>
		</div>
	<?php
}


elseif (isset($_GET['hasil'])) { 
		$mapel = $_GET['id'];
		$query = $db->db_query("SELECT * FROM t_soal INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_soal.mapel_id WHERE id_mapel = '$mapel' ");
		$data = $db->db_fetch_array($query);
		?>
		<div class='hasil'>
			<p>Anda baru saja mengerjakan soal <b><?php echo $data['nama_mapel']?> [<?php echo $data['keterangan'];?>]</b>.</p>
			<p style='margin-top:10px;'><a href='nilai' style='color:black; background:orange; padding:5px; font-weight:bold;'>Lihat Nilai</a></p>
		</div>
		<div class='spasi'></div>
	<?php
}



elseif (isset($_GET['soal'])){ 

					$query = $db->db_query("SELECT * FROM t_soal INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_soal.mapel_id 
					WHERE mapel_id ='$_GET[id]'");
					$mapel = $db->db_fetch_array($query);
					$row = $db->db_num_rows($query);

					$query1 = $db->db_query("SELECT * FROM t_nilai WHERE user_id ='$user[id_user]' AND mapel_id ='$_GET[id]' ");
					$data1 = $db->db_fetch_array($query1);

					// kondisi Jika sudah mengerjakan soal
					if (!empty($data1)) { 
						echo" Anda sudah mengerjakan <b>Soal $mapel[nama_mapel] [$mapel[keterangan]]</b>";
						echo" <p style='margin-top:10px;'><a href='nilai' style='color:black; background:orange; padding:5px; font-weight:bold;'>Lihat Nilai</a></p>";
						}

					// kondisi jika belum mengerjakan soal	
					else {
					?>

					<div class='grid-soal'>
						<p class='keterangan'>Soal <?php echo $mapel['nama_mapel']?> [<?php echo $mapel['keterangan'];?>] :</p> 
						<span class='jumlah'><?php echo $row ?> Soal <b><p>Kerjakan dengan teliti.</p></b></span>
						<div class='clear'></div>
					</div>

					<form method="post" action='aksi/aksi_jawaban.php'>
					<table name='soal' class='table-soal'>

						<?php 
							$no =1;
							
							$sql = $db->db_query("SELECT * FROM t_soal INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_soal.mapel_id 
							WHERE id_mapel = '$_GET[id]' ORDER BY rand() ");
							$jml = $db->db_num_rows($sql);

							while ($data = $db->db_fetch_array($sql)){

							$id = $data['id_soal'];
							$mapel = $data['id_mapel'];
						?>

						<!-- Ambil id_mapel -->
						<input type='hidden' name='id_mapel' value="<?php echo $mapel ?>">
						<!-- Ambil id_soal -->
						<input type="hidden" name="id[]" value="<?php echo $id ?>">
						<!-- Ambil jumlah soal -->
						<input type="hidden" name="jumlah" value="<?php echo $jml ?>">


						<tr>
							<td><?php echo $no ?>.</td>
							<td><?php echo $data['soal'] ?> </td> 
						</tr>
						<tr>
							<?php if ($data['pilihanA']!=''){ ?>
							<td></td>
							<td><input type="radio" name="jawaban[<?php echo $id ?>]" id='jawaban' value="A"> A. <?php echo $data['pilihanA']?></td>
						</tr>
						<tr>
							<?php }  if ($data['pilihanB']!=''){ ?>
							<td></td>
							<td><input type="radio" name="jawaban[<?php echo $id ?>]" id='jawaban' value="B"> B. <?php echo $data['pilihanB']?></td>
						</tr>
						<tr>
							<?php }  if ($data['pilihanC']!=''){ ?>
							<td></td> 
							<td><input type="radio" name="jawaban[<?php echo $id ?>]" id='jawaban' value="C"> C. <?php echo $data['pilihanC']?></td>
						</tr>
						<tr>
							<?php }  if ($data['pilihanD']!=''){ ?>
							<td></td>
							<td><input type="radio" name="jawaban[<?php echo $id ?>]" id='jawaban' value="D"> D. <?php echo $data['pilihanD']?></td>
						</tr>
						<tr>
							<?php }  if ($data['pilihanE']!=''){ ?>
							<td></td>
							<td><input type="radio" name="jawaban[<?php echo $id ?>]" id='jawaban' value="E"> E. <?php echo $data['pilihanE']?></td> 
							<?php } ?>
						</tr> 
						
						<?php
						$no++; 
						} ?> 
						<tr>
				         	<td colspan="10"><input type='submit' name='submit' value='Submit' onClick="return confirm('Apakah Anda yakin akan menyimpan Nilai?')"></td> <!-- onclick="kirim_form();" -->
				       	</tr>

					</table>
					</form>
			<?php
		}
	}



elseif (isset($_GET['nilai'])) { 
			$query1 = $db->db_query("SELECT * FROM t_user WHERE username ='$_SESSION[username]' ");
			$data1 = $db->db_fetch_array($query1);

			$query2 = $db->db_query("SELECT * FROM t_nilai INNER JOIN t_user ON t_user.id_user = t_nilai.user_id
				INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_nilai.mapel_id
				INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id
			 	WHERE id_user = '$data1[id_user]' ORDER BY id_nilai ASC ");
			
			$row = $db->db_num_rows($query2);
			?>

			<div class='grid-nilai'>
				<p class='keterangan'>Nilai Anda :</p>
				<span class='jumlah'><?php echo $row ?> Nilai</span>
				<div class='clear'></div>
			</div>

			<table class='table-nilai'>
				<tr>
					<th>No.</th>
					<th>Nama</th>
					<th>Kelas</th>
					<th>Mata Pelajaran</th>
					<th>Keterangan</th>
					<th>Nilai</th>
					<th>Tanggal</th>
					<th>Detail</th>
				</tr>
			<?php
			$no = 1;
			while ($data2 = $db->db_fetch_array($query2)){
			echo "
				<tr>
					<td>$no</td>
					<td>$data2[username]</td>
					<td>$data2[kelas]</td>
					<td>$data2[nama_mapel]</td>
					<td>$data2[keterangan]</td>
					<td><b>$data2[nilai]</b></td>
					<td>".substr($data2['created_nilai'],8,2)." ".$format_tanggal->getBulan(substr($data2['created_nilai'],5,2))." ".substr($data2['created_nilai'],0,4).", ".substr($data2['created_nilai'],10,17)."</td>
					<td><a href='detail-nilai&id=$data2[id_nilai]'>Detail</a></td>
				</tr>";
			$no++;				
			}
			?>
			</table>
			<?php 
	}



elseif (isset($_GET['detail-nilai'])) {

	$query1 = $db->db_query("SELECT * FROM t_nilai INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_nilai.mapel_id
	INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id
	WHERE id_nilai ='$_GET[id]' ");
	$data1 = $db->db_fetch_array($query1);

	$query2 = $db->db_query("SELECT * FROM t_detail_nilai 
	INNER JOIN t_soal ON t_soal.id_soal = t_detail_nilai.soal_id
	WHERE user_id ='$data1[user_id]' AND created_dtl_nilai ='$data1[created_nilai]' ORDER BY id_dtl_nilai ASC ");
	$row = $db->db_num_rows($query2);
	?>

		<div class='grid-detail-nilai'>
			<p class='keterangan'>Detail Nilai -> Soal <?php echo $data1['nama_mapel']?> [<?php echo $data1['keterangan'];?>] , Kelas: <?php echo $data1['kelas'];?></p>
			<span class='jumlah'><?php echo "<b>N = $data1[nilai]</b> | B = $data1[benar] | S = $data1[salah]";?> || <?php echo $row ?> Soal</span>
			<div class='clear'></div>
		</div>

		<table border='0'>
	<?php
	$no = 1;
	while ($data2 = $db->db_fetch_array($query2)){ ?>
					
						<tr>
							<td><?php echo $no ?>.</td>
							<td><?php echo $data2['soal'] ?> </td> 
						</tr>
						
							<?php if ($data2['jawaban']=='A') { ?> <!-- JIka jawaban A [checked] -->
						<tr>
							<td></td>
							<?php if ($data2['pilihanA'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban' checked='checked'> A. <?php echo $data2['pilihanA']?></td> <?php } ?>
						</tr>
						<tr>
							<td></td>	
							<?php if ($data2['pilihanB'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> B. <?php echo $data2['pilihanB']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanC'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> C. <?php echo $data2['pilihanC']?></td> <?php } ?>
						</tr>
						<tr>
							<td></td>
							<?php if ($data2['pilihanD'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> D. <?php echo $data2['pilihanD']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanE'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> E. <?php echo $data2['pilihanE']?></td> <?php } ?>
							<!-- kunci jawaban -->
							<td><?php if ($data2['kunci_jawaban'] =='A'){ echo"Jawaban <b>Benar</b>,";} else {echo"Jawaban <b>Salah</b>,";}?> <?php echo "kunci jawaban = $data2[kunci_jawaban] ";?><td>
						</tr>
						<!-- -->


							<?php }  if ($data2['jawaban']=='B') { ?> <!-- JIka jawaban B [checked] -->
						<tr>
							<td></td>
							<?php if ($data2['pilihanA'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> A. <?php echo $data2['pilihanA']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanB'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban' checked='checked'> B. <?php echo $data2['pilihanB']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanC'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> C. <?php echo $data2['pilihanC']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanD'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> D. <?php echo $data2['pilihanD']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanE'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> E. <?php echo $data2['pilihanE']?></td> <?php } ?>
							<!-- kunci jawaban -->
							<td><?php if ($data2['kunci_jawaban'] =='B'){ echo"Jawaban <b>Benar</b>,";} else {echo"Jawaban <b>Salah</b>,";}?>  <?php echo "kunci jawaban = $data2[kunci_jawaban] ";?><td>
						</tr>
						<!-- -->

						
							<?php }  if ($data2['jawaban']=='C') { ?> <!-- JIka jawaban C [checked] -->
						<tr>	
							<td></td> 
							<?php if ($data2['pilihanA'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> A. <?php echo $data2['pilihanA']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanB'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> B. <?php echo $data2['pilihanB']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanC'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban' checked='checked'> C. <?php echo $data2['pilihanC']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanD'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> D. <?php echo $data2['pilihanD']?></td> <?php } ?>
						</tr>
							<td></td>
							<?php if ($data2['pilihanE'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> E. <?php echo $data2['pilihanE']?></td> <?php } ?>
							<!-- kunci jawaban -->
							<td><?php if ($data2['kunci_jawaban'] =='C'){ echo"Jawaban <b>Benar</b>,";} else {echo"Jawaban <b>Salah</b>,";}?> <?php echo "kunci jawaban = $data2[kunci_jawaban] ";?><td>
						</tr>
						<!-- -->

						
							<?php }  if ($data2['jawaban']=='D') { ?> <!-- JIka jawaban D [checked] -->
						<tr>	
							<td></td>
							<?php if ($data2['pilihanA'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> A. <?php echo $data2['pilihanA']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanB'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> B. <?php echo $data2['pilihanB']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanC'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> C. <?php echo $data2['pilihanC']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanD'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban' checked='checked'> D. <?php echo $data2['pilihanD']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanE'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> E. <?php echo $data2['pilihanE']?></td> <?php } ?>
							<!-- kunci jawaban -->
							<td><?php if ($data2['kunci_jawaban'] =='D'){ echo"Jawaban <b>Benar</b>,";} else {echo"Jawaban <b>Salah</b>,";}?> <?php echo "kunci jawaban = $data2[kunci_jawaban] ";?><td>
						</tr>
						<!-- -->

						
							<?php }  if ($data2['jawaban']=='E') { ?> <!-- JIka jawaban E [checked] -->
						<tr>
							<td></td>
							<?php if ($data2['pilihanA'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> A. <?php echo $data2['pilihanA']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanB'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> B. <?php echo $data2['pilihanB']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanC'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> C. <?php echo $data2['pilihanC']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanD'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> D. <?php echo $data2['pilihanD']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanE'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban' checked='checked'> E. <?php echo $data2['pilihanE']?></td> <?php } ?>
							<!-- kunci jawaban -->
							<td><?php if ($data2['kunci_jawaban'] =='E'){ echo"Jawaban <b>Benar</b>,";} else {echo"Jawaban <b>Salah</b>,";}?> <?php echo "kunci jawaban = $data2[kunci_jawaban] ";?><td>
						</tr>
						<!-- -->

						
							<?php }  if ($data2['jawaban']=='') { ?> <!-- JIka jawaban kosong -->
						<tr>
							<td></td>
							<?php if ($data2['pilihanA'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> A. <?php echo $data2['pilihanA']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanB'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> B. <?php echo $data2['pilihanB']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanC'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> C. <?php echo $data2['pilihanC']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanD'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> D. <?php echo $data2['pilihanD']?></td> <?php } ?>
						</tr>
						<tr>	
							<td></td>
							<?php if ($data2['pilihanE'] !=''){ ?> <td><input type="radio" name="jawaban<?php echo $data2['id_soal'] ;?>" id='jawaban'> E. <?php echo $data2['pilihanE']?></td> <?php } ?>
							<!-- kunci jawaban -->
							<td>Jawaban <b>Salah</b>, <?php echo "kunci jawaban = $data2[kunci_jawaban] ";?><td>
							<?php } ?>
						</tr>
						<!-- -->


						<?php
						$no++; 
						} ?> 
					</table>
		<?php
}

?>