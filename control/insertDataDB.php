<?php
include $_SERVER["DOCUMENT_ROOT"] . "/control/workDB.php";
$workDB = new workDB();

switch ($_GET['mode']) {
    case "notify":
        //Сбор данных с полей и внос в БД в соответствующие таблицы при помщи транзакции. Вставку данных делать в транзакции.

        //Данные вставляются в таблицы:
        //protocol                      Если дублируются все данные кроме даты - выдавать предупреждение
        //peolpe                        Если человек есть и id_auto и гос. номер - не создавать новую запись
        //                              Если отличается ФИО, но аналогичный номер есть - выдать предупреждение
        //notice_for_inspection
        //statement
        //auto                          Если есть совпадающие марка и авто - новое поле не добавлять
        //polis                         Всегда уникален

        //Проверка уникальности номера полиса
        $query = "SELECT count(number_polis) FROM polis WHERE number_polis =".$_POST['number_polis'];
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
            $column_name = array("id");
            $condition = "WHERE number_polis =".$_POST['number_polis'];
            $id_polis = $workDB->selectDataTableWhere("polis", $column_name, $condition);
        }

        //Проверка уникальности марки и модели авто
        $query = "SELECT count(id) FROM auto WHERE mark = '".$_POST['mark_auto']."' && `name` = '".$_POST['model_auto']."' ";
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
            $column_name = array("id");
            $condition = "WHERE mark = '".$_POST['mark_auto']."' && `name` = '".$_POST['model_auto']."'";
            $id_auto_people_culprit = $workDB->selectDataTableWhere("auto", $column_name, $condition);
        }
        $query = "SELECT count(id) FROM auto WHERE mark = '".$_POST['mark_auto_participant']."' &&
                  `name` = '".$_POST['model_auto_participant']."' ";
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
            $column_name = array("id");
            $condition = "WHERE mark = '".$_POST['mark_auto_participant']."' 
                            && `name` = '".$_POST['model_auto_participant']."'";
            $id_auto_people_member = $workDB->selectDataTableWhere("auto", $column_name, $condition);
        }

        //Проверка уникальности гос. номера
        $query = "SELECT count(id) FROM people WHERE state_car_number = '".$_POST['state_car_number_participant']."'";
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
            $column_name = array("id");
            $condition = "WHERE state_car_number = '".$_POST['state_car_number_participant']."'";
            $state_car_number_people_culprit = $workDB->selectDataTableWhere("people", $column_name, $condition);
        }
        $query = "SELECT count(id) FROM people WHERE state_car_number = '".$_POST['state_car_number']."'";
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
            $column_name = array("id");
            $condition = "WHERE state_car_number = '".$_POST['state_car_number']."'";
            $state_car_number_people_member = $workDB->selectDataTableWhere("people", $column_name, $condition);
        }

        //Проверка уникальности человека
        $query = "SELECT count(people.name) FROM people 
                  INNER JOIN auto ON people.id_auto = auto.id WHERE auto.mark = '".$_POST['mark_auto']."' && auto.name = 
                  '".$_POST['name_auto']."' && people.state_car_number = '".$_POST['state_car_number']."' && 
                  people.name = '".$_POST['FIO']."'";
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
            //Получаем id человека, который совпадает по ФИО, машине и гос.номеру
            $query = "SELECT people.id FROM people 
                  INNER JOIN auto ON people.id_auto = auto.id WHERE auto.mark = '".$_POST['mark_auto']."' && auto.name = 
                  '".$_POST['name_auto']."' && people.state_car_number = '".$_POST['state_car_number']."' && 
                  people.name = '".$_POST['FIO']."'";
            $id_people_culprit = $workDB->analysisResult($workDB->anyQueryDB($query));
        }
        //Второй участник
        $query = "SELECT count(people.name) FROM people 
                  INNER JOIN auto ON people.id_auto = auto.id WHERE auto.mark = '".$_POST['mark_auto_participant']."' && auto.name = 
                  '".$_POST['name_auto_participant']."' && people.state_car_number = '".$_POST['state_car_number_participant']."' && 
                  people.name = '".$_POST['FIO_participant']."'";
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
            //Получаем id человека, который совпадает по ФИО, машине и гос.номеру
            $query = "SELECT people.id FROM people 
                  INNER JOIN auto ON people.id_auto = auto.id WHERE auto.mark = '".$_POST['mark_auto_participant']."' && auto.name = 
                  '".$_POST['name_auto_participant']."' && people.state_car_number = '".$_POST['state_car_number_participant']."' && 
                  people.name = '".$_POST['FIO_participant']."'";
            $id_people_member = $workDB->analysisResult($workDB->anyQueryDB($query));
        }

        //Проверка уникальности протокола
        if (isset($id_people_member) && isset($id_people_culprit)) {
            $query = "SELECT count(protocol.id) FROM protocol 
				INNER JOIN polis on protocol.id_number_polis = polis.id
                WHERE polis.number_polis = '".$_POST['number_polis']."' && protocol.id_people_culprit = ".$id_people_culprit[0][0]."
                 && protocol.id_people_member = ".$id_people_culprit[0][0];
            $count = $workDB->analysisResult($workDB->anyQueryDB($query));
            if ($count[0][0] == 0) {
            } else {
            }
        }
        echo '<meta http-equiv="refresh" content="0; url=/pages/user_space.php">';
        break;
}
?>