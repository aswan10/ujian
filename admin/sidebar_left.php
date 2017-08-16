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
        </script>
		<!-- And interktif sidebar -->


<div id='grid-left'>
	<div class='grid-main'>
		<div id="JudulLink1"><p class='judul'>Dashboard <img src='images/arrow_down_white.png' class='menu-icon'></p></div>
		<div class="link1">
			<a href='home'><img src='images/home.png' class='list-icon'>Home</a>
			<a href='profile'><img src='images/profile.png' class='list-icon'>Profile</a>
		</div>
	</div>

	<div class='grid-main'>
		<div id="JudulLink2"><p class='judul'>Master <img src='images/arrow_down_white.png' class='menu-icon'></p></div>
		<div class="link2" style='display:none;'>
            <a href='admin'><img src='images/assignment.png' class='list-icon'>Admin</a>
            <a href='user'><img src='images/assignment.png' class='list-icon'>User</a>
            <a href='kelas'><img src='images/assignment.png' class='list-icon'>Kelas</a>
            <a href='mata-pelajaran'><img src='images/assignment.png' class='list-icon'>Mata Pelajaran</a>
            <a href='soal'><img src='images/assignment.png' class='list-icon'>Soal</a>
            <a href='nilai'><img src='images/assignment.png' class='list-icon'>Nilai</a>
		</div>
	</div>

</div>