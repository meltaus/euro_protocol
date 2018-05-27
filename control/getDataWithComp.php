<?php
include $_SERVER["DOCUMENT_ROOT"] . "/control/workDB.php";
$workDB = new workDB();

switch ($_GET['mode']) {
    case 'user': // Имена пользователей для автозаполнения
        $columnName = array("name");
        $nameArray = $workDB->selectUniqueDataTable("user", $columnName);
        $iter = count($nameArray);
        $result = array();
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $nameArray[$i][0]);
        }
        echo json_encode($result);
        break;

    case 'people': // ФИО всех возможных участников
        $columnName = array("name");
        $nameArray = $workDB->selectUniqueDataTable("people", $columnName);
        $iter = count($nameArray);
        $result = array();
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $nameArray[$i][0]);
        }
        echo json_encode($result);
        break;

    case 'state_car_number': // Гос. Номера всех возожных участников
        $columnName = array("state_car_number");
        $nameArray = $workDB->selectUniqueDataTable("people", $columnName);
        $iter = count($nameArray);
        $result = array();
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $nameArray[$i][0]);
        }
        echo json_encode($result);
        break;

    case 'model_auto': // Модели всех возможных марок автомобилей
        $columnName = array("name");
        $nameArray = $workDB->selectUniqueDataTable("auto", $columnName);
        $iter = count($nameArray);
        $result = array();
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $nameArray[$i][0]);
        }
        echo json_encode($result);
        break;

    case 'mark_auto': // Все возможные марки автомобилей
        $columnName = array("mark");
        $nameArray = $workDB->selectUniqueDataTable("auto", $columnName);
        $iter = count($nameArray);
        $result = array();
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $nameArray[$i][0]);
        }
        echo json_encode($result);
        break;

    case 'number_polis': // Все возможные полисы
        $columnName = array("number_polis");
        $nameArray = $workDB->selectUniqueDataTable("polis", $columnName);
        $iter = count($nameArray);
        $result = array();
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $nameArray[$i][0]);
        }
        echo json_encode($result);
        break;
}
?>