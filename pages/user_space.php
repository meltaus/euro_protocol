<?php
session_start();
?>
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
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/control/workDB.php";

$workDB = new workDB();
$query = "SELECT protocol.id, polis.number_polis, polis.serial_polis, people.name, protocol.time_register, protocol.time_atuo_emer,
		protocol.time_inspection, protocol.time_fact_inspection,protocol.time_insert_service_control,
        protocol.time_send_service_control, protocol.notice, protocol.comment, protocol.hide FROM protocol
        INNER JOIN polis on protocol.id_number_polis = polis.id
        INNER JOIN people on protocol.id_people_culprit = people.id
        WHERE protocol.time_register >= DATE_SUB(CURDATE(),INTERVAL 18 DAY)";
$result = $workDB->analysisResult($workDB->anyQueryDB($query));
$query = "SELECT protocol.id, polis.number_polis, polis.serial_polis FROM protocol
        INNER JOIN polis on protocol.id_number_polis_member = polis.id
        WHERE protocol.time_register >= DATE_SUB(CURDATE(),INTERVAL 18 DAY)";
$result_member = $workDB->analysisResult($workDB->anyQueryDB($query));
$columnName = array("id_protocol");
$condition = "WHERE id_type = 2";
$result_document = $workDB->selectDataTableWhere("document", $columnName, $condition);
$iter = count($result_document);
$tmp_arr = array();
for ($i = 0; $i < $iter; $i++) {
    array_push($tmp_arr, $result_document[$i][0]);
}
$result_document = $tmp_arr;
unset($tmp_arr);
unset($condition);
unset($columnName);
unset($workDB);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-top: 10px">
            <a href="user_space_old_protocol.php" class="btn btn-primary">Старые протоколы</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin-top: 10px">
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
                        </div>
                    </td>
                    <td>
                        <div style="margin-left: 5%; margin-right: 5%">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#all">Все заявки</a></li>
                <li><a data-toggle="tab" href="#notDate">Не назначенные</a></li>
                <li><a data-toggle="tab" href="#withDate">На осмотр</a></li>
                <li><a data-toggle="tab" href="#afterDate">После осмотра</a></li>
                <li><a data-toggle="tab" href="#lateDate">Просроченные</a></li>
                <li><a data-toggle="tab" href="#trueDate">Осмотренные</a></li>
            </ul>
        </div>
    </div>

    <div class="tab-content">
        <div id="all" class="tab-pane fade in active">
            <div class="row">
                <input class="form-control" type="text" placeholder="Поиск по таблице" id="allDataSearch"
                       onkeyup="tableSearch('allDataSearch', 'allData')">
            </div>
            <div class="row">
                <table border="1px" ; style="margin:10px auto" id="allData">
                    <thead>
                    <tr>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Дата занесения
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                ФИО виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер пострадавшего
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Действия
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $iter = count($result);
                    for ($i = 0; $i < $iter; $i++) {
                        echo "<tr>";

                        //Дата занесения
                        echo "<td>";
                        echo "<div style='margin-left: 5%; margin-right: 5%'>";
                        echo $result[$i][4];
                        echo "</div>";
                        echo "</td>";

                        //ФИО виновника
                        echo "<td>";
                        echo "<div style='margin-left: 5%; margin-right: 5%'>";
                        echo $result[$i][3];
                        echo "</div>";
                        echo "</td>";

                        //Серия + номер полиса
                        echo "<td>";
                        echo "<div style='margin-left: 5%; margin-right: 5%'>";
                        echo $result[$i][2] . $result[$i][1];
                        echo "</div>";
                        echo "</td>";

                        //Серия + номер полиса пострадавшего
                        echo "<td>";
                        echo "<div style='margin-left: 5%; margin-right: 5%'>";
                        echo $result_member[$i][2] . $result_member[$i][1];
                        echo "</div>";
                        echo "</td>";

                        //Действия
                        echo "<td>";
                        echo "<div class='center-block
                                  col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
//                        echo "<button onclick='editProtocol(this.id)' id='" . $result[$i][0] . "'
//                                            class='btn btn-primary center-block'
//                                            style='margin-left: 5px; margin-top: 5px'>Редактировать</button>";
                        echo "<button onclick='infoProtocol(this.id)' id='" . $result[$i][0] . "'
                                            class='btn btn-primary center-block' 
                                            style='margin-left: 5px; margin-top: 5px; margin-bottom: 5px'>Сведения</button>";
                        echo "</div>";
                        echo "</td>";

                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="notDate" class="tab-pane fade">
            <div class="row">
                <input class="form-control" type="text" placeholder="Поиск по таблице" id="tableNotDateSearch"
                       onkeyup="tableSearch('tableNotDateSearch','tableNotDate')">
            </div>
            <div class="row">
                <table border="1px" ; style="margin:10px auto" id="tableNotDate">
                    <thead>
                    <tr>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Дата занесения
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                ФИО виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер пострадавшего
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Статус
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $iter = count($result);
                    for ($i = 0; $i < $iter; $i++) {
                        if ($result[$i][7] == null) {
                            echo "<tr>";

                            //Дата занесения
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][4];
                            echo "</div>";
                            echo "</td>";

                            //ФИО виновника
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][3];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][2] . $result[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса пострадавшего
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result_member[$i][2] . $result_member[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Статус
                            if ($result[$i][6] == null) {
                                echo "<td>";
                                echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='margin-bottom: 2px; margin-top: 2px'>";
                                echo "Дата осмотра еще не наназначена";
                                echo "<button onclick='addParticipant(this.id)' id='" . $result[$i][0] . "'
                                            class='btn btn-primary pull-right' 
                                            style='margin-left: 5px'>На осмотр</button>";
                                echo "</div>";
                                echo "</td>";
                            } else {
                                echo "<td>";
                                echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='margin-bottom: 2px; margin-top: 2px'>";
                                echo "Назначено: " . $result[$i][6];
                                echo "<button onclick='addParticipant(this.id)' id='" . $result[$i][0] . "'
                                            class='btn btn-primary pull-right' 
                                            style='margin-left: 5px'>Новое время</button>";
                                echo "</div>";
                                echo "</td>";
                            }

                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="withDate" class="tab-pane fade">
            <div class="row">
                <input class="form-control" type="text" placeholder="Поиск по таблице" id="tableWithDateSearch"
                       onkeyup="tableSearch('tableWithDateSearch', 'tableWithDate')">
            </div>
            <div class="row">
                <table border="1px" ; style="margin:10px auto" id="tableWithDate">
                    <thead>
                    <tr>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Дата занесения
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                ФИО виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер пострадавшего
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Статус
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $iter = count($result);
                    for ($i = 0; $i < $iter; $i++) {
                        if (($result[$i][6] != null) && (!in_array($result[$i][0], $result_document))) {
                            echo "<tr>";

                            //Дата занесения
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][4];
                            echo "</div>";
                            echo "</td>";

                            //ФИО виновника
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][3];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][2] . $result[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса пострадавшего
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result_member[$i][2] . $result_member[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Статус
                            echo "<td>";
                            echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\" style='margin-bottom: 2px; margin-top: 2px'>";
                            echo "Дата осмотра: " . $result[$i][6];
                            echo "<a href='uploadImage.php?id_protocol=" . $result[$i][0] . "' id='" . $result[$i][0] . " 
                                            ' class='btn btn-success pull-right' 
                                            style='margin-left: 10px'>Добавить осмотр</button>";
                            echo "</div>";
                            echo "</td>";

                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="afterDate" class="tab-pane fade">
            <div class="row">
                <input class="form-control" type="text" placeholder="Поиск по таблице" id="tableAfterDateSearch"
                       onkeyup="tableSearch('tableAfterDateSearch', 'tableAfterDate')">
            </div>
            <div class="row">
                <table border="1px" ; style="margin:10px auto" id="tableAfterDate">
                    <thead>
                    <tr>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Дата занесения
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                ФИО виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер пострадавшего
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Действие
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $iter = count($result);
                    for ($i = 0; $i < $iter; $i++) {
                        if (($result[$i][6] != null) && (in_array($result[$i][0], $result_document))) {
                            echo "<tr>";

                            //Дата занесения
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][4];
                            echo "</div>";
                            echo "</td>";

                            //ФИО виновника
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][3];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][2] . $result[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса пострадавшего
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result_member[$i][2] . $result_member[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Статус
                            echo "<td>";
                            echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\" style='margin-bottom: 2px; margin-top: 2px'>";
                            echo "Дата осмотра: " . $result[$i][6];
                            echo "<a href='uploadImage.php?id_protocol=" . $result[$i][0] . "' id='" . $result[$i][0] . " 
                                            ' class='btn btn-success pull-right' 
                                            style='margin-left: 10px'>Изменить фотографии</button>";
                            echo "</div>";
                            echo "</td>";

                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="lateDate" class="tab-pane fade">
            <div class="row">
                <input class="form-control" type="text" placeholder="Поиск по таблице" id="tableLateDateSearch"
                       onkeyup="tableSearch('tableLateDateSearch', 'tableLateDate')">
            </div>
            <div class="row">
                <table border="1px" ; style="margin:10px auto" id="tableLateDate">
                    <thead>
                    <tr>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Дата занесения
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                ФИО виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер пострадавшего
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Действие
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $iter = count($result);
                    for ($i = 0; $i < $iter; $i++) {
                        if (($result[$i][6] != null) && ($result[$i][7] == null)) {
                            echo "<tr>";

                            //Дата занесения
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][4];
                            echo "</div>";
                            echo "</td>";

                            //ФИО виновника
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][3];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][2] . $result[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса пострадавшего
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result_member[$i][2] . $result_member[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Статус
                            echo "<td>";
                            echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\" style='margin-bottom: 2px; margin-top: 2px'>";
                            if ($result[$i][10] == null) {
                                echo "<button onclick='sendMessage(this.id)' id='" . $result[$i][0] . "'
                                            class='btn btn-primary pull-right' 
                                            style='margin-left: 5px'>Отправить телеграмму</button>";
                            } else {
                                echo "О телеграмме: " . $result[$i][10];
                            }
                            echo "</div>";
                            echo "</td>";

                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="trueDate" class="tab-pane fade">
            <div class="row">
                <input class="form-control" type="text" placeholder="Поиск по таблице" id="tableTrueDateSearch"
                       onkeyup="tableSearch('tableTrueDateSearch', 'tableTrueDate')">
            </div>
            <div class="row">
                <table border="1px" ; style="margin:10px auto" id="tableTrueDate">
                    <thead>
                    <tr>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Дата занесения
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                ФИО виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер виновника
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Серия/Номер пострадавшего
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: 5%; margin-right: 5%">
                                Время фактического осмотра
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $iter = count($result);
                    for ($i = 0; $i < $iter; $i++) {
                        if (($result[$i][6] != null) && ($result[$i][7] != null)) {
                            echo "<tr>";

                            //Дата занесения
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][4];
                            echo "</div>";
                            echo "</td>";

                            //ФИО виновника
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][3];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][2] . $result[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Серия + номер полиса пострадавшего
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result_member[$i][2] . $result_member[$i][1];
                            echo "</div>";
                            echo "</td>";

                            //Время фактического осмотра
                            echo "<td>";
                            echo "<div style='margin-left: 5%; margin-right: 5%'>";
                            echo $result[$i][7];
                            echo "</div>";
                            echo "</td>";

                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!--модальные окна-->
<!--Назначить время осмотра и комментарий-->
<div id="addParticipant" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Назначить осмотр</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">

                            <div style="margin-top: 10%; margin-left: 5px" ; class="form-group">
                                Дата осмотра:
                                <input type="datetime-local" class="form-control" name="dateP" id="dateP" value="
									<?php
                                echo date('Y-m-d');
                                ?>">
                            </div>
                            <div style="margin-top: 10%; margin-left: 5px">
                                Примечание:
                                <textarea rows="15" cols="47" id="comment" name="comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" onclick="closeModalWindow()" class="btn btn-default" data-dismiss="modal">Отмена
                </button>
                <button type="button" onclick="addDateSee()" class="btn btn-primary">Принять</button>
            </div>
        </div>
    </div>
</div>
<!--Добавить информацию об отправке телеграммы-->
<div id="sendMessage" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Назначить осмотр</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">

                            <div style="margin-top: 10%; margin-left: 5px" ; class="form-group">
                                Дата отправки извещения:
                                <input type="datetime-local" class="form-control" name="dateNotice" id="dateNotice"
                                       value="<?php echo date('Y-m-d') . 'T' . date('H:i'); ?>">
                            </div>
                            <div style="margin-top: 10%; margin-left: 5px">
                                Способ отправки извещения:
                                <input type="text" id="typeNotice" name="typeNotice">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" onclick="closeModalWindow()" class="btn btn-default" data-dismiss="modal">Отмена
                </button>
                <button type="button" onclick="addNotice()" class="btn btn-primary">Принять</button>
            </div>
        </div>
    </div>
</div>
<!--Информация о протоколе-->
<div id="infoProtocol" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Назначить осмотр</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <div class="col-lg-3 col-md-1 col-sm-3 col-xs-3">
                                <div class="row">
                                    <label>О виновнике</label>
                                </div>
                                <div class="row">
                                    <text id="infoFIOV">ФИО</text>
                                </div>
                                <div class="row">
                                    <text id="infoPolisV">Серия + номер</text>
                                </div>
                                <div class="row">
                                    <text id="infoAutoV">Марка + модель</text>
                                </div>
                                <div class="row">
                                    <text id="ingoGosNumberV">Гос.Номер</text>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-1 col-sm-3 col-xs-3">
                                <div class="row">
                                    <label>О потерпевшем</label>
                                </div>
                                <div class="row">
                                    <text id="infoFIOP">ФИО</text>
                                </div>
                                <div class="row">
                                    <text id="infoPolisP">Серия + номер</text>
                                </div>
                                <div class="row">
                                    <text id="infoAutoP">Марка + модель</text>
                                </div>
                                <div class="row">
                                    <text id="ingoGosNumberP">Гос.Номер</text>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-1 col-sm-3 col-xs-3">
                                <div class="row">
                                    <label>Даты</label>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <text>Дата регистрации:</text>
                                    </div>
                                    <div class="row">
                                        <text id="infoDateRegistry"></text>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="row">
                                        <text>Дата ДТП:</text>
                                    </div>
                                    <div class="row">
                                        <text id="infoDateDTP"></text>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="row">
                                        <text>Назначенная дата осмотра:</text>
                                    </div>
                                    <div class="row">
                                        <text id="infoTimeInspection"></text>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="row">
                                        <text>Дата фактического осмотра:</text>
                                    </div>
                                    <div class="row">
                                        <text id="infoTimeFactInspection"></text>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="row">
                                        <text>Дата и способ отправки извещения:</text>
                                    </div>
                                    <div class="row">
                                        <text id="infoNotice"></text>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-1 col-sm-2 col-xs-2">
                                <div class="row">
                                    <label>Комментарий</label>
                                </div>
                                <div class="row">
                                    <text id="commentProtocol">Комментарий</text>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" onclick="closeModalWindow()" class="btn btn-default" data-dismiss="modal">OK
                </button>
            </div>
        </div>
    </div>
</div>
<!--Редактирование протокола-->
<div id="editProtocol" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Назначить осмотр</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-1 col-sm-4 col-xs-4">
                            Здесь можно будет отредактировать протокол
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" onclick="closeModalWindow()" class="btn btn-default" data-dismiss="modal">OK
                </button>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<script>

    var id_protocol;

    function addSee(val) {
        document.cookie = "id_protocol=" + val;
        id_protocol = val;
        $("#addSee").modal('show');
    }

    function addParticipant(val) {
        document.cookie = "id_protocol=" + val;
        id_protocol = val;
        $("#addParticipant").modal('show');
    }

    function updateProtocol(val) {
        document.cookie = "id_protocol=" + val;
        id_protocol = val;
        window.alert("Здесь будет возможность редактировать составленный ранее протокол")
    }

    function sendMessage(val) {
        document.cookie = "id_protocol=" + val;
        id_protocol = val;
        $("#sendMessage").modal('show');
    }

    function addDateSee() {
        var dateP = document.getElementById('dateP').value;
        var comment = document.getElementById('comment').value;
        if (dateP == "") {
            window.alert("Необходимо указать дату и время");
        } else {
            $.ajax({
                type: "get",
                url: "../control/insertDataDB.php",
                data: {
                    'mode': 'addDateSee',
                    'id': id_protocol,
                    'dateP': dateP,
                    'comment': comment
                }
            });
            window.location.reload();
        }
    }

    function infoProtocol(val) {
        $.ajax({
            type: "get",
            url: "../control/getData.php",
            data: {
                'mode': 'info',
                'id_protocol': val
            },
            success: function (response) {
                var protocol = JSON.parse(response);
                //Заполняем дданные о виновнике
                document.getElementById('infoPolisV').innerHTML = protocol[0] + protocol[1];
                document.getElementById('infoFIOV').innerHTML = protocol[2];
                document.getElementById('infoAutoV').innerHTML = protocol[4] + " " + protocol[5];
                document.getElementById('ingoGosNumberV').innerHTML = protocol[3];

                //Заполняем данные о пострадавшем
                document.getElementById('infoPolisP').innerHTML = protocol[6] + protocol[7];
                document.getElementById('infoFIOP').innerHTML = protocol[8];
                document.getElementById('infoAutoP').innerHTML = protocol[10] + " " + protocol[11];
                document.getElementById('ingoGosNumberP').innerHTML = protocol[9];

                //Даты
                document.getElementById('infoDateRegistry').innerHTML = protocol[12];
                document.getElementById('infoDateDTP').innerHTML = protocol[13];
                document.getElementById('infoTimeInspection').innerHTML = protocol[14];
                document.getElementById('infoTimeFactInspection').innerHTML = protocol[15];
                document.getElementById('infoNotice').innerHTML = protocol[16];

                //Комментарий
                document.getElementById('commentProtocol').innerHTML = protocol[17];
            }
        });
        $("#infoProtocol").modal('show');
    }

    function editProtocol(val) {
        $("#editProtocol").modal('show');
    }

    function addNotice() {
        var dateNotice = document.getElementById('dateNotice').value;
        dateNotice = dateNotice.replace("T", ",");
        var typeNotice = document.getElementById('typeNotice').value;
        if (dateNotice == "") {
            window.alert("Необходимо указать время отправики телеграммы");
        }
        if (typeNotice == "") {
            window.alert("Необходимо указать способ передачи телеграммы");
        }
        if ((dateNotice != "") && (typeNotice != "")) {
            $.ajax({
                type: "get",
                url: "../control/insertDataDB.php",
                data: {
                    'mode': 'addNotice',
                    'id': id_protocol,
                    'dateNotice': dateNotice,
                    'typeNotice': typeNotice
                }
            });
            window.location.reload();
        }
    }

    function closeModalWindow() {
        window.close();
    }


    $(function () {
        $("#myTab a").click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });

    function tableSearch(pharseName, tableName) {
        var phrase = document.getElementById(pharseName);
        var table = document.getElementById(tableName);
        var regPhrase = new RegExp(phrase.value, 'i');
        var flag = false;
        for (var i = 1; i < table.rows.length; i++) {
            flag = false;
            for (var j = table.rows[i].cells.length - 1; j >= 0; j--) {
                flag = regPhrase.test(table.rows[i].cells[j].innerHTML);
                if (flag) break;
            }
            if (flag) {
                table.rows[i].style.display = "";
            } else {
                table.rows[i].style.display = "none";
            }

        }
    }
</script>