<?php
include $_SERVER["DOCUMENT_ROOT"] . "/control/workDB.php";
$workDB = new workDB();

switch ($_GET['mode']) {
    case "notify":
        //Сбор данных с полей и внос в БД в соответствующие таблицы при помщи транзакции. Вставку данных делать в транзакции.

        //Данные вставляются в таблицы:
        //protocol                      Если дублируются все данные кроме даты - выдавать предупреждение
        //peolpe                        Если человек есть и совпадает номер полиса - не создавать новую запись
        //notice_for_inspection
        //statement                     Если отличается ФИО, но аналогичный номер есть - выдать предупреждение
        //auto                          Если есть совпадающие марка и авто - новое поле не добавлять
        //polis                         Всегда уникален
        echo '<meta http-equiv="refresh" content="0; url=/pages/user_space.php">';
        break;
}
?>