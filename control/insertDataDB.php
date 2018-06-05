<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/control/workDB.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/control/insertAllData.php";
$insertAllData = new insertAllData();
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

        $current_date = date('Y-m-d');

        if(  is_uploaded_file($_FILES["scanpdf"]["tmp_name"])  )
        {
            if (isset($_POST['NumberPolisV']) && isset($_POST['NumberPolisP']) && isset($_POST['method_notification']) &&
                isset($_POST['dateDtp']) && isset($_POST['dateP']) && isset($_POST['fioV']) && isset($_POST['MarkAutoV']) &&
                isset($_POST['ModelAutoV']) && isset($_POST['GosNumberV']) && isset($_POST['fioP']) &&
                isset($_POST['MarkAutoP']) && isset($_POST['ModelAutoP']) && isset($_POST['GosNumberP']) &&
                isset($_POST['SerialPolisV']) && isset($_POST['SerialPolisP']) && isset($_POST['CompanyV']) &&
                isset($_POST['CompanyP']) && isset($_POST['dateN']) && isset($_FILES["scanpdf"]["name"])) {
                $columnValues = array(
                    'number_polis_culprit' => $_POST['NumberPolisV'],
                    'number_polis_member' => $_POST['NumberPolisP'],
                    'statement' => $_POST['method_notification']+1,
                    'proxy' => $_POST['proxy'],
                    'time_auto_emer' => $_POST['dateDtp'],
                    'time_register' => $_POST['dateP'],
                    'FIO_culprit' => $_POST['fioV'],
                    'mark_culprit' => $_POST['MarkAutoV'],
                    'model_culprit' => $_POST['ModelAutoV'],
                    'state_car_number_culprit' => $_POST['GosNumberV'],
                    'FIO_member' => $_POST['fioP'],
                    'mark_member' => $_POST['MarkAutoP'],
                    'model_member' => $_POST['ModelAutoP'],
                    'state_car_number_member' => $_POST['GosNumberP'],
                    'serial_polis_culprit' => $_POST['SerialPolisV'],
                    'serial_polis_member' => $_POST['SerialPolisP'],
                    'company_name_culprit' => $_POST['CompanyV'],
                    'company_name_member' => $_POST['CompanyP'],
                    'time_send_service_control' => $_POST['dateN'],
                    'filename' => substr($_FILES["scanpdf"]["name"],0,-4)  . $current_date . ".pdf"
                );

                $insertAllData->setData($columnValues);

                if($insertAllData->insert()){
                    include_once $_SERVER["DOCUMENT_ROOT"]."/control/uploadFile.php";
                    echo "Протокол заведен";
                    echo '<meta http-equiv="refresh" content="2; url=/pages/user_space.php">';
                } else {
                    echo "Все плохо";
                    echo '<meta http-equiv="refresh" content="2; url=/pages/insert_notify.php">';
                }
            } else {
                echo "Все плохо. Внесены не все данные";
                echo '<meta http-equiv="refresh" content="2; url=/pages/insert_notify.php">';
            }
        } else {
            echo("Ошибка загрузки файла");
            echo '<meta http-equiv="refresh" content="2; url=/pages/insert_notify.php">';
        }

        break;
    case "addDateSee":
        $columnValues = array(
            'time_inspection' => "'".$_GET['dateP']."'",
            'comment' => "'".$_GET['comment']."'"
        );

        $workDB->updateDataTable("protocol", $columnValues, "id", $_GET['id']);
        break;
}
?>