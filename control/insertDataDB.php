<?php
include $_SERVER["DOCUMENT_ROOT"] . "/control/workDB.php";
$workDB = new workDB();

switch ($_GET['mode']) {
    case "notify":
        //Сбор данных с полей и внос в БД в соответствующие таблицы при помщи транзакции. Вставку данных делать в транзакции.

        //Данные вставляются в таблицы:
        //protocol                      Если дублируются все данные кроме даты - выдавать предупреждение
        //peolpe                        Если человек есть и id_auto и гос. номер - не создавать новую запись
        //notice_for_inspection
        //statement                     Если отличается ФИО, но аналогичный номер есть - выдать предупреждение
        //auto                          Если есть совпадающие марка и авто - новое поле не добавлять
        //polis                         Всегда уникален

        //Проверка уникальности номера полиса
        $query = "SELECT count(number_polis) FROM polis WHERE number_polis =".$_POST['number_polis'];
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
        }

        //Проверка уникальности марки и модели авто
        $query = "SELECT count(id) FROM auto WHERE mark = '".$_POST['mark_auto']."' && `name` = '".$_POST['model_auto']."' ";
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
        }

        //Проверка уникальности человека
        $query = "select count(people.name) from people 
                  inner join auto on people.id_auto = auto.id where auto.mark = '".$_POST['mark_auto']."' && auto.name = 
                  '".$_POST['name_auto']."' && people.state_car_number = '".$_POST['state_car_number']."'";
        $count = $workDB->analysisResult($workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
        } else {
        }
        echo '<meta http-equiv="refresh" content="0; url=/pages/user_space.php">';
        break;
}
?>