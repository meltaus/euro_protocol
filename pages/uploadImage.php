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

?>

<div class="container kv-main">
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

</body>
</html>

<script>
    //Загрузка файлов
    $('#file-ru').fileinput({
        language: 'ru',
        uploadUrl: 'upload.php',
        allowedFileExtensions: ['jpg']
    });
</script>