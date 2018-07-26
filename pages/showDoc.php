<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDF документы</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="../themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <style type="text/css">body { text-align: center; } img { margin: 1px; } a { text-decoration: none; }</style>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/plugins/sortable.js" type="text/javascript"></script>
    <script src="../js/fileinput.js" type="text/javascript"></script>
    <script src="../js/locales/ru.js" type="text/javascript"></script>
    <script src="../themes/explorer/theme.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/settings/getRootDir.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/control/workDB.php";

$workDB = new workDB();

//Получаем id полиса
$columnName = array("id_number_polis");
$condition = "WHERE id = ".$_GET['id_protocol'];
$id_polis = $workDB->selectDataTableWhere("protocol", $columnName, $condition);

//Получаем есрию и номер полиса, связанным с заданным протоколом
$columnName = array("number_polis", "serial_polis");
$condition = "WHERE id = ".$id_polis[0][0];
$polis = $workDB->selectDataTableWhere("polis", $columnName, $condition);

//Получаем имя скана изввещения
$columnName = array("name");
$condition = "WHERE id_protocol = ".$_GET['id_protocol']." && id_type = 1";
$nameScan = $workDB->selectDataTableWhere("document", $columnName, $condition);
?>
<div class="container kv-main">
    <?php
    echo "<div class='row'>";
    echo "<object>";
    echo "<embed src='". $rootDir . $polis[0][1] . $polis[0][0] .
        '/' . $nameScan[0][0] ."' width='100%' height='700' />";
    echo "</object>";
    echo "</div>";
    ?>
    <div class="row">
        <a href="user_space.php" class='btn btn-danger pull-right'>Назад</a>
    </div>
</div>
