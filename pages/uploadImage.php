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
    $condition = "WHERE id_protocol = ".$_GET['id_protocol']." id_type = 2";
    $nameFiles = $workDB->selectDataTableWhere("documnet", $columnName, $condition);
}
?>

<div class="container kv-main">
    <div class="row">
    </div>
    <div class="row">
        <div class="conteiner" id="gallery">
            <?php
            if (isset($_GET['id_protocol']) && isset($nameFiles)) {
                $count = count($nameFiles);
                echo '<div id="proho'. $_GET['id_protocol'] . '" style="display: none;">';
                for ($i = 0; $i < $count; $i++) {
                    echo '<a href="' . $absRootDir . '/' . $polis[0][1] . $polis[0][0] .
                        '/' . '" class="flipLightBox" name="' . $nameFiles[$i][0] . '">';
                    echo '<img src="' . $absRootDir . '/' . $polis[0][1] . $polis[0][0] . '" width="225" height="225"></img>';
                    echo '<span>Что бы удалить изображение нажмите кнопки ниже<br><span>
                        <button onclick="clickDelete(this.id)" id="' . $nameFiles[$i][0] . '">
                        Удалить</button></span></span>';
                    echo '</a>';
                }
                echo '</div>';
            }
            ?>
        </div>
        <br>
    </div>
    <div class="row">
        <form enctype="multipart/form-data" method="post" action="/control/uploadImage.php" name="uploadImage">
            <br>
            <div class="conteiner">
                <hr style="border: 2px dotted">
                <input id="file-ru" name="file-image[]" type="file" multiple data-max-file-count="20"
                       data-preview-file-type="any" data-upload-url="/control/uploadImage.php"
                       accept='image/*'>
            </div>
            <br>
        </form>
    </div>
</div>

</body>
</html>

<script>
    //Загрузка файлов
    $('#file-ru').fileinput({
        language: 'ru',
        uploadUrl: 'upload.php',
        allowedFileExtensions: ['jpg']
    });

    function clickDelete(val) {
        $.ajax({
            url: "deletePhoto.php?path=" + <?php echo json_encode($absRootDir . '/' . $polis[0][1] . $polis[0][0]);?>,
            data: "id=2,path=" + sessionStorage['path']
        });
        $('a[name="' + val + '"]').remove();
        window.alert("Фотография удалена");
     }
</script>