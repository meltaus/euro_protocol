<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Загрузка фотографий с осмотра</title>
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

if (isset($_COOKIE['id_protocol'])){
    setcookie("id_protocol", " ", time() - 3600);
}
if (isset($_COOKIE['SerialPolisV'])) {
    setcookie("SerialPolisV", " ", time() - 3600);
}
if (isset($_COOKIE['NumberPolisV'])) {
    setcookie("NumberPolisV", " ", time() - 3600);
}
$id_polis = "";
$polis = "";
$nameFiles = "";
$nameScan = "";
if (isset($_GET['id_protocol'])) {
    //Получаем id полиса
    $columnName = array("id_number_polis");
    $condition = "WHERE id = ".$_GET['id_protocol'];
    $id_polis = $workDB->selectDataTableWhere("protocol", $columnName, $condition);

    //Получаем есрию и номер полиса, связанным с заданным протоколом
    $columnName = array("number_polis", "serial_polis");
    $condition = "WHERE id = ".$id_polis[0][0];
    $polis = $workDB->selectDataTableWhere("polis", $columnName, $condition);

    // Получаем имена файлов, связанные с заданным протоколом
    $columnName = array("name");
    $condition = "WHERE id_protocol = ".$_GET['id_protocol']." && id_type = 2";
    $nameFiles = $workDB->selectDataTableWhere("document", $columnName, $condition);

    //Получаем имя скана изввещения
    $columnName = array("name");
    $condition = "WHERE id_protocol = ".$_GET['id_protocol']." && id_type = 1";
    $nameScan = $workDB->selectDataTableWhere("document", $columnName, $condition);

    setcookie("id_protocol",$_GET['id_protocol'], time()+300, "/");
    setcookie("SerialPolisV",$polis[0][1], time()+300, "/");
    setcookie("NumberPolisV",$polis[0][0], time()+300, "/");
}
?>

<div class="container kv-main">
    <?php

    if ((isset($_GET['id_protocol'])) && (count($nameScan) != 0)) {
        echo "<div class='row'>";
//        echo '<iframe src="http://docs.google.com/gview?url=' . $rootDir . $polis[0][1] . $polis[0][0] .
//            '/' . $nameScan[0][0] . '&embedded=true"
//style="width: 600px; height: 600px;" frameborder="0">Ваш браузер не поддерживает фреймы</iframe>';
        echo "<object>";
        echo "<embed src='". $rootDir . $polis[0][1] . $polis[0][0] .
            '/' . $nameScan[0][0] ."' width='100%' height='300' />";
        echo "</object>";
        echo "</div>";
    }
    ?>
    <div class="row">
        <div class="conteiner" id="gallery">
            <?php
            if ((isset($_GET['id_protocol'])) && (count($nameFiles) != 0)) {
                $count = count($nameFiles);
                echo '<div id="photo'. $_GET['id_protocol'] . '">';
                for ($i = 0; $i < $count; $i++) {
                    echo '<a href="' . $rootDir  . $polis[0][1] . $polis[0][0] .
                        '/' . $nameFiles[$i][0] . '" class="flipLightBox" name="' . $nameFiles[$i][0] . '">';
                    echo '<img src="' . $rootDir  . $polis[0][1] . $polis[0][0] .
                        '/' . $nameFiles[$i][0] . '" width="225" height="225"></img>';
//                    echo '<span>Что бы удалить изображение нажмите кнопки ниже<br><span>
//                        <button onclick="clickDelete(this.id)" id="' . $nameFiles[$i][0] . '">
//                        Удалить</button></span></span>';
                    echo '<span>Скоро здесь будет кнопка "Удалить"<br><span></span></span>';
                    echo '</a>';
                }
                echo '</div>';
            }
            ?>
        </div>
        <br>
    </div>
    <div class="row">
        <a href="user_space.php" class='btn btn-danger pull-right'>Назад</a>
    </div>
</div>

</body>
</html>

<script>
    function clickDelete(val) {
        sessionStorage['pathPhoto'] = <?php echo json_encode($absRootDir . $polis[0][1] . $polis[0][0] . '/');?> + val;
        var date = new Date(new Date().getTime() + 120 * 1000);
        document.cookie = "pathPhoto=" + sessionStorage['pathPhoto'] + "; path=/; expires=" + date.toUTCString();
        document.cookie = "namePhoto=" + val + "; path=/; expires=" + date.toUTCString();
        $.ajax({
            url: "../control/deletePhoto.php",
            data: "id=2,pathPhoto=" + sessionStorage['pathPhoto']
        });
        $('a[name="' + val + '"]').remove();
        window.alert("Фотография удалена");
    }
</script>
<script type="text/javascript" src="../js/fliplightbox.min.js"></script>
<script type="text/javascript">$('body').flipLightBox()</script>