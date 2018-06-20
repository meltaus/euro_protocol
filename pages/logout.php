<?php
session_start();
//Выход из сессии
$_SESSION["is_auth"]=false;
session_destroy();
header("Refresh: 0; ../index.php");
?>