<?php
// error_reporting(0);

//koneksi ke database
include "koneksi.php";
include "fungsi/fungsi_injection.php";

$username = $injection->antiinjection($_POST['username']);
$password = $injection->antiinjection(md5($_POST['password']));

// query untuk mendapatkan record dari username di table user
$query = $db->db_query("SELECT * FROM t_admin WHERE username ='$username' AND password ='$password' AND status ='A' ");
$data = $db->db_fetch_array($query);

// cek kesesuian password t_user
if (($password== $data['password']) AND ($username==$data['username']))
	{
	
	// menyimpan username kedalam SESSION
	session_start();
	$_SESSION['Username'] = $data['username'];
	$_SESSION['Password'] = $data['password'];
	
	header('location: index.php');
	}

// username and password salah
else
	{
	header('location:login&code=1');
	}

?>



