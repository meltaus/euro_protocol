<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Изменить дату осмотра</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/bootcomplete.css">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap-typeahead.min.js"></script>
    <link href="../css/style.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container">
    <form class="form-horizontal" method="post" action="" name="notification">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table style="margin:10px auto;">
                    <tr>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                <div class="row">
                                    <label>
                                        Назначенная дата осмотра (если пусто, значит осмотр еще не назначен)
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <input type="datetime-local" class="form-control" name="date" id="date">
                                    </div>
                                </div>
                                <div class="row">
                                    <label>
                                        Фактическая дата осмотра (если пусто, значит осмотр еще не проводился)
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <input type="datetime-local" class="form-control" name="date" id="date">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-1 col-sm-6 col-xs-6">
                                    </div>
                                    <div class="col-lg-3 col-md-1 col-sm-3 col-xs-3">
                                        <div class="form-group" style="margin-top: 5%">
                                            <button type="button" class="btn btn-danger" style="background: red;">Отменить</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-1 col-sm-3 col-xs-3">
                                        <div class="form-group" style="margin-top: 5%">
                                            <button type="button" class="btn btn-success" style="background: green;">Сохранить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Связанные с данным полисом ДТП
                                <br>
                                Заполняется динамически
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>
</body>