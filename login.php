<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">

	<title>Login User</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
	
	<link rel="stylesheet" href="css/login.css">

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>

    <div id="login">
        <h3>Aplikasi Ujian Online</h3>
        <form action="validasi_login.php" method="POST">

            <fieldset class="clearfix">

                <?php
                if(@$_GET['code'] == 1) {
                ?>
                <div class="alert alert-danger">
                    Username or Password Wrong !!!
                </div>
                <?php
                }
                if(@$_GET['code'] == 2) {
                ?>
                <div class="alert alert-success">
                    Anda Telah Keluar (Logout)
                </div>
                <?php
                }
                if(@$_GET['code'] == 3) {
                ?>
                <div class="alert alert-danger">
                    Anda harus Login dulu !!!
                </div>
                <?php
                }
                ?>
                
                <p><span class="fontawesome-user"></span><input type="text" name='username' placeholder='Username' onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
                <p><span class="fontawesome-lock"></span><input type="password"  name='password' placeholder='Password' onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
                <p><input type="submit" name="submit" value="Sign In"></p>

            </fieldset>

        </form>
        
       <!--  <p>Not a member? <a href="#">Sign up now</a><span class="fontawesome-arrow-right"></span></p> -->

    </div> <!-- end login -->

</body>
</html>