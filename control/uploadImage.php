<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/settings/getRootDir.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/control/workDB.php";
$workDB = new workDB();
//Сборка пути до конечной директории. В конец вставляется номер талона
$current_date = date('Y-m-d');
$outputDir = $absRootDir . iconv("utf-8","windows-1251", $_COOKIE['SerialPolisV']) . $_COOKIE['NumberPolisV'] . "/";

if (!file_exists($outputDir)) {
    @mkdir($outputDir);
}
//Загрузка фотографии во временную директорию и перемещение в конечную директорию
if (is_uploaded_file($_FILES['file-image']['tmp_name'][0])) {
    $name = substr($_FILES["file-image"]["name"][0],0,-4);

    move_uploaded_file($_FILES['file-image']['tmp_name'][0], $outputDir .
        iconv("utf-8","windows-1251", $name)  . $current_date . ".jpg");
    $columnValues = array(
        "id_protocol" => $_COOKIE['id_protocol'],
        "name" => substr($_FILES["file-image"]["name"][0],0,-4)  . $current_date . ".jpg",
        "id_type" => 2
    );
    $workDB->insertDataTable("document", $columnValues);
    unset($workDB);
} else {
    echo "Possible file upload attack: ";
    echo "filename '" . substr($_FILES["file-image"]["name"][0],0,-4)  . $current_date . ".jpg" . "'.";
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
