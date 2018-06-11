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
include_once $_SERVER['DOCUMENT_ROOT']."/control/workDB.php";

$workDB = new workDB();
$query = "SELECT protocol.id, polis.number_polis, polis.serial_polis, people.name, protocol.time_register, protocol.time_atuo_emer,
		protocol.time_inspection, protocol.time_fact_inspection,protocol.time_insert_service_control,
        protocol.time_send_service_control, protocol.notice, protocol.comment, protocol.hide FROM protocol
        INNER JOIN polis on protocol.id_number_polis = polis.id
        INNER JOIN people on protocol.id_people_culprit = people.id";
$result = $workDB->analysisResult($workDB->anyQueryDB($query));
$query = "SELECT protocol.id, polis.number_polis, polis.serial_polis FROM protocol
        INNER JOIN polis on protocol.id_number_polis_member = polis.id";
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
                <table border="1px" ; style="margin:10px auto">
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
                    </tr>
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

                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <div id="notDate" class="tab-pane fade">
            <div class="row">
                <table border="1px" ; style="margin:10px auto">
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
                    <?php
                    $iter = count($result);
                    for ($i = 0; $i < $iter; $i++) {
                        if ($result[$i][6] == null) {
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
                            echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
                            echo "Дата осмотра еще не наназначена";
                            echo "<button onclick='addParticipant(this.id)' id='" . $result[$i][0] . "'
                                            class='btn btn-primary pull-right' 
                                            style='margin-left: 5px'>На осмотр</button>";
                            echo "</div>";
                            echo "</td>";

                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        <div id="withDate" class="tab-pane fade">
            <div class="row">
                <table border="1px" ; style="margin:10px auto">
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
                    <?php
                    $iter = count($result);
                    for ($i = 0; $i < $iter; $i++) {
                        if (($result[$i][6] != null) && (!in_array($result[$i][0],$result_document))) {
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
                            echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\" style=\"margin-top: 10px\">";
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
                </table>
            </div>
        </div>
        <div id="afterDate" class="tab-pane fade">
            <div class="row">
                <table border="1px" ; style="margin:10px auto">
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
                    <?php
                    $iter = count($result);
                    for ($i = 0; $i < $iter; $i++) {
                        if (($result[$i][6] != null) && (in_array($result[$i][0],$result_document))) {
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
                            echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\" style=\"margin-top: 10px\">";
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
                </table>
            </div>
        </div>
        <div id="lateDate" class="tab-pane fade">
            <div class="row">
                <table border="1px" ; style="margin:10px auto">
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
                            echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\" style=\"margin-top: 10px\">";
                            if ($result[$i][10] == null) {
                                echo "<button onclick='sendMessage(this.id)' id='" . $result[$i][0] . "'
                                            class='btn btn-primary pull-right' 
                                            style='margin-left: 5px'>Отправить телеграмму</button>";
                            } else {
                                echo "О телеграмме: ".$result[$i][10];
                            }
                            echo "</div>";
                            echo "</td>";

                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        <div id="trueDate"class="tab-pane fade">
            <div class="row">
                <table border="1px" ; style="margin:10px auto">
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
                    </tr>
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

                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

</div>

<!--модальные окна-->
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

                            <div style="margin-top: 10%; margin-left: 5px"; class="form-group">
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
                <button type="submit" onclick="closeModalWindow()" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" onclick="addDateSee()" class="btn btn-primary">Принять</button>
            </div>
        </div>
    </div>
</div>

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

                            <div style="margin-top: 10%; margin-left: 5px"; class="form-group">
                                Дата отправки извещения:
                                <input type="datetime-local" class="form-control" name="dateNotice" id="dateNotice"
                                       value="<?php echo date('Y-m-d').'T'.date('H:i'); ?>">
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
                <button type="submit" onclick="closeModalWindow()" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" onclick="addNotice()" class="btn btn-primary">Принять</button>
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
                data:{'mode':'addDateSee',
                    'id':id_protocol,
                    'dateP':dateP,
                    'comment':comment}
            });
            window.location.reload();
        }
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
                data:{'mode':'addNotice',
                    'id':id_protocol,
                    'dateNotice':dateNotice,
                    'typeNotice':typeNotice}
            });
            window.location.reload();
        }
    }

    function closeModalWindow(){
        window.close();
    }

    $(function () {
        $("#mark_auto").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=mark_auto'
        });

        $("#model_auto").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=model_auto'
        });
    })


    $(function(){
        $("#myTab a").click(function(e){
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>