<?php

class insertAllData
{
    //Перменная для работы с БД
    private $workDB;

    //Переменные, содержащие в себе значения переданных полей
    private $number_polis_culprit;
    private $number_polis_member;
    private $id_statement;
    private $proxy;
    private $time_auto_emer;
    private $time_register;
    private $FIO_culprit;
    private $mark_culprit;
    private $model_culprit;
    private $state_car_number_culprit;
    private $FIO_member;
    private $mark_member;
    private $model_member;
    private $state_car_number_member;

    //Переменные присущие только таблице
    private $id_number_polis;
    private $id_number_polis_member;
    private $id_people_culprit;
    private $id_people_member;
    private $id_auto_culprit;
    private $id_auto_member;

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

    /**
     * Разбор входящих значений
     * @param $columnValues ассоциативный массив, где ключ имя столбца.
     */
    public function setData($columnValues) {
        $this->number_polis_culprit = $columnValues['number_polis_culprit'];
        $this->number_polis_member = $columnValues['number_polis_member'];
        $this->id_statement = $columnValues['id_statement'];
        $this->proxy = $columnValues['proxy'];
        $this->time_auto_emer = $columnValues['time_auto_emer'];
        $this->time_register = $columnValues['time_register'];
        $this->FIO_culprit = $columnValues['FIO_culprit'];
        $this->mark_culprit = $columnValues['mark_culprit'];
        $this->model_culprit = $columnValues['model_culprit'];
        $this->state_car_number_culprit = $columnValues['state_car_number_culprit'];
        $this->FIO_member = $columnValues['FIO_member'];
        $this->mark_member = $columnValues['mark_member'];
        $this->model_member = $columnValues['model_member'];
        $this->state_car_number_member = $columnValues['state_car_number_member'];

        $this->id_auto_culprit = $this->idAuto($this->mark_culprit, $this->model_culprit);
        $this->id_auto_member = $this->idAuto($this->mark_member, $this->model_member);

        $this->id_number_polis = $this->idNumberPolis($this->number_polis_culprit);
        $this->id_number_polis_member = $this->idNumberPolis($this->number_polis_member);

        $this->id_people_culprit = $this->idPeople($this->FIO_culprit, $this->id_auto_culprit,
            $this->state_car_number_culprit);
        $this->id_people_member = $this->idPeople($this->FIO_member, $this->id_auto_member,
            $this->state_car_number_member);
    }

    /**
     * Метод проверяет наличие аналогичного извещения. В случае если аналогичного извещения нет запускается метод insertData
     * Возвращает будевое значение. true значит, что совпадения нет и вставка прошла успешно
     */
    public function insert() {

    }

    private function idAuto($mark, $model) {
        $query = "SELECT count(id) FROM auto WHERE mark = '".$mark."' && `name` = '".$model."' ";
        $condition = "WHERE mark = '".$mark."' && `name` = '".$model."'";
        $column_name = array("id");
        $count = $this->workDB->analysisResult($this->workDB->anyQueryDB($query));
        if($count[0][0] == 0) {
            $columnName = array(
                'mark' => $mark,
                'name' => $model
            );
            $this->workDB->insertDataTable("auto", $columnName);
        }

        $result = $this->workDB->selectDataTableWhere("auto", $column_name, $condition);

        return $result[0][0];
    }

    private function idNumberPolis($number_polis) {
        $query = "SELECT count(id) FROM polis WHERE number_polis = ".$number_polis;
        $condition = "WHERE number_polis = ".$number_polis;
        $column_name = array("id");
        $count = $this->workDB->analysisResult($this->workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
            $columnName = array(
                'number_polis' => $number_polis
            );
            $this->workDB->insertDataTable("polis", $columnName);
        }

        $result = $this->workDB->selectDataTableWhere("polis",$column_name, $condition);

        return $result[0][0];
    }

    private function idPeople($FIO, $id_auto, $state_number_car) {
        $query = "SELECT count(id) FROM people WHERE `name` = '".$FIO."' && id_auto = ".$id_auto." 
                    && state_car_number = '".$state_number_car."'";
        $condition = "WHERE `name` = '".$FIO."' && id_auto = ".$id_auto."
                    && state_car_number = '".$state_number_car."'";
        $column_name = array("id");
        $count = $this->workDB->analysisResult($this->workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
            $columnName = array(
                'name' => $FIO,
                'id_auto' => $id_auto,
                'state_car_number' => $state_number_car
            );
            $this->workDB->insertDataTable("people", $columnName);
        }

        $result = $this->workDB->selectDataTableWhere("people", $column_name, $condition);

        return $result[0][0];
    }

    /**
     * Вставляет данные в таблицу. Запускается последовательность в результате которой по максимуму заполняется таблица protocol
     * Метод вызывается из метода insert после установки всех необходимых параметров
     */
    private function insertData() {

    }
}