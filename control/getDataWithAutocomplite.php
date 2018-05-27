<?php
//Получение списка всех имен для автодополнения
include $_SERVER["DOCUMENT_ROOT"]."/control/workDB.php";
$workDB = new workDB();
$columnName = array("name");
$nameArray = $workDB->selectUniqueDataTable("user",$columnName);
echo json_encode ($nameArray);
?>