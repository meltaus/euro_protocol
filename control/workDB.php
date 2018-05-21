<?php


class workDB
{
    private $conn;

    //Конструктор. Подключаемся к базе
    public function __construct()
    {
        require_once '../settings/connectionDB.php';
        $connectionInfo = array("UID" => $user, "PWD" => $password, "Database"=>$database, "APP"=>$nameApp, "CharacterSet"=>$charset);
        $this->conn = sqlsrv_connect( $host, $connectionInfo);
    }

    //Закрываем подключение
    public function __destruct()
    {
        if( $this->conn )
        {
            sqlsrv_close($this->conn);
        }
    }
}