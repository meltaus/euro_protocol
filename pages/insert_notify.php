<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Входящее заявление</title>
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
    <form class="form-horizontal" method="post" action="/control/insertDataDB.php?mode=notify" name="notification">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <label>О заявлении:</label>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="number_polis" id="number_polis" autocomplete="off"
                           placeholder="Номер полиса">
                    <i class="fa fa-file"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <select class="custom-select form-control" id="method_notification" name="method_notification">
                        <option selected="selected">Метод подачи заявления</option>
                        <?php
                        require_once $_SERVER["DOCUMENT_ROOT"]."/control/workDB.php";
                        $workDB = new workDB();
                        $columnName = array("method");
                        $methodArray = $workDB->selectUniqueDataTable("method_notification", $columnName);
                        $iter = count($methodArray);
                        for ($i = 0; $i < $iter; $i++) {
                            echo '<option value="' . $i . '">' . $methodArray[$i][0] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="checkbox form-group">
                    <label style="margin-top: 5%">
                        <input type="checkbox" value="" id="proxy" name="proxy">
                        <i class="fa fa-2x icon-checkbox"></i>
                        Довереность
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <label>О виновнике:</label>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="FIO" id="FIO" autocomplete="off"
                           placeholder="ФИО">
                    <i class="fa fa-user"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="mark_auto" id="mark_auto" autocomplete="off"
                           placeholder="Марка автомобиля">
                    <i class="fa fa-car"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="model_auto" id="model_auto" autocomplete="off"
                           placeholder="Модель автомобиля">
                    <i class="fa fa-car"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="state_car_number" id="state_car_number" autocomplete="off"
                           placeholder="Гос. Номер">
                    <i class="fa fa-car"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-1 col-sm-6 col-xs-6">
                <table>
                    <tr>
                        <td valign="top">
                            <div style="margin-top: 12%; margin-left: 40px">
                                <label>Дата&shy;&shy;</label>
                            </div>
                        </td>
                        <td valign="top">
                            <div style="margin-top: 35%;">
                                <label>ДТП</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                            <input type="date" class="form-control" name="date" id="date"
                                   value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6 col-md-1 col-sm-6 col-xs-6">
                <table>
                    <tr>
                        <td valign="top">
                            <div style="margin-top: 13%; margin-left: 40px">
                                <label>Дата&shy;&shy;</label>
                            </div>
                        </td>
                        <td valign="top">
                            <div style="margin-top: 11%;">
                                <label>регистрации&shy;&shy;</label>
                            </div>
                        </td>
                        <td valign="top">
                            <div style="margin-top: 35%;">
                                <label>ДТП</label>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                            <input type="date" class="form-control" name="date_registration" id="date_registration"
                                   value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <label>О участнике ДТП</label>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="FIO_participant" id="FIO_participant"
                           placeholder="ФИО">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="mark_auto_participant" id="mark_auto_participant"
                               placeholder="Марка автомобиля">
                        <i class="fa fa-car"></i>
                    </div>
                </div>
                <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="model_auto_participant" id="model_auto_participant"
                               placeholder="Модель автомобиля">
                        <i class="fa fa-car"></i>
                    </div>
                </div>
                <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="state_car_number_participant" id="state_car_number_participant"
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
                    <button type="submit" class="btn btn-success btn-block" style="background: green;">Внести данные</button>
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

        $("#number_polis").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=number_polis'
        });

        $("#FIO_participant").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=people'
        });

        $("#mark_auto_participant").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=mark_auto'
        });

        $("#model_auto_participant").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=model_auto'
        });

        $("#state_car_number_participant").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=state_car_number'
        });
    })
</script>