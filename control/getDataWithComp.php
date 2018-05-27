<?php
//Получение списка всех имен для автодополнения
include $_SERVER["DOCUMENT_ROOT"] . "/control/workDB.php";
$workDB = new workDB();



switch ($_GET['mode']) {
    case 'user': // Имена пользователей для автозаполнения
        $fd = fopen("hello.txt", 'w') or die("не удалось создать файл");
        $str = "Привет мир";
        fwrite($fd, $_GET['mode']);
        fclose($fd);
        $columnName = array("name");
        $nameArray = $workDB->selectUniqueDataTable("user", $columnName);
        $iter = count($nameArray);
        $result = array();
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $nameArray[$i][0]);
        }
        echo json_encode($result);
        break;
}
?>