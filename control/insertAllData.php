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
    private $id_auto_member;
    private $id_auto_culprit;

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
    }

    /**
     * Метод проверяет наличие аналогичного извещения. В случае если аналогичного извещения нет запускается метод insertData
     * Возвращает будевое значение. true значит, что совпадения нет и вставка прошла успешно
     */
    public function insert() {

    }

    private function idAuto() {

    }

    private function idNumberPolis() {

    }

    private function idPeople() {
        
    }

    /**
     * Вставляет данные в таблицу. Запускается последовательность в результате которой по максимуму заполняется таблица protocol
     * Метод вызывается из метода insert после установки всех необходимых параметров
     */
    private function insertData() {

    }
}