<?php
session_start();
session_destroy();
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($password);

echo "<script language='JavaScript'>alert('Anda telah Keluar');</script>";
echo "<meta http-equiv='refresh' content='0; url=login&code=2'>";

?>