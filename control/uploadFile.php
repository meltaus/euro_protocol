<?php
//Сборка пути до конечной директории. В конец вставляется номер талона
require_once $_SERVER["DOCUMENT_ROOT"]."/settings/getRootDir.php";
$outputDir = $absRootDir . $_POST['SerialPolisV'] . $_POST['NumberPolisV'] . "/";
if ((isset($_POST['SerialPolisV'])) && (isset($_POST['NumberPolisV']))) {
    if (!file_exists($outputDir)) {
        @mkdir($outputDir);
    }

    if(  is_uploaded_file($_FILES["scanpdf"]["tmp_name"])  )
    {
        // Если файл загружен успешно, перемещаем его
        // из временной директории в конечную
        move_uploaded_file
        (
            $_FILES["scanpdf"]["tmp_name"],
            $outputDir .  $_FILES["scanpdf"]["name"]
        );
    } else {
        echo("Ошибка загрузки файла");
    }
}
?>