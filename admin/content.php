<?php
include "koneksi.php";
include "fungsi/fungsi_library.php";
include "fungsi/fungsi_indotgl.php";
include "fungsi/fungsi_validasi_js.php";

if (isset($_GET['home'])){ 
	$query = $db->db_query("SELECT * FROM t_admin WHERE username ='$_SESSION[Username]' ");
	$data = $db->db_fetch_array($query);
	?>
		<div class='home'>
			<p><b>Selamat Datang di Aplikasi Ujian Online</b></p>
			<br>
			<p>Aplikasi ini dibuat untuk mempermudah Siswa atau Mahasiswa dalam mengerjakan soal ujian atau soal latihan.</p>
			<p>Pilih kanten ada di sebelah kiri.</p>
			<br>
			<p>- Sukses -</p> 
		</div>
		<div class='spasi'></div>
		login sebagai: <b><?php echo $data['username']?></b> | <?php echo "".substr($waktu_sekarang,8,2)." ".$format_tanggal->get_bulan(substr($waktu_sekarang,5,2))." ".substr($waktu_sekarang,0,4).", $jam_sekarang ";?>
	<?php
}


elseif (isset($_GET['profile'])) {
		$query1 = $db->db_query("SELECT * FROM t_admin WHERE username ='$_SESSION[Username]' ");
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
 				<img src='images/<?php echo"$data1[foto]";?>'>
			</div>

			<table class='table-profile'>
				<tr>
					<td><label>Username</label></td>
					<td>:</td>
					<td><?php echo $data1['username'];?></td>
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
					<formmm method='POST' action='aksi/aksi_ubah_profile.php' name='ubah-profile' enctype='multipart/form-data'> <!-- non aktif (utk aktif ganti nama form) -->
					<table class='table-ubah-profile'>
						<tr>
							<td><input type='text' name='username' placeholder='Username' maxlength='50' required></td>
						</tr>
						<tr>
							<td><input type='text' name='old_password' placeholder='Old Password' maxlength='50' required></td>
						</tr>
						<tr>
							<td><input type='text' name='new_password' placeholder='New Password' maxlength='50' required></td>
						</tr>
						<tr>
							<td><label>Ganti gambar</label> <input type='file' name='image' id='image' class='edit-gambar'></td>
						</tr>
						<tr>
							<td><input type='submit' name='submit' title='Tombol Non Aktif' value='Ubah' onClick="return confirm('Apakah Anda yakin ingin mengganti Profile?')"></td>
							<td>* Abaikan jika tidak di Ubah</td>
						</tr>
					</table>
					</form>
				</div>
		
			<div class='clear'></div>
		</div>
	<?php
}


elseif (isset($_GET['admin'])) { 
		$query = $db->db_query("SELECT * FROM t_admin ORDER BY id ASC ");
		$row = $db->db_num_rows($query);
		?>

		<div class='grid-judul'>
			<p class='keterangan'>Tabel Admin</p>
			<span class='jumlah'><?php echo $row ?> Admin</span>
			<div class='clear'></div>
		</div>

		<table class='table-master'>
			<tr>
				<th>No.</th>
				<th>Username</th>
				<th>Password</th>
				<th>Status</th>
				<th>Dibuat</th>
				<th colspan='2'>Action</th>
			</tr>
		<?php
		$no =1;
		while ($data = $db->db_fetch_array($query)) {
			echo "
			<tr>
				<td>$no</td>
				<td>$data[username]</td>
				<td>$data[password]</td>
				<td>$data[status]</td>
				<td>".substr($data['created_admin'],8,2)." ".$format_tanggal->get_bulan(substr($data['created_admin'],5,2))." ".substr($data['created_admin'],0,4).", ".substr($data['created_admin'],10,17)."</td>
				<td><ahref='#' title='Tombol Non Aktif'>Edit</a></td>
				<td><ahref='#' title='Tombol Non Aktif'>Delete</a></td>
			</tr>";
			$no++;
		}
		?>
		</table> 
		<?php
}



elseif (isset($_GET['user'])) { 
		$query = $db->db_query("SELECT id_user,username,password,kelas,foto,t_user.status,created_user FROM t_user INNER JOIN t_kelas ON t_kelas.id_kelas = t_user.kelas_id ORDER BY t_user.status ASC, id_user ASC ");
		$row = $db->db_num_rows($query);
		?>

		<div class='grid-judul'>
			<p class='keterangan'>Tabel User</p>
			<span class='jumlah'><?php echo $row ?> User</span>
			<div class='clear'></div>
		</div>

		<div class='grid-tambah'>
			<a href='admin.php?add-user'>+ Add User</a>
		</div>

		<table class='table-master'>
			<tr>
				<th>No.</th>
				<th>Username</th>
				<th>Password</th>
				<th>Kelas</th>
				<th>Gambar</th>
				<th>Status</th>
				<th>Dibuat</th>
				<th colspan='2'>Action</th>
			</tr>
		<?php
		$no =1;
		while ($data = $db->db_fetch_array($query)) {
			echo "
			<tr>
				<td>$no</td>
				<td>$data[username]</td> 
				<td>$data[password]</td>
				<td>$data[kelas]</td>
				<td>"; if ($data['foto'] =='') { echo"<img src='../images/anak sekolah.jpg' width='30px' height='30px'>";}
					elseif ($data['foto'] !='') { echo"<img src='..images/$data[foto]' width='30px' height='30px'>";} 
				echo"
				</td>
				<td>$data[status]</td>
				<td>".substr($data['created_user'],8,2)." ".$format_tanggal->get_bulan(substr($data['created_user'],5,2))." ".substr($data['created_user'],0,4).", ".substr($data['created_user'],10,17)."</td>
				<td><a href='admin.php?edit-user&id=$data[id_user]'>Edit</a></td>"; ?>
				<td><a href='aksi/aksi_user.php?mod=delete&id=<?php echo $data['id_user']?>' onclick="return confirm('Anda yakin ingin menghapus data ?')">Delete</a></td>
			</tr>
			<?php
			$no++;
		}
		?>
		</table> 
		<?php
}



elseif (isset($_GET['kelas'])) { 
		$query = $db->db_query("SELECT * FROM t_kelas ORDER BY status ASC, id_kelas ASC ");
		$row = $db->db_num_rows($query);
		?>

		<div class='grid-judul'>
			<p class='keterangan'>Tabel Kelas</p>
			<span class='jumlah'><?php echo $row ?> Kelas</span>
			<div class='clear'></div>
		</div>

		<div class='grid-tambah'>
			<a href='admin.php?add-kelas'>+ Add Kelas</a>
		</div>

		<table class='table-master'>
			<tr>
				<th>No.</th>
				<th>Kelas</th>
				<th>Status</th>
				<th>Jml User</th>
				<th>Dibuat</th>
				<th colspan='2'>Action</th>
			</tr>
		<?php
		$no =1;
		while ($data = $db->db_fetch_array($query)) {

			$sql = $db->db_query("SELECT COUNT(kelas_id) AS jmlUser FROM t_user WHERE kelas_id ='$data[id_kelas]' ");
			$data1 = $db->db_fetch_array($sql);

			echo "
			<tr>
				<td>$no</td>
				<td>$data[kelas]</td>
				<td>$data[status]</td>
				<td>$data1[jmlUser]</td>
				<td>".substr($data['created_kelas'],8,2)." ".$format_tanggal->get_bulan(substr($data['created_kelas'],5,2))." ".substr($data['created_kelas'],0,4).", ".substr($data['created_kelas'],10,17)."</td>
				<td><a href='admin.php?edit-kelas&id=$data[id_kelas]'>Edit</a></td>"; ?>
				<td><a href='aksi/aksi_kelas.php?mod=delete&id=<?php echo $data['id_kelas']?>' onclick="return confirm('Anda yakin ingin menghapus data ?')">Delete</a></td>
			</tr>
			<?php
			$no++;
		}
		?>
		</table> 
		<?php
}



elseif (isset($_GET['mapel'])) { 
		$query = $db->db_query("SELECT id_mapel,nama_mapel,keterangan,kelas,t_matapelajaran.status,created_mapel FROM t_matapelajaran INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id ORDER BY t_matapelajaran.status ASC, id_mapel ASC ");
		$row = $db->db_num_rows($query);
		?>

		<div class='grid-judul'>
			<p class='keterangan'>Tabel Mata Pelajaran</p>
			<span class='jumlah'><?php echo $row ?> Mata Pelajaran</span>
			<div class='clear'></div>
		</div>

		<div class='grid-tambah'>
			<a href='admin.php?add-mapel'>+ Add Mapel</a>
		</div>

		<table class='table-master'>
			<tr>
				<th>No.</th>
				<th>Mata Pelajaran</th>
				<th>Keterangan</th>
				<th>Jml Soal</th>
				<th>Kelas</th>
				<th>Status</th>
				<th>Dibuat</th>
				<th colspan='2'>Action</th>
			</tr>
		<?php
		$no =1;
		while ($data = $db->db_fetch_array($query)) {
			$query1 = $db->db_query("SELECT mapel_id FROM t_soal WHERE mapel_id ='$data[id_mapel]' ");
			$row1 = $db->db_num_rows($query1);

			echo "
			<tr>
				<td>$no</td>
				<td>$data[nama_mapel]</td> 
				<td>$data[keterangan]</td>
				<td><b>$row1</b></td>
				<td>$data[kelas]</td>
				<td>$data[status]</td>
				<td>".substr($data['created_mapel'],8,2)." ".$format_tanggal->get_bulan(substr($data['created_mapel'],5,2))." ".substr($data['created_mapel'],0,4).", ".substr($data['created_mapel'],10,17)."</td>
				<td><a href='admin.php?edit-mapel&id=$data[id_mapel]'>Edit</a></td>";?>
				<td><a href='aksi/aksi_mapel.php?mod=delete&id=<?php echo "$data[id_mapel]";?>' onclick="return confirm('Anda yakin ingin menghapus data ?')">Delete</a></td>
			</tr>
			<?php
			$no++;
		}
		?>
		</table> 
		<?php
}



elseif (isset($_GET['soal'])){ 

                $query = $db->db_query("SELECT DISTINCT id_mapel, nama_mapel,keterangan,kelas,t_matapelajaran.status,created_mapel FROM t_matapelajaran 
                INNER JOIN t_soal ON t_soal.mapel_id = t_matapelajaran.id_mapel 
                INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id 
                ORDER BY t_matapelajaran.status ASC, id_mapel ASC");
                $row = $db->db_num_rows($query);
          		?>

				<div class='grid-judul'>
					<p class='keterangan'>Tabel Soal</p>
					<span class='jumlah'><?php echo $row ?> Mata Pelajaran</span>
					<div class='clear'></div>
				</div>

				<div class='grid-tambah'>
					<a href='admin.php?add-master-soal'>+ Add Master Soal</a>
				</div>

				<table class='table-master'>
					<tr>
						<th>No.</th>
						<th>Mata Pelajaran</th>
						<th>Keterangan</th>
						<th>Kelas</th>
						<th>Jml Soal</th>
						<th>Status</th>
						<th>Tanggal Mapel</th>
						<th colspan='2'>Action</th>
					</tr>
					<?php
					$no = 1;
					while ($data = $db->db_fetch_array($query)){
					$query1 = $db->db_query("SELECT * FROM t_soal WHERE mapel_id ='$data[id_mapel]' ");
               		$row1 = $db->db_num_rows($query1);
					echo "
					<tr>
						<td>$no</td>
						<td>$data[nama_mapel]</td>
						<td>$data[keterangan]</td>
						<td>$data[kelas]</td>
						<td><b>$row1</b></td>
						<td>$data[status]</td>
						<td>".substr($data['created_mapel'],8,2)." ".$format_tanggal->get_bulan(substr($data['created_mapel'],5,2))." ".substr($data['created_mapel'],0,4).", ".substr($data['created_mapel'],10,17)."</td>
						<td><a href='admin.php?detail-soal&id=$data[id_mapel]'>Detail</a></td>
						<td><a href='admin.php?detail-soal&id=$data[id_mapel]&act=add-soal'>+ Add Soal</a></td>
					</tr>";
					$no++;				
					}
					?>
				</table>
			<?php
}



elseif (isset($_GET['detail-soal'])){ 

					$query = $db->db_query("SELECT * FROM t_soal INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_soal.mapel_id 
					INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id 
					WHERE mapel_id ='$_GET[id]'");
					$mapel = $db->db_fetch_array($query);
					$row = $db->db_num_rows($query);
					?>

					<div class='grid-judul'>
						<p class='keterangan'>Soal <?php echo $mapel['nama_mapel']?> [<?php echo $mapel['keterangan'];?>] , Kelas: <?php echo"$mapel[kelas]";?></p>
						<span class='jumlah'><?php echo $row ?> Soal</span>
						<div class='clear'></div>
					</div>

					<div class='grid-tambah'>
						<a href='admin.php?detail-soal&id=<?php echo"$mapel[id_mapel]";?>&act=add-soal'>+ Add Soal</a>
					</div>

					<table name='soal' class='table-soal'>

						<?php 
							$no =1;
							
							$sql = $db->db_query("SELECT * FROM t_soal INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_soal.mapel_id 
							WHERE id_mapel = '$_GET[id]' ORDER BY id_soal ");
							$jml = $db->db_num_rows($sql);

							while ($data = $db->db_fetch_array($sql)){
						?>

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
						<tr>
							<td></td>
							<td><b>Kunci Jawaban = <?php echo $data['kunci_jawaban'];?></b></td>
						</tr>
						<tr>
							<td></td>
							<td><b><a href='admin.php?edit-soal&id=<?php echo $data['id_soal'];?>' class='aksi-action'>Edit</a></b> &nbsp; 
								<b><a href='aksi/aksi_soal.php?mod=delete&id=<?php echo "$data[id_soal]";?>&m=<?php echo $data['id_mapel'];?>' onclick="return confirm('Anda yakin ingin menghapus data ?')" class='aksi-action'>Delete</a></b></td>
						</tr>
						<?php
						$no++; 
						} ?> 
					</table>

			<?php // Tambah Soal
			switch (@$_GET['act']) {
		 	case 'add-soal': 

					 		$query = $db->db_query("SELECT * FROM t_soal INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_soal.mapel_id 
							INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id 
							WHERE mapel_id ='$_GET[id]'");
							$mapel = $db->db_fetch_array($query);
							$row = $db->db_num_rows($query);
							?>
							<br>
				 			<div class='grid-judul'>
								<p class='keterangan'>Add / Tambah Soal <?php echo $mapel['nama_mapel']?> [<?php echo $mapel['keterangan'];?>] , Kelas: <?php echo"$mapel[kelas]";?></p>
								<span class='jumlah'><?php echo $row ?> Soal</span>
								<div class='clear'></div>
							</div>

							<form method='POST' action='aksi/aksi_soal.php?mod=add' onsubmit="return formValidator()">
								<table class='table-aksi'>
									<input type='hidden' name='id_mapel' value='<?php echo $mapel['id_mapel'];?>'>
									<tr>
										<td><label>No.</label></td>
										<td><input type='text' value='<?php echo $row+1;?>' disabled='disabled'></td>
									</tr>
									<tr>
										<td><label>Soal</label></td>
										<td><textarea type='textarea' name='soal' placeholder='Isi Soal' maxlength='5000' cols='60' rows='8' autofocus></textarea></td>
									</tr>
									<tr>
										<td><label>Pilihan A</label></td>
										<td><input type='text' name='pilihanA' placeholder='Pilihan A' maxlength='1000'></td>
									</tr>
									<tr>
										<td><label>Pilihan B</label></td>
										<td><input type='text' name='pilihanB' placeholder='Pilihan B' maxlength='1000'></td>
									</tr>
									<tr>
										<td><label>Pilihan C</label></td>
										<td><input type='text' name='pilihanC' placeholder='Pilihan C' maxlength='1000'></td>
									</tr>
									<tr>
										<td><label>Pilihan D</label></td>
										<td><input type='text' name='pilihanD' placeholder='Pilihan D' maxlength='1000'></td>
									</tr>
									<tr>
										<td><label>Pilihan E</label></td>
										<td><input type='text' name='pilihanE' placeholder='Pilihan E' maxlength='1000'></td>
									</tr>
									<tr>
										<td></td>
										<td>* Abaikan Pilihan jika tidak difungsikan</td>
									</tr>
									<tr>
										<td><label>Kunci jawaban</label></td>
										<td><input type='text' id='Kunci_jawaban' name='kunci_jawaban' placeholder='Kunci Jawaban' maxlength='1'></td>
									</tr>
									<tr>
										<td></td>	
										<td>* Contoh: A/B/C/D/E </td>
									</tr>
									<tr>
										<td></td>
										<td><input type='submit' name='submit' value='Tambah Soal' onClick="return confirm('Apakah Anda yakin ingin Tambah Data?')"></td>
									</tr>
								</table>
							</form>
						<?php
				 		break;
				}
}



elseif (isset($_GET['nilai'])) { 

			$query = $db->db_query("SELECT * FROM t_nilai INNER JOIN t_user ON t_user.id_user = t_nilai.user_id
				INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_nilai.mapel_id
				INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id 
			 	ORDER BY user_id ASC ");
			$row = $db->db_num_rows($query);
			?>

			<div class='grid-judul'>
				<p class='keterangan'>Tabel Nilai</p>
				<span class='jumlah'><?php echo $row ?> Nilai</span>
				<div class='clear'></div>
			</div>

			<table class='table-master'>
				<tr>
					<th>No.</th>
					<th>Nama</th>
					<th>Kelas</th>
					<th>Mata Pelajaran</th>
					<th>Keterangan</th>
					<th>Nilai</th>
					<th>Tanggal</th>
					<th colspan='3'>Action</th>
				</tr>
			<?php
			$no = 1;
			while ($data = $db->db_fetch_array($query)){
			echo "
				<tr>
					<td>$no</td>
					<td>$data[username]</td>
					<td>$data[kelas]</td>
					<td>$data[nama_mapel]</td>
					<td>$data[keterangan]</td>
					<td><b>$data[nilai]</b></td>
					<td>".substr($data['created_nilai'],8,2)." ".$format_tanggal->get_bulan(substr($data['created_nilai'],5,2))." ".substr($data['created_nilai'],0,4).", ".substr($data['created_nilai'],10,17)."</td>
					<td><a href='detail-nilai&id=$data[id_nilai]'>Detail</a></td>
					<td><a href='admin.php?edit-nilai&id=$data[id_nilai]'>Edit</a></td>"; ?>
					<td><a href='aksi/aksi_nilai.php?mod=delete&id=<?php echo "$data[id_nilai]";?>' onclick="return confirm('Anda yakin ingin menghapus data ?')">Delete</a></td>
				</tr>
			<?php	
			$no++;				
			}
			?>
			</table>

			<?php 
}




elseif (isset($_GET['detail-nilai'])) {

	$query1 = $db->db_query("SELECT * FROM t_nilai INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_nilai.mapel_id
	INNER JOIN t_user ON t_user.id_user = t_nilai.user_id
	INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id 
	WHERE id_nilai ='$_GET[id]' ");
	$data1 = $db->db_fetch_array($query1);

	$query2 = $db->db_query("SELECT * FROM t_detail_nilai 
	INNER JOIN t_soal ON t_soal.id_soal = t_detail_nilai.soal_id
	WHERE user_id ='$data1[user_id]' AND created_dtl_nilai ='$data1[created_nilai]' ");
	$row = $db->db_num_rows($query2);
	?>

		<div class='grid-judul'>
			<p class='keterangan'>Detail Nilai : <?php echo $data1['username'];?> , Kelas: <?php echo"$data1[kelas]";?> <br> Soal <?php echo $data1['nama_mapel']?> [<?php echo $data1['keterangan'];?>] :</p>
			<span class='jumlah'><?php echo "N = $data1[nilai], B = $data1[benar], S = $data1[salah]";?> || <?php echo $row ?> Soal</span>
			<div class='clear'></div>
		</div>

		<table>
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










/************* BAGIAN ADD *************/

elseif (isset($_GET['add-user'])) { ?>
	
	<div class='grid-judul'>
		<p class='keterangan'>Tambah User</p>
		<div class='clear'></div>
	</div>	

	<form method='POST' action='aksi/aksi_user.php?mod=add' enctype='multipart/form-data'>
		<table class='table-aksi'>
			<tr>
				<td><label>Username</label></td>
				<td><input type='text' name='nama' placeholder='Username' maxlength='50' required></td>
			</tr>
			<tr>
				<td><label>Password</label></td>
				<td><input type='text' name='password' placeholder='Password' maxlength='50' required></td>
			</tr>
			<tr>
				<td><label>Kelas</label></td>
				<td><select name='kelas' required>
						<option value=''>-Pilih Kelas-</option>
							<?php $sql = $db->db_query("SELECT * FROM t_kelas WHERE status ='A' ");
							while ($data = $db->db_fetch_array($sql)){?>
						<option value='<?php echo $data['id_kelas'];?>'><?php echo $data['kelas'];}?></option>
					</select>
				</td>
			</tr>
			<!-- <tr>
				<td><label>Foto</label></td>
				<td><input type='file' name='foto1'></td>
			</tr> -->
			<tr>
				<td><label>Status</label></td>
				<td><input type='radio' name='status' value='A'>A &nbsp;
				<input type='radio' name='status' value='N'>N</td>
			</tr>
			<tr>
				<td></td>
				<td><input type='submit' name='submit' value='Tambah' onClick="return confirm('Apakah Anda yakin ingin Tambah Data?')"></td>
			</tr>
		</table>
	</form>
<?php
}



elseif (isset($_GET['add-kelas'])) { ?>

	<div class='grid-judul'>
		<p class='keterangan'>Tambah Kelas</p>
		<div class='clear'></div>
	</div>	

	<form method='POST' action='aksi/aksi_kelas.php?mod=add'>
		<table class='table-aksi'>
			<tr>
				<td><label>Kelas</label></td>
				<td><input type='text' name='kelas' placeholder='Nama Kelas' maxlength='50' required></td>
			</tr>
			<tr>
				<td><label>Status</label></td>
				<td><input type='radio' name='status' value='A'>A &nbsp;
				<input type='radio' name='status' value='N'>N</td>
			</tr>
			<tr>
				<td></td>
				<td><input type='submit' name='submit' value='Tambah' onClick="return confirm('Apakah Anda yakin ingin Tambah Data?')"></td>
			</tr>
		</table>
	</form>
	<?php
}



elseif (isset($_GET['add-mapel'])) { ?>

	<div class='grid-judul'>
		<p class='keterangan'>Tambah Mata Pelajaran</p>
		<div class='clear'></div>
	</div>

		<form method='POST' action='aksi/aksi_mapel.php?mod=add'>
		<table class='table-aksi'>
			<tr>
				<td><label>Mata Pelajaran</label></td>
				<td><input type='text' name='mapel' placeholder='Mata Pelajaran' maxlength='100' required></td>
			</tr>
			<tr>
				<td><label>Keterangan</label></td>
				<td><input type='text' name='ket' placeholder='Keterangan' maxlength='200' required></td>
			</tr>
			<tr>
				<td><label>Kelas</label></td>
				<td><select name='kelas' required>
						<option value=''>-Pilih Kelas-</option>
							<?php $sql = $db->db_query("SELECT * FROM t_kelas WHERE status ='A' ");
							while ($data = $db->db_fetch_array($sql)){?>
						<option value='<?php echo $data['id_kelas'];?>'><?php echo $data['kelas'];}?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Status</label></td>
				<td><input type='radio' name='status' value='A'>A &nbsp;
				<input type='radio' name='status' value='N'>N</td>
			</tr>
			<tr>
				<td></td>
				<td><input type='submit' name='submit' value='Edit' onClick="return confirm('Apakah Anda yakin ingin Tambah Data?')"></td>
			</tr>
		</table>
	</form>
	<?php
}




elseif (isset($_GET['add-master-soal'])) { ?>

	<div class='grid-judul'>
		<p class='keterangan'>Tambah Master Soal</p>
		<div class='clear'></div>
	</div>

		<?php
			$sql = $db->db_query("SELECT DISTINCT mapel_id FROM t_soal ");

			// query untuk mendapatkan id mapel selain di mapel_id di table t_soal.
			$q = "SELECT * FROM t_matapelajaran INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id WHERE t_matapelajaran.status ='A' "; 

			while ($res = $db->db_fetch_array($sql)) {
			$mapel = " AND id_mapel != '$res[0]'";
				// echo "$mapel <br>";
			$q .= " $mapel";
			}

				// echo $q;
			$query = $db->db_query($q);
				
		?>

		<form method='POST' action='aksi/aksi_soal.php?mod=add-master' onsubmit="return formValidator()">
			<table class='table-aksi'>
				<tr>
					<td><label>No.</label></td>
					<td><input type='text' value='1' disabled='disabled'></td>
				</tr>
				<tr>
					<td><label>Mata Pelajaran</label></td>
					<td><select name='id_mapel' class='mapel' required>
							<option value=''>-Pilih Mapel-</option>
							<?php while ($data = $db->db_fetch_array($query)) { echo"
							<option value='$data[id_mapel]'>$data[nama_mapel] - $data[keterangan] - Kelas: $data[kelas]</option>"; } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><label>Soal</label></td>
					<td><textarea type='textarea' name='soal' placeholder='Isi Soal' maxlength='5000' cols='60' rows='8' autofocus></textarea></td>
				</tr>
				<tr>
					<td><label>Pilihan A</label></td>
					<td><input type='text' name='pilihanA' placeholder='Pilihan A' maxlength='1000'></td>
				</tr>
				<tr>
					<td><label>Pilihan B</label></td>
					<td><input type='text' name='pilihanB' placeholder='Pilihan B' maxlength='1000'></td>		
				</tr>
				<tr>
					<td><label>Pilihan C</label></td>
					<td><input type='text' name='pilihanC' placeholder='Pilihan C' maxlength='1000'></td>
				</tr>
				<tr>
					<td><label>Pilihan D</label></td>
					<td><input type='text' name='pilihanD' placeholder='Pilihan D' maxlength='1000'></td>
				</tr>
				<tr>
					<td><label>Pilihan E</label></td>
					<td><input type='text' name='pilihanE' placeholder='Pilihan E' maxlength='1000'></td>
				</tr>
				<tr>
					<td></td>
					<td>* Abaikan Pilihan jika tidak difungsikan</td>
				</tr>
				<tr>
					<td><label>Kunci jawaban</label></td>
					<td><input type='text' id='Kunci_jawaban' name='kunci_jawaban' placeholder='Kunci Jawaban' maxlength='1'></td>
				</tr>
				<tr>
					<td></td>	
					<td>* Contoh: A/B/C/D/E </td>
				</tr>
				<tr>
					<td></td>
					<td><input type='submit' name='submit' value='Tambah Soal' onClick="return confirm('Apakah Anda yakin ingin Tambah Data?')"></td>
				</tr>
			</table>
		</form>
		<?php
}

















/************ BAGIAN EDIT *************/

elseif (isset($_GET['edit-user'])) {
	$query = $db->db_query("SELECT * FROM t_user WHERE id_user ='$_GET[id]' ");
	$data = $db->db_fetch_array($query);
	?>

	<div class='grid-judul'>
		<p class='keterangan'>Edit User</p>
		<div class='clear'></div>
	</div>	

	<form method='POST' action='aksi/aksi_user.php?mod=edit' enctype='multipart/form-data'>
		<table class='table-aksi'>
			<input type='hidden' name='id_user' value='<?php echo $data['id_user']?>'>
			<tr>
				<td><label>Username</label></td>
				<td><input type='text' name='nama' value='<?php echo $data['username']?>' maxlength='50' required></td>
			</tr>
			<tr>
				<td><label>Password</label></td>
				<td><input type='text' name='pass1' value='<?php echo $data['password']?>' disabled='disabled'></td>
			</tr> 
			<tr>
				<td><label>Kelas</label></td>
				<td>
					<select name='kelas' required >
						<?php 	
							$sql = $db->db_query("SELECT * FROM t_kelas WHERE status ='A' ");
							while ( $data1 = $db->db_fetch_array($sql)) {
							if ( $data['kelas_id'] == $data1['id_kelas']){
								echo"<option value=$data1[id_kelas] SELECTED >$data1[kelas]</option>"; }
							else {
								echo "<option value=$data1[id_kelas]>$data1[kelas]</option>"; }
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Ganti Password</label></td>
				<td><input type='text' name='pass2' placeholder='New Password' maxlength='50'></td>
			</tr>
			<tr>	
				<td></td>
				<td>* Abaikan password jika tidak di ganti</td>
			</tr>
			<tr>
				<td><label>Foto</label></td>
				<td><?php if ($data['foto'] =='') { echo"<img src='../images/anak sekolah.jpg' width='50px' height='50px'>";}
					elseif ($data['foto'] !='') { echo"<img src='..images/$data[foto]' width='50px' height='50px'>";} ?>
				</td>
			</tr>
			<!--<tr>
				<td><label>Ganti Foto</label></td>
				<td><input type='file' name='foto'></td>
			</tr> 
			<tr>
				<td></td>
				<td>* Abaikan Foto jika tidak di ganti</td>
			</tr> -->
			<tr>
				<td><label>Status</label></td>
				<td><input type='radio' name='status' value='A' <?php if ($data['status'] =='A'){ echo "CHECKED"; }?> >A &nbsp;
				<input type='radio' name='status' value='N' <?php if ($data['status'] == 'N'){ echo "CHECKED"; }?> >N</td>
			</tr>
			<tr>
				<td></td>
				<td><input type='submit' name='submit' value='Edit' onClick="return confirm('Apakah Anda yakin ingin Edit Data?')">
				<input type='reset' name='reset' value='Reset'></td>
			</tr>
		</table>
	</form>
	<?php
}



elseif (isset($_GET['edit-kelas'])) {
	$query = $db->db_query("SELECT * FROM t_kelas WHERE id_kelas ='$_GET[id]' ");
	$data = $db->db_fetch_array($query);
	?>

	<div class='grid-judul'>
		<p class='keterangan'>Edit Kelas</p>
		<div class='clear'></div>
	</div>	

	<form method='POST' action='aksi/aksi_kelas.php?mod=edit'>
		<table class='table-aksi'>
			<input type='hidden' name='id_kelas' value='<?php echo $data['id_kelas']?>'>
			<tr>
				<td><label>Kelas</label></td>
				<td><input type='text' name='kelas' value='<?php echo $data['kelas']?>' maxlength='50' required></td>
			</tr>
			<tr>
				<td><label>Status</label></td>
				<td><input type='radio' name='status' value='A' <?php if ($data['status'] =='A'){ echo "CHECKED"; }?> >A &nbsp;
				<input type='radio' name='status' value='N' <?php if ($data['status'] == 'N'){ echo "CHECKED"; }?> >N</td>
			</tr>
			<tr>
				<td></td>
				<td><input type='submit' name='submit' value='Edit' onClick="return confirm('Apakah Anda yakin ingin Edit Data?')">
				<input type='reset' name='reset' value='Reset'></td>
			</tr>
		</table>
	</form>
	<?php
}




elseif (isset($_GET['edit-mapel'])) {
	$query = $db->db_query("SELECT * FROM t_matapelajaran WHERE id_mapel ='$_GET[id]' ");
	$data = $db->db_fetch_array($query);
	$row = $db->db_num_rows($query);
	?>

	<div class='grid-judul'>
		<p class='keterangan'>Edit Mata Pelajaran</p>
		<div class='clear'></div>
	</div>

		<form method='POST' action='aksi/aksi_mapel.php?mod=edit'>
		<table class='table-aksi'>
			<input type='hidden' name='id_mapel' value='<?php echo $data['id_mapel']?>'>
			<tr>
				<td><label>Mata Pelajaran</label></td>
				<td><input type='text' name='mapel' value='<?php echo $data['nama_mapel']?>' maxlength='100' required></td>
			</tr>
			<tr>
				<td><label>Keterangan</label></td>
				<td><input type='text' name='ket' value='<?php echo $data['keterangan']?>' maxlength='200' required></td>
			</tr>
			<tr>
				<td><label>Kelas</label></td>
				<td>
					<select name='kelas' required >
						<?php 	
							$sql = $db->db_query("SELECT * FROM t_kelas WHERE status ='A' ");
							while ( $data1 = $db->db_fetch_array($sql)) {
							if ( $data['kelas_id'] == $data1['id_kelas']){
								echo"<option value=$data1[id_kelas] SELECTED >$data1[kelas]</option>"; }
							else {
								echo "<option value=$data1[id_kelas]>$data1[kelas]</option>"; }
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Status</label></td>
				<td><input type='radio' name='status' value='A' <?php if ($data['status'] =='A'){ echo "CHECKED"; }?> >A &nbsp;
				<input type='radio' name='status' value='N' <?php if ($data['status'] == 'N'){ echo "CHECKED"; }?> >N</td>
			</tr>
			<tr>
				<td></td>
				<td><input type='submit' name='submit' value='Edit' onClick="return confirm('Apakah Anda yakin ingin Edit Data?')">
				<input type='reset' name='reset' value='Reset'></td>
			</tr>
		</table>
	</form>
	<?php
}



elseif (isset($_GET['edit-soal'])) {
				$query = $db->db_query("SELECT * FROM t_soal INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_soal.mapel_id 
				WHERE id_soal ='$_GET[id]' ");
				$data = $db->db_fetch_array($query);
				?>

				<div class='grid-judul'>
					<p class='keterangan'>Edit Soal <?php echo "$data[nama_mapel] [$data[keterangan]] ";?></p>
					<div class='clear'></div>
				</div>	

				<form method='POST' action='aksi/aksi_soal.php?mod=edit' name='edit-soal' onsubmit="return formValidator()">
					<table class='table-aksi'>
						<input type='hidden' name='id_soal' value='<?php echo $data['id_soal'];?>'>
						<input type='hidden' name='id_mapel' value='<?php echo $data['id_mapel'];?>'>
						<tr>
							<td><label>Mata Pelajaran</label></td>
							<td><input type='text' name='mapel' value='<?php echo $data['nama_mapel'];?>' disabled='disabled'></td>
						</tr>
						<tr>
							<td><label>Keterangan</label></td>
							<td><input type='text' name='ket' value='<?php echo $data['keterangan'];?>' disabled='disabled'></td>
						</tr>
						<tr>
							<td><label>Soal</label></td>
							<td><textarea type='textarea' name='soal' placeholder='Isi Soal' cols='60' rows='8'><?php echo $data['soal'];?></textarea></td>
						</tr>
						<tr>
							<td><label>Pilihan A</label></td>
							<td><input type='text' name='pilihanA' value='<?php echo $data['pilihanA'];?>' placeholder='Pilihan A' maxlength='1000'></td>
						</tr>
						<tr>
							<td><label>Pilihan B</label></td>
							<td><input type='text' name='pilihanB' value='<?php echo $data['pilihanB'];?>' placeholder='Pilihan B' maxlength='1000'></td>
						</tr>
						<tr>
							<td><label>Pilihan C</label></td>
							<td><input type='text' name='pilihanC' value='<?php echo $data['pilihanC'];?>' placeholder='Pilihan C' maxlength='1000'></td>
						</tr>
						<tr>
							<td><label>Pilihan D</label></td>
							<td><input type='text' name='pilihanD' value='<?php echo $data['pilihanD'];?>' placeholder='Pilihan D' maxlength='1000'></td>
						</tr>
						<tr>
							<td><label>Pilihan E</label></td>
							<td><input type='text' name='pilihanE' value='<?php echo $data['pilihanE'];?>' placeholder='Pilihan E' maxlength='1000'></td>
						</tr>
						<tr>
							<td></td>
							<td>* Abaikan Pilihan jika tidak difungsikan</td>
						</tr>
						<tr>
							<td><label>Kunci jawaban</label></td>
							<td><input type='text' name='kunci_jawaban' id='Kunci_jawaban' value='<?php echo $data['kunci_jawaban'];?>' placeholder='Kunci Jawaban' maxlength='1'></td>				
						</tr>
						<tr>
							<td></td>	
							<td>* Contoh: A/B/C/D/E </td>
						</tr>
						<tr>
							<td></td>
							<td><input type='submit' name='submit' value='Edit' onClick="return confirm('Apakah Anda yakin ingin Edit Data?')">
								<input type='reset' name='reset' value='Reset'>
							</td>
						</tr>
					</table>
				</form>
		<?php
}



elseif (isset($_GET['edit-nilai'])) {
	$query = $db->db_query("SELECT * FROM t_nilai INNER JOIN t_user ON t_user.id_user = t_nilai.user_id
	INNER JOIN t_matapelajaran ON t_matapelajaran.id_mapel = t_nilai.mapel_id
	INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id 
	WHERE id_nilai ='$_GET[id]' ");
	$data = $db->db_fetch_array($query);
	$row = $db->db_num_rows($query);
	?>

	<div class='grid-judul'>
		<p class='keterangan'>Edit Nilai</p>
		<div class='clear'></div>
	</div>

		<form method='POST' action='aksi/aksi_nilai.php?mod=edit'>
		<table class='table-aksi'>
			<input type='hidden' name='id_nilai' value='<?php echo $data['id_nilai']?>'>
			<tr>
				<td><label>Nama</label></td>
				<td><input type='text' name='ket' value='<?php echo $data['username']?>' disabled='disabled'></td>
			</tr>
			<tr>
				<td><label>Mata Pelajaran</label></td>
				<td><input type='text' name='mapel' value='<?php echo $data['nama_mapel']?>' disabled='disabled'></td>
			</tr>
			<tr>
				<td><label>Keterangan</label></td>
				<td><input type='text' name='ket' value='<?php echo $data['keterangan']?>' disabled='disabled'></td>
			</tr>
			<tr>
				<td><label>Kelas</label></td>
				<td><input type='text' name='kelas' value='<?php echo $data['kelas']?>' disabled='disabled'></td>
			</tr>
			<tr>
				<td><label>Nilai</label></td>
				<td><input type='text' name='nilai' value='<?php echo $data['nilai']?>' placeholder='Nilai' maxlength='4'></td>
			</tr>
			<tr>
				<td></td>
				<td><input type='submit' name='submit' value='Edit' onClick="return confirm('Apakah Anda yakin ingin Edit Data?')">
				<input type='reset' name='reset' value='Reset'></td>
			</tr>
		</table>
	</form>
	<?php
}

?>