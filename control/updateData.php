<?php

class updateData
{

    private $time_inspection;
    private $comment;
    private $workDB;

    //Конструктор
    public function __construct()
    {
        include_once "workDB.php";
        $this->workDB = new workDB();
    }

    public function __destruct()
    {
        unset($this->workDB);
    }

    public function setData($columnValues) {
        $this->time_inspection = $columnValues['time_inspection'];
        $this->comment = $columnValues['comment'];
    }

    public function updateData($id) {
        $columnValues = array(
            "time_inspection" => $this->time_inspection,
            "comment" => $this->comment
        );
        $this->workDB->updateDataTable("protocol", $columnValues, "id", $id);
    }
}