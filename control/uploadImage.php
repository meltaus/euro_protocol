<?php
//Сборка пути до конечной директории. В конец вставляется номер талона
require_once $_SERVER["DOCUMENT_ROOT"]."/settings/getRootDir.php";
$outputDir = $rooDir . $_GET['serial_polis'] . $_GET['number_polis'] . '\\';
if (isset($_COOKIE["dir"])) {
    if (!file_exists($outputDir)) {
        @mkdir($outputDir);
    }
}
//Загрузка фотографии во временную директорию и перемещение в конечную директорию
if (is_uploaded_file($_FILES['file-image']['tmp_name'][0])) {
    move_uploaded_file($_FILES['file-image']['tmp_name'][0], $outputDir . $_FILES['file-image']['name'][0]);
} else {
    echo "Possible file upload attack: ";
    echo "filename '" . $_FILES['file-image']['tmp_name'][0] . "'.";
}
//Разборка json объекта фотографии
echo json_encode([
    'success' => true,
    'files' => $_FILES,
    'get' => $_GET,
    'post' => $_POST,
    'flowTotalSize' => isset($_FILES['file']) ? $_FILES['file']['size'] : $_GET['flowTotalSize'],
    'flowIdentifier' => isset($_FILES['file']) ? $_FILES['file']['name'] . '-' . $_FILES['file']['size']
        : $_GET['flowIdentifier'],
    'flowFilename' => isset($_FILES['file']) ? $_FILES['file']['name'] : $_GET['flowFilename'],
    'flowRelativePath' => isset($_FILES['file']) ? $_FILES['file']['tmp_name'] : $_GET['flowRelativePath']
]);
?>
