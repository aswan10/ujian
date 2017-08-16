<?php

//cek login
if (!isset($_SESSION['password']) && !isset($_SESSION['username']))
{
	echo "<h1>Nah.. Anda pasti mencoba akses halaman ini tanpa login ya?</h1>";
	header ('location:login&code=3');
}
?>