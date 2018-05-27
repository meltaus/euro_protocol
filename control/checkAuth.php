<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/control/authClass.php';
$auth = new AuthClass();
//проверяем авторизацию
if (isset($_SESSION['user_id'])) {
    echo $_SESSION['is_auth'];
    if ($auth->isAuth()) { // Если пользователь авторизован, приветствуем:
        echo '<meta http-equiv="refresh" content="0; url=../pages/user_space">';
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