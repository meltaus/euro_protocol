<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить второго участника</title>
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
            <div class="col-md-offset-3 col-md-6">
                <label>О участнике ДТП</label>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="FIO" id="FIO"
                           placeholder="ФИО">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="mark_auto" id="mark_auto"
                               placeholder="Марка автомобиля">
                        <i class="fa fa-car"></i>
                    </div>
                </div>
                <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="model_auto" id="model_auto"
                               placeholder="Модель автомобиля">
                        <i class="fa fa-car"></i>
                    </div>
                </div>
                <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="state_car_number" id="state_car_number"
                               placeholder="Гос. Номер">
                        <i class="fa fa-car"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-1 col-sm-6 col-xs-6">
            </div>
            <div class="col-lg-3 col-md-1 col-sm-3 col-xs-3">
                <div class="form-group" style="margin-top: 5%">
                    <a href="user_space.php" class="btn btn-danger btn-block" style="background: red;">Отменить</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-1 col-sm-3 col-xs-3">
                <div class="form-group" style="margin-top: 5%">
                    <button type="button" class="btn btn-success btn-block" style="background: green;">Внести данные</button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>

<script>
    $(function () {
        $("#FIO").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=people'
        });

        $("#mark_auto").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=mark_auto'
        });

        $("#model_auto").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=model_auto'
        });

        $("#state_car_number").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=state_car_number'
        });
    })
</script>