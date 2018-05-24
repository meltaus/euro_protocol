<?php

class authClass
{
    private $_login = "demo"; //Устанавливаем логин
    private $_password = "demo"; //Устанавливаем пароль

    /**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     * @return boolean
     */
    public function isAuth()
    {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        } else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }

    public function auth($login, $password) {
        include_once $_SERVER["DOCUMENT_ROOT"]."/control/workDB.php";
        $workDB = new workDB();
        $columnName = array("id", "name", "passwd");
        $userArray = $workDB->selectDataTableWhere("user", $columnName, "WHERE name = '".$login."'");
        $iter = count($userArray);
        for ($i = 0; $i < $iter; $i++) {
            if (strcmp($password, $userArray[$i][2]) == 0) {
                $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
                $_SESSION["login"] = $login; //Записываем в сессию логин пользователя
                $_SESSION["user_id"] = $userArray[$i][0];   //user_id
                return true;
            }
        }
        return false;
    }
}

?>