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
<?php
/*
id="method_notification" - Метод подачи заявления
id="proxy" - Признак подачи по доверенностиmethod_notification
id="dateN" - Дата направления в СК
id="dateP" - Дата поступления в СК
id="dateDtp" - Дата ДТП

id="fioV" - ФИО виновника
id="CompanyV" - Компания страхователь виновника
id="SerialPolisV" - Серия полиса виновника
id="NumberPolisV" - Номер полиса виновника
id="MarkAutoV" - Марка автомобиля виновника
id="ModelAutoV" - Модель автомобиля виновника
id="GosNumberV" - Гос. номер автомобиля виновника

id="fioP" - ФИО пострадавшего
id="CompanyP" - Компания страхователь пострадавшего
id="SerialPolisP" - Серия полиса пострадавшего
id="NumberPolisP" - Номер полиса пострадавшего
id="MarkAutoP" - Марка автомобиля пострадавшего
id="ModelAutoP" - Модель автомобиля пострадавшего
id="GosNumberP" - Гос. номер автомобиля пострадавшего

id="comment"    - Комментарий к протоколу
*/
?>
<div class="container">
    <form class="form-horizontal" method="post" action="/control/insertDataDB.php?mode=notify" name="notification" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <label>Извещение о ДТП</label>
            </div>
        </div>

        <div class="row">
            <div class="form-group" style="margin-left: 1%">
                <table border="0px">
                    <tr>
                        <td valign="top">
                            <div style="margin-top: 20%; margin-left: 5px;">
                                <label>Способ подачи заявления:</label>
                            </div>
                        </td>
                        <td>
                            <div style="margin-top: 10%; margin-left: 5px"; class="form-group">
                                <select class="custom-select form-control" id="method_notification" name="method_notification">
                                    <option selected="selected">Выберите поле</option>
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
                        </td>
                        <td valign="top">
                            <div style="margin-top: 10%; margin-left: 5px"; class="checkbox form-group">
                                <input type="checkbox" value="" id="proxy" name="proxy">
                                <i class="fa fa-2x icon-checkbox"></i>
                                Предоставленно по доверености
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <div style="margin-top: 20%">
                                <label>Дата направления в СК:</label>
                            </div>
                        </td>
                        <td>
                            <div style="margin-top: 10%; margin-left: 5px"; class="form-group">
                                <input type="date" class="form-control" name="dateN" id="dateN"
                                       value="<?php echo date('Y-m-d'); ?>">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </td>
                        <td valign="top">
                            <div class="form-group">
                                <div class="row">
                                    <label>
                                        Загрузките отсканированное извещение в формате pdf
                                    </label>
                                </div>
                                <div class="row">
                                    <input dropzone="move" name="scanpdf" id="scanpdf" type="file"
                                           accept="application/pdf" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <div style="margin-top: 20%">
                                <label>Дата поступления в СК:</label>
                            </div>
                        </td>
                        <td>
                            <div style="margin-top: 10%; margin-left: 5px"; class="form-group">
                                <input type="date" class="form-control" name="dateP" id="dateP"
                                       value="<?php echo date('Y-m-d'); ?>">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </td>
                        <td valign="top">

                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <label>Обстоятельства ДТП</label>
            </div>
        </div>

        <div class="row">
            <div class="form-group" style="margin-left: 1%">
                <table border="0px">
                    <tr>
                        <td valign="top">
                            <div style="margin-top: 20%; margin-left: 5px;">
                                <label>Дата и время ДПТ:</label>
                            </div>
                        </td>
                        <td>

                        </td>
                        <td valign="top">
                            <div style="margin-top: 5%; margin-left: 5px"; class="form-group">
                                <input type="datetime-local" class="form-control" name="dateDtp" id="dateDtp"
                                       value="<?php echo date('Y-m-d\TH:i:s'); ?>">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <label>Сведения об участниках</label>
            </div>
        </div>

        <div class="row">
            <label>Виновник</label>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="fioV" id="fioV" autocomplete="off"
                           placeholder="ФИО">
                    <i class="fa fa-user"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="CompanyV" id="CompanyV" autocomplete="off"
                           placeholder="Компания">
                    <i class="fa fa-file"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="SerialPolisV" id="SerialPolisV" autocomplete="off"
                           placeholder="Серия полиса">
                    <i class="fa fa-file"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="NumberPolisV" id="NumberPolisV" autocomplete="off"
                           placeholder="Номер полиса">
                    <i class="fa fa-file"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="MarkAutoV" id="MarkAutoV" autocomplete="off"
                           placeholder="Марка автомобиля">
                    <i class="fa fa-car"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="ModelAutoV" id="ModelAutoV" autocomplete="off"
                           placeholder="Модель автомобиля">
                    <i class="fa fa-car"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="GosNumberV" id="GosNumberV" autocomplete="off"
                           placeholder="Гос. Номер">
                    <i class="fa fa-car"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <label>Потерпевший</label>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="fioP" id="fioP" autocomplete="off"
                           placeholder="ФИО">
                    <i class="fa fa-user"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="CompanyP" id="CompanyP" autocomplete="off"
                           placeholder="Компания">
                    <i class="fa fa-file"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="SerialPolisP" id="SerialPolisP" autocomplete="off"
                           placeholder="Серия полиса">
                    <i class="fa fa-file"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="NumberPolisP" id="NumberPolisP" autocomplete="off"
                           placeholder="Номер полиса">
                    <i class="fa fa-file"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="MarkAutoP" id="MarkAutoP" autocomplete="off"
                           placeholder="Марка автомобиля">
                    <i class="fa fa-car"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="ModelAutoP" id="ModelAutoP" autocomplete="off"
                           placeholder="Модель автомобиля">
                    <i class="fa fa-car"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="GosNumberP" id="GosNumberP" autocomplete="off"
                           placeholder="Гос. Номер">
                    <i class="fa fa-car"></i>
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
        $("#fioV").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=people'
        });

        $("#MarkAutoV").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=mark_auto'
        });

        $("#ModelAutoV").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=model_auto'
        });

        $("#SerialPolisV").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=serial_polis'
        });

        $("#fioP").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=people'
        });

        $("#MarkAutoP").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=mark_auto'
        });

        $("#ModelAutoP").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=model_auto'
        });

        $("#SerialPolisP").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=serial_polis'
        });

        $("#CompanyV").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=company'
        });

        $("#CompanyP").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=company'
        });

    })
</script>