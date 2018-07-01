<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/control/authClass.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/control/workDB.php';
$auth = new AuthClass();
$workDB = new workDB();
//проверяем авторизацию
if (isset($_SESSION['user_id'])) {
    echo $_SESSION['is_auth'];
    if ($auth->isAuth()) { // Если пользователь авторизован, приветствуем:
        $query = "SELECT * FROM permission_user WHERE user_id = ".$_SESSION['user_id'];
        $permission = $workDB->analysisResult($workDB->anyQueryDB($query));
        $_SESSION['permission'] = $permission[0];
        unset($workDB);
        echo '<meta http-equiv="refresh" content="0; url=../pages/user_space.php">';
    } else {
        unset($_SESSION['user_id']);
        echo "Вы не авторизованы";
        echo '<meta http-equiv="refresh" content="2; url=../index.php">';
    }
} else {
    $auth->auth($_POST["login"], $_POST["password"]);
    if ($auth->isAuth()) { // Если пользователь авторизован, приветствуем:
        echo '<meta http-equiv="refresh" content="0; url=../pages/user_space.php">';
    } else {
        unset($_SESSION['user_id']);
        echo "Вы не авторизованы";
        echo '<meta http-equiv="refresh" content="2; url=../index.php">';
    }
}

?>