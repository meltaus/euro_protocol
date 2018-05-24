<?php
session_start();
if (isset($_SESSION['user_id'])){
    echo '<meta http-equiv="refresh" content="0; url=/control/checkAuth.php">';
}
include_once $_SERVER["DOCUMENT_ROOT"]."/pages/login.html";