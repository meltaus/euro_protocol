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
include $_SERVER["DOCUMENT_ROOT"] . "/control/getData.php";
$result = createDataForMailPage();
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px">
            <a href="/pages/logout.php" class="btn btn-danger pull-right">Выйти</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table border="1px";  style="margin:10px auto;">
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
                            Тут могла быть Ваша реклама
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table border="1px"; style="margin:10px auto">
                <tr>
                    <td>
                        <div style="margin-left: 5%; margin-right: 5%">
                            Дата занесения
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

                    </td>
                </tr>
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    echo "<tr>";

                    for ($j = 0; $j < count($result[$i]); $j++) {

                        switch ($j) {
                            case 0:
                                break;
                            case 1:
                                echo "<td>";
                                echo "<div style=\"margin-left: 5%; margin-right: 5%\">";
                                echo $result[$i][$j];
                                echo "</div>";
                                echo "</td>";
                                break;
                            case 2:
                                echo "<td>";
                                echo "<div style=\"margin-left: 5%; margin-right: 5%\">";
                                echo $result[$i][$j];
                                echo "</div>";
                                echo "</td>";
                                break;
                            case 3:
                                echo "<td>";
                                echo "<div style=\"margin-left: 5%; margin-right: 5%\">";
                                echo $result[$i][$j];
                                echo "</div>";
                                echo "</td>";
                                break;
                            case 4:
                                if ($result[$i][$j] == null) {
                                    echo "<td>";
                                    echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\" style=\"margin-top: 10px\">";
                                    echo "<button onclick='addParticipant(this.id)' id='". $result[$i][0] . "'
                                            class='btn btn-danger pull-right' 
                                            style='margin-left: 5px'>На осмотр</button>";
                                    echo "<button onclick='updateProtocol(this.id)' id='" . $result[$i][0] . " 
                                            ' class='btn btn-danger pull-right' 
                                            style='margin-right: 5px'>Редактировать</button>";
                                    echo "</div>";
                                    echo "</td>";
                                }
                                else {
                                    echo "<td>";
                                    echo "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\" style=\"margin-top: 10px\">";
                                    echo "Дата осмотра: ". $result[$i][$j];
                                    echo "<a href='uploadImage.php?id_protocol=". $result[$i][0] ."' id='" . $result[$i][0] . " 
                                            ' class='btn btn-danger pull-right' 
                                            style='margin-left: 10px'>Добавить осмотр</button>";
                                    echo "</div>";
                                    echo "</td>";
                                }
                                break;
                        }
                    }
                    echo "</tr>";
                }
                ?>
            </table>
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
                                <input type="date" class="form-control" name="dateP" id="dateP" value="
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
                <button type="button" onclick="closeAddParticipant()" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" onclick="addDateSee()" class="btn btn-primary">Принять</button>
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

    function addDateSee() {
        var dateP = document.getElementById('dateP').value;
        var comment = document.getElementById('comment').value;
        $.ajax({
            type: "get",
            url: "../control/insertDataDB.php",
            data:{'mode':'addDateSee',
                    'id':id_protocol,
                    'dateP':dateP,
                    'comment':comment}
            });
        window.alert("Данные внесены. Теперь вы можете закрыть окно");
    }

    function closeAddParticipant(){
        window.close();
        // $("#addParticipant").modal('hidden');
    }

    $(function () {
        $("#mark_auto").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=mark_auto'
        });

        $("#model_auto").typeahead({ //на какой input:text назначить результаты списка
            ajax: '/control/getDataWithComp.php?mode=model_auto'
        });
    })
</script>