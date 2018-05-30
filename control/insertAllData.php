<?php

class insertAllData
{
    //Перменная для работы с БД
    private $workDB;

    //Переменные, содержащие в себе значения переданных полей
    private $number_polis_culprit;
    private $number_polis_member;
    private $serial_polis_culprit;
    private $serial_polis_member;
    private $statement;
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
    private $company_name_culprit;
    private $company_name_member;
    private $time_send_service_control;

    //Переменные присущие только таблице
    private $id_number_polis;
    private $id_number_polis_member;
    private $id_people_culprit;
    private $id_people_member;
    private $id_auto_culprit;
    private $id_auto_member;
    private $id_statement;
    private $id_company_culprit;
    private $id_company_member;

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
        $this->statement = $columnValues['statement'];
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
        $this->serial_polis_culprit = $columnValues['serial_polis_culprit'];
        $this->serial_polis_member = $columnValues['serial_polis_member'];
        $this->company_name_culprit = $columnValues['company_name_culprit'];
        $this->company_name_member = $columnValues['company_name_member'];
        $this->time_send_service_control = $columnValues['time_send_service_control'];

        $this->id_auto_culprit = $this->idAuto($this->mark_culprit, $this->model_culprit);
        $this->id_auto_member = $this->idAuto($this->mark_member, $this->model_member);

        $this->id_company_culprit = $this->idCompany($this->company_name_culprit);
        $this->id_company_member = $this->idCompany($this->company_name_member);

        $this->id_number_polis = $this->idNumberPolis($this->number_polis_culprit, $this->serial_polis_culprit);
        $this->id_number_polis_member = $this->idNumberPolis($this->number_polis_member, $this->serial_polis_member);

        $this->id_people_culprit = $this->idPeople($this->FIO_culprit, $this->id_auto_culprit,
            $this->state_car_number_culprit, $this->id_company_culprit);
        $this->id_people_member = $this->idPeople($this->FIO_member, $this->id_auto_member,
            $this->state_car_number_member, $this->id_company_member);

        $this->id_statement = $this->idStatement($this->statement, $this->proxy);
    }

    /**
     * Возвращает id компании. Если такой компании нет - добавляет ее
     * @param $companyName Имя компании
     * @return mixed id компании
     */
    private function idCompany($companyName) {
        $query = "SELECT count(id) FROM company WHERE company_name = '".$companyName."'";
        $count = $this->workDB->analysisResult($this->workDB->anyQueryDB($query));
        $condition = "WHERE company_name = '".$companyName."'";
        $column_name = array("id");
        if ($count[0][0] == 0) {
            $columnName = array(
                'company_name' => $companyName
            );

            $this->workDB->insertDataTable("company", $columnName);
        }

        $result = $this->workDB->selectDataTableWhere("company", $column_name, $condition);

        return $result[0][0];
    }

    /**
     * Метод проверяет наличие аналогичного извещения. В случае если аналогичного извещения нет запускается метод insertData
     * Возвращает будевое значение. true значит, что совпадения нет и вставка прошла успешно
     */
    public function insert() {
        $query = "SELECT count(id) FROM protocol WHERE id_number_polis = ".$this->id_number_polis." && 
                    id_people_culprit = ".$this->id_people_culprit." && id_number_polis_member = 
                    ".$this->id_number_polis_member." && id_people_member = ".$this->id_people_member;
        $count = $this->workDB->analysisResult($this->workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
            $this->insertData();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Метод получение id автомобиля. Если нет совпадения по марке и моделе - заносится новая строка
     * @param $mark Модель автомобиля
     * @param $model Марка автомобиля
     * @return mixed id автомобиля
     */
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

    /**
     * Метод получения id номера полиса. Если полиса нет - будет создана новая завись
     * @param $number_polis номер полиса
     * @return mixed id номера полиса
     */
    private function idNumberPolis($number_polis, $serial_polis) {
        $query = "SELECT count(id) FROM polis WHERE number_polis = '".$number_polis."' 
                    && serial_polis = '".$serial_polis."'";
        $condition = "WHERE number_polis = '".$number_polis."' && serial_polis = '".$serial_polis."'";
        $column_name = array("id");
        $count = $this->workDB->analysisResult($this->workDB->anyQueryDB($query));
        if ($count[0][0] == 0) {
            $columnName = array(
                'number_polis' => $number_polis,
                'serial_polis' => $serial_polis
            );
            $this->workDB->insertDataTable("polis", $columnName);
        }

        $result = $this->workDB->selectDataTableWhere("polis",$column_name, $condition);

        return $result[0][0];
    }

    /**
     * Метод получения id метода поступления извещения. Всегда добавляет новую запись
     * @param $statement id метода извещения из таблицы method_notofication
     * @param $proxy использовалась ли при этом доверенность
     * @return mixed id метода поступления извещения
     */
    private function idStatement($statement, $proxy)
    {
        if (!isset($proxy)) {
            $proxy = 0;
        } else {
            $proxy = 1;
        }
        $this->workDB->anyQueryDB("start transaction");
        $query = "insert into statement (method, `proxy`) values (".$statement.", ".$proxy.")";
        $this->workDB->anyQueryDB($query);
        $query = "select LAST_INSERT_ID()";
        $result = $this->workDB->analysisResult($this->workDB->anyQueryDB($query));
        $this->workDB->anyQueryDB("commit");
        return $result[0][0];
    }

    /**
     * Метод получения id человека. Если полного совпадения нет - создается новая запись
     * @param $FIO Фамилия, имя отчество
     * @param $id_auto id указанного автомобиля
     * @param $state_number_car Гос.номер указанного автомобиля
     * @return mixed id человека
     */
    private function idPeople($FIO, $id_auto, $state_number_car, $id_company) {
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
                'state_car_number' => $state_number_car,
                'id_company' => $id_company
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
        $columnName = array(
            'id_number_polis' => $this->id_number_polis,
            'id_statement' => $this->id_statement,
            'time_register' => $this->time_register,
            'time_atuo_emer' => $this->time_auto_emer,
            'id_people_culprit' => $this->id_people_culprit,
            'id_people_member' => $this->id_people_member,
            'id_number_polis_member' => $this->id_number_polis_member,
            'time_send_service_control' => $this->time_send_service_control
        );

        $this->workDB->insertDataTable("protocol", $columnName);
    }
}