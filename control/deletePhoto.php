<?php
if ( !(@unlink($_COOKIE['pathPhoto'])) )
{
} else {
    include_once $_SERVER['DOCUMENT_ROOT']."/control/workDB.php";
    $workDB = new workDB();
    $workDB->deleteRowDataTable("document", "name", $_COOKIE['namePhoto']);
    unset($workDB);
}
?>