<?php
include $_SERVER["DOCUMENT_ROOT"] . "/control/workDB.php";
$workDB = new workDB();

switch ($_GET['mode']) {
    case 'info':
        $result = array();

        //Информация о виновнике
        $query = "SELECT polis.serial_polis, polis.number_polis, people.name,
		people.state_car_number, people.phone_number, auto.mark, auto.name FROM protocol
		INNER JOIN polis on protocol.id_number_polis = polis.id
        INNER JOIN people on protocol.id_people_culprit = people.id
        INNER JOIN auto on people.id_auto = auto.id
        WHERE protocol.id = ".$_GET['id_protocol'];
        $culprit = $workDB->analysisResult($workDB->anyQueryDB($query));

        //Информация о потерпевшем
        $query = "SELECT polis.serial_polis, polis.number_polis, people.name,
		people.state_car_number, auto.mark, auto.name FROM protocol
		INNER JOIN polis on protocol.id_number_polis_member = polis.id
        INNER JOIN people on protocol.id_people_member = people.id
        INNER JOIN auto on people.id_auto = auto.id
        WHERE protocol.id = ".$_GET['id_protocol'];
        $member = $workDB->analysisResult($workDB->anyQueryDB($query));

        //Даты, комментарии и извещения
        $query = "SELECT time_register, time_atuo_emer, time_inspection, time_fact_inspection, time_send_service_control
		notice, `comment` FROM protocol
		WHERE id = ".$_GET['id_protocol'];
        $other = $workDB->analysisResult($workDB->anyQueryDB($query));

        //Метод подачи заявления
        $query = "SELECT method_notification.method, statement.proxy FROM statement
                  INNER JOIN method_notification on statement.method = method_notification.id
                  WHERE statement.id = (SELECT protocol.id_statement FROM protocol WHERE id = ".$_GET['id_protocol'].")";
        $statement = $workDB->analysisResult($workDB->anyQueryDB($query));

        $iter = count($culprit[0]);
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $culprit[0][$i]);
        }

        $iter = count($member[0]);
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $member[0][$i]);
        }

        $iter = count($other[0]);
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $other[0][$i]);
        }
        $iter = count($other[0]);
        for ($i = 0; $i < $iter; $i++) {
            array_push($result, $statement[0][$i]);
        }
        echo json_encode($result);
        break;
}
?>