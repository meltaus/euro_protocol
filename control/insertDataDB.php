<?php
//include $_SERVER["DOCUMENT_ROOT"]."/control/workDB.php";
include $_SERVER["DOCUMENT_ROOT"]."/control/insertAllData.php";
$insertAllData = new insertAllData();

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

        $columnValues = array(
            'number_polis_culprit' => '',
            'number_polis_member' => '',
            'statement' => '',
            'proxy' => '',
            'time_auto_emer' => '',
            'time_register' => '',
            'FIO_culprit' => '',
            'mark_culprit' => '',
            'model_culprit' => '',
            'state_car_number_culprit' => '',
            'FIO_member' => '',
            'mark_member' => '',
            'model_member' => '',
            'state_car_number_member' => '',
        );

        $insertAllData->insert($columnValues);

        if($insertAllData->insert()){
            echo "Все хорошо";
        } else {
            echo "Все плохо";
        }

//        echo '<meta http-equiv="refresh" content="0; url=/pages/user_space.php">';
        break;
}
?>