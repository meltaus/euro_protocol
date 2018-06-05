<?php
//Сборка пути до конечной директории
require_once $_SERVER["DOCUMENT_ROOT"]."/settings/getRootDir.php";
$outputDir = $absRootDir . iconv("utf-8","windows-1251", $_POST['SerialPolisV']) . $_POST['NumberPolisV'] . "/";


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
            $outputDir . iconv("utf-8","windows-1251", substr($_FILES["scanpdf"]["name"],0,-4))  . $current_date . ".pdf"
        );
    } else {
        echo("Ошибка загрузки файла");
    }
}
?>