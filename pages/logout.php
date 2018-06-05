<?php
//Выход из сессии
$_SESSION["is_auth"]=false;
header("Refresh: 0; ../index.php");
?>