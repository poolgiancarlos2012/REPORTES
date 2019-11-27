<?php

session_start();
$_SESSION['logeo']="";
$_SESSION['activo']="";
session_unset();
session_destroy();
unset($_SESSION['logeo']);
unset($_SESSION['activo']);
header('Location:index.php');
?>