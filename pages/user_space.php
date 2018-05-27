<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Рабочая панель</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootcomplete.css">
    <script src="../js/bootstrap-typeahead.min.js"></script>
    <link href="../css/style.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px">
            <a href="/pages/logout.php" class="btn btn-danger pull-right">Выйти</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table style="margin:10px auto;">
                <tr>
                    <td>
                        <div style="margin:10px auto;">
                            <div class="form-group">
                                <a href="insert_notify.php" class="btn btn-primary btn-block">Добавить протокол</a>
                            </div>
                            <div class="form-group">
                                <a href="#addParticipant" id="btn1" class="btn btn-primary btn-block">Добавить участника</a>
                            </div>
                            <div class="form-group">
                                <a href="#addData" id="btn2" class="btn btn-primary btn-block">
                                    Добавить данные с осмотра</a>
                            </div>
                            <div class="form-group">
                                <a href="#changeData" id="btn3" class="btn btn-primary btn-block">
                                    Внести изменения</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="margin-left: 5%; margin-right: 5%">
                            Динамическое наполнение событиями, требующих внимания
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>

<!--модальные окна-->
<div id="addParticipant" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Заголовок модального окна</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                            <div class="row">
                                <label>
                                    Выбрете протокол, к которому необходимо добавить участника
                                </label>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <select class="custom-select form-control" id="prefix" name="prefix">
                                        <option selected="selected">Выбрать протокол</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary">Далее</button>
            </div>
        </div>
    </div>
</div>

<div id="addData" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Заголовок модального окна</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                            <div class="row">
                                <label>
                                    Выбрете протокол, к которому необходимо добавить участника
                                </label>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <select class="custom-select form-control" id="prefix" name="prefix">
                                        <option selected="selected">Выбрать протокол</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary">Далее</button>
            </div>
        </div>
    </div>
</div>

<div id="changeData" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Заголовок модального окна</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                            <div class="row">
                                <label>
                                    Выбрете протокол, к которому необходимо добавить участника
                                </label>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <select class="custom-select form-control" id="prefix" name="prefix">
                                        <option selected="selected">Выбрать протокол</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary">Далее</button>
            </div>
        </div>
    </div>
</div>

</html>

<script>
    $(function () {
        $("#btn1").click(function () {
            $("#addParticipant").modal('show');
        });
    });

    $(function () {
        $("#btn2").click(function () {
            $("#addData").modal('show');
        });
    });

    $(function () {
        $("#btn3").click(function () {
            $("#changeData").modal('show');
        });
    });
</script>