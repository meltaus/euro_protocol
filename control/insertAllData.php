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

    }

    /**
     * Метод проверяет наличие аналогичного извещения. В случае если аналогичного извещения нет запускается метод insertData
     * Возвращает будевое значение. true значит, что совпадения нет и вставка прошла успешно
     */
    public function insert() {

    }

    /**
     * Вставляет данные в таблицу. Запускается последовательность в результате которой по максимуму заполняется таблица protocol
     * Метод вызывается из метода insert после установки всех необходимых параметров
     */
    private function insertData() {

    }
}