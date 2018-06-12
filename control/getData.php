<?php
include $_SERVER["DOCUMENT_ROOT"] . "/control/workDB.php";
$workDB = new workDB();

switch ($_GET['mode']) {
    case 'info':
        //Информация о виновнике
        $query = "SELECT polis.serial_polis, polis.number_polis, people.name,
		people.state_car_number, auto.mark, auto.name FROM protocol
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
        $membere = $workDB->analysisResult($workDB->anyQueryDB($query));

        //Даты, комментарии и извещения
        $query = "SELECT time_register, time_atuo_emer, time_inspection, time_fact_inspection, time_send_service_control
		notice, `comment` FROM protocol
		WHERE id = ".$_GET['id_protocol'];
        $other = $workDB->analysisResult($workDB->anyQueryDB($query));
        break;
}
?>