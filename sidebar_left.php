        <!-- Interktif sidebar -->
		<script type="text/javascript" src="js/jquery-1.2.6.min.js" ></script>
		<script type="text/javascript">
            $(document).ready(function(){

                $("#JudulLink1").click(function(){
                    if ($(".link1").is(":hidden")){
                        $(".link1").slideDown("slow");
                    }
                    else{
                        $(".link1").slideUp("slow");
                    }
                });
                
            });

            $(document).ready(function(){

                $("#JudulLink2").click(function(){
                    if ($(".link2").is(":hidden")){
                        $(".link2").slideDown("slow");
                    }
                    else{
                        $(".link2").slideUp("slow");
                    }
                });
                
            });

            $(document).ready(function(){

                $("#JudulLink3").click(function(){
                    if ($(".link3").is(":hidden")){
                        $(".link3").slideDown("slow");
                    }
                    else{
                        $(".link3").slideUp("slow");
                    }
                });
                
            });
        </script>
		<!-- And interktif sidebar -->


<div id='grid-left'>
	<div class='grid-main'>
		<div id="JudulLink1"><p class='judul'>Dashboard <img src='images/arrow_down_white.png' class='menu-icon'></p></div>
		<div class="link1">
			<img src='images/home.png' class='list-icon'><a href='home'>Home</a>
			<img src='images/profile.png' class='list-icon'><a href='profile'>Profile</a>
		</div>
	</div>

	<div class='grid-main'>
		<div id="JudulLink2"><p class='judul'>Soal <img src='images/arrow_down_white.png' class='menu-icon'></p></div>
		<div class="link2" style='display:none;'>

            <?php 
                $no = 1;
                $query = $db->db_query("SELECT DISTINCT nama_mapel,id_mapel,keterangan FROM t_matapelajaran INNER JOIN t_soal ON t_soal.mapel_id = t_matapelajaran.id_mapel 
                    INNER JOIN t_kelas ON t_kelas.id_kelas = t_matapelajaran.kelas_id 
                    WHERE t_matapelajaran.kelas_id ='$_SESSION[kelas]' AND t_matapelajaran.status ='A' ");
                while ($data = $db->db_fetch_array($query)){
            ?>
			<span class='nomor'><?php echo $no++;?>.</span>
            <a href="<?php echo $data['id_mapel']?>-soal-<?php echo $data['nama_mapel']?>-<?php echo $data['keterangan']?>">Soal <?php echo $data['nama_mapel']?> [<span style='color:lightblue;'><?php echo $data['keterangan'];?></span>]</a>
            <?php } ?>
		</div>
	</div>

	<div class='grid-main'>
		<div id="JudulLink3"><p class='judul'>Nilai <img src='images/arrow_down_white.png' class='menu-icon'></p></div>
		<div class="link3" style='display:none;'>
            <?php
                $query1 = $db->db_query("SELECT * FROM  t_user WHERE username = '$_SESSION[username]' ");
                $data1 = $db->db_fetch_array($query1);

                $query2 = $db->db_query("SELECT * FROM t_nilai WHERE user_id = '$data1[id_user]' ");
                $row = $db->db_num_rows($query2);

                if ($row) { ?>
			        <img src='images/assignment.png' class='list-icon'><a href='nilai'>Nilai</a> <?php }
                else { echo "<img src='images/warning_black.png' class='list-icon'><a href='#'>Belum mengerjakan soal </a>"; } ?>
		</div>
	</div>
</div>